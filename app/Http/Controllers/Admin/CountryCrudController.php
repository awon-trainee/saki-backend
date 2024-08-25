<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CountryRequest;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CountryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CountryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Country::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/country');
        CRUD::setEntityNameStrings(trans('backpack::base.country'), trans('backpack::base.country'));


        if(! checkRolesAndPermission(User::ROLE_ADMIN)) {
            $this->crud->denyAccess(['create', 'delete', 'edit', 'show', 'update', 'clone', 'reorder', 'revisions', 'details']);
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
        CRUD::column('code')->label(trans('backpack::base.code'));
        CRUD::column('name_en')->label(trans('backpack::base.name_country_en'));
        CRUD::column('name_ar')->label(trans('backpack::base.name_country_ar'));
        CRUD::column('nationality_en')->label(trans('backpack::base.nationality_en'));
        CRUD::column('nationality_ar')->label(trans('backpack::base.nationality_ar'));
        CRUD::column('created_at')->label(trans('backpack::base.dashboard_home.created_at'));

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
        CRUD::setValidation(CountryRequest::class);

        CRUD::field('name_en')->label(trans('backpack::base.name_country_en'));
        CRUD::field('name_ar')->label(trans('backpack::base.name_country_ar'));
        CRUD::field('nationality_en')->label(trans('backpack::base.nationality_en'));
        CRUD::field('nationality_ar')->label(trans('backpack::base.nationality_ar'));
        CRUD::field('code')->label(trans('backpack::base.code'));

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
