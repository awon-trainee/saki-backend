<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ResalVariantRequest;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ResalVariantCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ResalVariantCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

    // use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\ResalVariant::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/resal-variant');
        CRUD::setEntityNameStrings(trans('backpack::base.sidebar.resal_variants'), trans('backpack::base.sidebar.resal_variants'));
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'resal_product_id',
            'type' => 'relationship',
            'label' => 'Product',
            'attribute' => 'title',
            'relation_type' => 'belongsTo',
            'entity' => 'resalProduct',
            'searchLogic' => function ($query, $searchTerm, $searchField) {
                $query->whereHas('resalProduct', function ($query) use ($searchField) {
                    $query->where('title', 'like', '%' . $searchField . '%');
                });
            },
        ]);
        CRUD::column('value');
        CRUD::column('price_with_vat');
        CRUD::column('display');
        CRUD::column('quantity');

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
        CRUD::setValidation(ResalVariantRequest::class);

        CRUD::field('resal_product_id');
        CRUD::field('value');
        CRUD::field('price_with_vat');
        CRUD::field('display');
        CRUD::field('barcode');

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
