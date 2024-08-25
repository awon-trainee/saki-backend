<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DaleelStoreMarketRequest;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DaleelStoreMarketCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DaleelStoreMarketCrudController extends CrudController
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
        if(! checkRolesAndPermission(User::ROLE_ADMIN)) {
            $this->crud->denyAccess(['list', 'create', 'delete', 'edit', 'show', 'update', 'clone', 'reorder', 'revisions', 'details']);
        }

        CRUD::setModel(\App\Models\DaleelStoreMarket::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/daleel-store-market');
        CRUD::setEntityNameStrings('daleel store market', 'daleel store markets');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::column('daleel_store_id');
        CRUD::column('product');
        CRUD::column('category');
        CRUD::column('store');
        CRUD::column('amount');
        CRUD::column('description');
        $this->crud->addColumn([
            'name' => 'price',
            'value' => fn($entry) => convertToSar($entry->price),
        ]);
        CRUD::column('has_vat');
        CRUD::column('status');
        CRUD::column('created_at');
        CRUD::column('updated_at');

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
        CRUD::setValidation(DaleelStoreMarketRequest::class);

        CRUD::field('daleel_store_id');
        CRUD::field('product');
        CRUD::field('category');
        CRUD::field('store');
        CRUD::field('amount');
        CRUD::field('description');
        CRUD::field('price');
        CRUD::field('has_vat');
        CRUD::field('status');

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
}
