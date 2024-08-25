<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TransferStatus;
use App\Http\Requests\TransferRequest;
use App\Http\Services\DaleelStoreService;
use App\Http\Services\ResalService;
use App\Http\Services\UploadService;
use App\Models\Transfer;
use App\Models\Upload;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;

/**
 * Class TransferCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TransferCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Transfer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/transfer');
        CRUD::setEntityNameStrings(trans('backpack::base.transfer'), trans('backpack::base.transfers'));

        if (backpack_auth()->user()->hasRole('charity')) {
            $this->crud->addClause('where', 'user_id', '=', backpack_user()->id);
        }

        if (backpack_auth()->user()->hasRole(User::ROLE_ADMIN)) {
            $this->crud->denyAccess(['create']);
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::disableResponsiveTable();
        CRUD::column('id')->label('#');
        $this->crud->addColumn([
            'name' => 'amount',
            'label' => trans('backpack::base.amount'),
            'value' => fn($entry) => convertToSar($entry->amount),
        ]);
        CRUD::column('from_name')->label(trans('backpack::base.transfer_dashboard.from_name'));
        CRUD::column('created_at')->label(trans('backpack::base.dashboard_home.created_at'));

        $this->crud->addColumn([
            'name' => 'status',
            'label' => trans('backpack::base.dashboard_home.status'),
            'value' => fn($entry) => trans('backpack::base.transfer_status.' . $entry->status->key),
        ]);

        if (backpack_user()->hasRole(User::ROLE_ADMIN)) {
            $this->crud->addButtonFromView('line', 'status', 'status', 'end');
        }

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {

        CRUD::setValidation(TransferRequest::class);

        CRUD::field('amount')->label(trans('backpack::base.amount'));
        CRUD::field('from_name')->label(trans('backpack::base.transfer_dashboard.from_name'));
        $this->crud->addField([
            'name' => 'receipt',
            'label' => trans('backpack::base.transfer_dashboard.receipt'),
            'type' => 'custom_upload',
            'upload' => true,
            'disk' => 's3',
            'prefix' => 'receipt',
            'accept' => 'image/*',
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }


    public function store(UploadService $uploadService)
    {
        $this->crud->getRequest()->request->add(['user_id' => backpack_user()->id]);

        $request = $this->crud->getRequest();

        // ****** Code From traitStore() ******//
        $this->crud->hasAccessOrFail('create');
        $request = $this->crud->validateRequest();
        $this->crud->registerFieldEvents();
        // ****** /////////////////// ******//

        $file = $request->file('receipt');

        $this->crud->getRequest()->request->remove('receipt');
        $request['amount'] = convertToHallal($request->input('amount'));

        $transfer = new Transfer();
        \DB::transaction(function () use ($transfer, $uploadService, $request, $file) {
            // insert item in the db
            $item = $this->crud->create($request->all());
            $this->data['entry'] = $this->crud->entry = $item;
            if ($file) {
                $uploadService->uploadFile($file, Upload::RECEIPT, $item);
            }
        });


        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction();
    }


    protected function setupAcceptRoutes($segment, $routeName, $controller)
    {
        Route::post($segment . '/{id}/accept_transfer', [
            'as' => $routeName . '.accept',
            'uses' => $controller . '@accept',
            'operation' => 'accept',
        ]);
    }


    protected function accept($id, ResalService $resalService)
    {
        if (!backpack_user()->hasRole(User::ROLE_ADMIN)) {
            return $this->crud->denyAccess('not allowed');
        }

        $transfer = Transfer::query()->findOrFail($id);

        if ($transfer->status->value != TransferStatus::PENINDING) {
            \Alert::error('transfer not pending status')->flash();
            return back();
        }

        $balance = $transfer->user->balance;

        // check if we have enough balance
        if ($resalService->balance() < convertToSar($transfer->amount)) {
            \Alert::error('balance in daleel store not enough')->flash();

            return back();
        }

        \DB::transaction(function () use ($transfer, $balance) {
            // check balance api
            $transfer->trackingBalance()->create([
                'old_balance' => $balance->amount,
                'new_balance' => ($balance->amount + $transfer->amount),
                'action_by' => backpack_user()->id
            ]);

            $transfer->update([
                'status' => TransferStatus::APPROVE
            ]);

            $balance->increment('amount', $transfer->amount);
        });

        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        return back();
    }

    protected function setupRejectRoutes($segment, $routeName, $controller)
    {
        Route::post($segment . '/{id}/reject_reject', [
            'as' => $routeName . '.reject',
            'uses' => $controller . '@reject',
            'operation' => 'reject',
        ]);
    }


    protected function reject($id)
    {
        if (!backpack_user()->hasRole(\App\Models\User::ROLE_ADMIN)) {
            return $this->crud->denyAccess('not allowed');
        }

        $transfer = Transfer::query()->findOrFail($id);

        if ($transfer->status->value != TransferStatus::PENINDING) {
            \Alert::error('transfer not pending status')->flash();
            return back();
        }

        $transfer->update([
            'status' => TransferStatus::REJECT,
            'reject_by' => backpack_user()->id
        ]);

        \Alert::success(trans('reject successfully'))->flash();

        return back();
    }


    protected function setupShowOperation()
    {
        $this->setupListOperation();
        CRUD::column('id')->label('#');

        $this->crud->addColumn([
            'name' => 'status',
            'label' => trans('backpack::base.dashboard_home.status'),
            'value' => fn($entry) => trans('backpack::base.transfer_status.' . $entry->status->key),
        ]);


        $this->crud->addColumn([
            'label' => trans('backpack::base.image'),
            'type' => 'image',
            'value' => UploadService::getFullPublicUrl($this->crud->getCurrentEntry()->upload?->file_name, Upload::RECEIPT),
            'height' => '500px',
            'width' => '500px',
        ]);
    }


}
