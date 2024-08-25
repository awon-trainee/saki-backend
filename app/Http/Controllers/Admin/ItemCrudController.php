<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItemRequest;
use App\Models\DaleelStoreMarket;
use App\Models\Item;
use App\Models\Market;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ItemCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ItemCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    #use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;



    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Item::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/item');
        CRUD::setEntityNameStrings(trans('backpack::base.sidebar.items'), trans('backpack::base.sidebar.items'));

        if(! checkRolesAndPermission(User::ROLE_ADMIN)) {
            $this->crud->denyAccess(['list', 'create', 'delete', 'edit', 'show', 'update', 'clone', 'reorder', 'revisions', 'details']);
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
        CRUD::column('id');
        CRUD::column('market');
        CRUD::column('daleelStoreMarket.product')->label(trans('backpack::base.sidebar.daleel_store_market'));
        CRUD::column('daleelStoreMarket.amount')->label(trans('backpack::base.amount'));
        $this->crud->addColumn([
            'name' => trans('backpack::base.amount'),
            'value' => fn($entry) => convertToSar($entry->daleelStoreMarket->price),
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
        CRUD::setValidation(ItemRequest::class);
        CRUD::field('daleelStoreMarket.daleel_store_id')->type('select2_multiple')->label('daleel store id');
        CRUD::field('market_id')->label(trans('backpack::base.sidebar.markets'));


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
        $this->crud->hasAccessOrFail('create');
        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();

        $market = Market::query()->findOrFail($request->input('market_id'));

        $daleelStoreMarket = DaleelStoreMarket::query()->findOrFail(array_values($request->input('daleelStoreMarket.daleel_store_id')));
        // register any Model Events defined on fields
        $this->crud->registerFieldEvents();

        \DB::transaction(function() use ($daleelStoreMarket , $market) {
            foreach ($daleelStoreMarket as $daleelMarket) {
                if(Item::query()->where('daleel_store_market_id' , $daleelMarket->id)->exists()) {
                    continue;
                }
                $this->crud->create([
                    'market_id' => $market->id,
                    'daleel_store_market_id' => $daleelMarket->id,
                    'amount' => $daleelMarket->price
                ]);
            }
        });

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return redirect(backpack_url('item'));

    }


}
