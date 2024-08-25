<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PurchaseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class PurchaseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PurchaseCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

    #use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
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
        CRUD::setModel(\App\Models\Purchase::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/purchase');
        CRUD::setEntityNameStrings(trans('backpack::base.dashboard_home.Purchase'), trans('backpack::base.dashboard_home.Purchase'));
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        CRUD::column('beneficiary.name')->label(trans('backpack::base.sidebar.beneficiaries'));
        CRUD::column('status')->label(trans('backpack::base.dashboard_home.status'));
        CRUD::addColumn([
            'name' => trans('backpack::base.sidebar.items'),
            'value' => fn($entry) => $entry->item->resalProduct->title . ' - ' . $entry->item->value,
        ]);
        CRUD::column('qty')->label(trans('backpack::base.qty'));
        CRUD::column('resal_redemption_id')->label(trans('backpack::base.dashboard_home.purchase_resal_id'));
        CRUD::addColumn([
            'name' => trans('backpack::base.amount'),
            // 'value'     => fn($entry) => convertToSar($entry->amount),
            'value' => fn($entry) => $entry->amount,
        ]);
        // CRUD::addColumn([
        //     'name' => trans('backpack::base.dashboard_home.card'),
        //     'value' => fn($entry) => Str::substr($entry->code, 0, -8) . Str::repeat('*', Str::length($entry->code) - 8),
        // ]);

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
        CRUD::setValidation(PurchaseRequest::class);

        CRUD::field('beneficiaries_id');
        CRUD::field('status');
        CRUD::field('amount');
        CRUD::field('item_id');
        CRUD::field('qty');
        CRUD::field('purchase_daleel_id');
        CRUD::field('card');
        CRUD::field('serial');

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


    // if you just want to show the same columns as inside ListOperation
    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }

    protected function setupExportRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/export', [
            'as' => $routeName . '.export',
            'uses' => $controller . '@export',
            'operation' => 'export',
        ]);
    }

    public function export()
    {
        return Excel::download(new \App\Exports\PurchasesExport(), 'purchases.xlsx');
    }

}
