<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BalanceRequest;
use App\Http\Services\ActivityLogService;
use App\Models\Beneficiaries;
use App\Models\TrackingBeneficiary;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BalanceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BalanceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    #use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    #use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Balance::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/balance');
        CRUD::setEntityNameStrings(trans('backpack::base.balance'), trans('backpack::base.balance'));

        if (checkRolesAndPermission(User::ROLE_CHARITY)) {
            $this->crud->addClause('where', 'user_type', Beneficiaries::class);
            $this->crud->addClause('whereHas' , 'user' , function($query) {
                $query->where('user_id' , backpack_user()->id);
            });
        }

        if(checkRolesAndPermission(User::ROLE_ADMIN)) {
            $this->crud->denyAccess(['create' , 'update', 'store']);
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

        if(checkRolesAndPermission(User::ROLE_ADMIN)) {
            $this->crud->addColumn([
                'name' => trans('backpack::base.name'),
                'label' => trans('backpack::base.type_of_beneficiary'),
                'value' => fn($entry) => $entry->user_type == Beneficiaries::class ? "تابع لجمعية ". $entry->user->user->charity_name : $entry->user->charity_name
            ]);
        }

        CRUD::column('user.name')->label(trans('backpack::base.name'));



        $this->crud->addColumn([
            'name' => 'amount',
            'label' => trans('backpack::base.amount'),
            'value' => fn($entry) => $entry->amount > 0 ? convertToSar($entry->amount) : "لايوجد رصيد",
        ]);

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
        CRUD::setValidation(BalanceRequest::class);

        CRUD::field('amount')->label(trans('backpack::base.amount'))->hint(trans('backpack::base.amount_hint'));

        $this->crud->addField([
            'label' => trans('backpack::base.sidebar.beneficiaries'),
            'type' => 'custom_select2_multiple',
            'name' => 'user',
            'entity' => 'user',
            'attribute' => ['phone', 'name'],
            'model' => "App\Models\Beneficiaries",
            'allows_null' => false,
            'select_all' => true,
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


    public function store()
    {
        $request = $this->crud->getRequest();

        // ****** Code From traitStore() ******//
        $this->crud->hasAccessOrFail('create');
        $request = $this->crud->validateRequest();
        $this->crud->registerFieldEvents();
        // ****** /////////////////// ******//


        $amount = convertToHallal($request->input('amount'));
        $beneficiaries = Beneficiaries::query()->where('user_id' , backpack_user()->id)->findOrFail($request->input('user'));
        $total = $beneficiaries->count() * $amount;
        if($total > backpack_user()->balance->amount) {
            \Alert::error(trans('api/dashboard.not_have_enough_balance'))->flash();
            return back();
        }

        \DB::transaction(function() use ($beneficiaries, $amount, $total) {
            foreach ($beneficiaries as $beneficiary) {

                (new ActivityLogService())->saveLogs(backpack_user() , $beneficiary , ActivityLogService::ADD_NEW_BALANCE , [
                    'beneficiary_name' => $beneficiary->name,
                    'old_balance' => $beneficiary->balance->amount,
                    'new_balance' => ($beneficiary->balance->amount + $amount),
                    'charity_name' => backpack_user()->charity_name,
                    'charity_id' => backpack_user()->id
                ] , ActivityLogService::ADD_NEW_BALANCE_LOG);


                $beneficiary->trackingBalanceBeneficiares()->create([
                    'old_balance' => $beneficiary->balance->amount,
                    'new_balance' => ($beneficiary->balance->amount + $amount),
                    'operation' => TrackingBeneficiary::TRANSFER,
                    'amount' => $amount
                ]);

                $beneficiary->balance()->increment('amount' , $amount);
            }

            backpack_user()->balance()->decrement('amount' , $total);
        });

        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction();
    }
}
