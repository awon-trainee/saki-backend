<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MarketStatus;
use App\Http\Requests\MarketRequest;
use App\Http\Services\DaleelStoreService;
use App\Http\Services\UploadService;
use App\Models\Market;
use App\Models\ResalProduct;
use App\Models\Upload;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Storage;
use function GuzzleHttp\Promise\all;

/**
 * Class MarketCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MarketCrudController extends CrudController
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
        CRUD::setModel(Market::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/market');
        CRUD::setEntityNameStrings(trans('backpack::base.sidebar.markets'), trans('backpack::base.sidebar.markets'));

        if (checkRolesAndPermission(User::ROLE_CHARITY)) {
            $this->crud->addClause('where', 'user_id', backpack_user()->id);
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
        CRUD::column('id')->label('#');
        CRUD::column('name')->label(trans('backpack::base.name'));
        CRUD::column('description')->label(trans('backpack::base.description'));
        $this->crud->addColumn([
            'name' => 'status',
            'label' => trans('backpack::base.dashboard_home.status'),
            'value' => fn($entry) => trans("backpack::base.dashboard_home.status_{$entry->status->key}"),
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

        CRUD::setValidation(MarketRequest::class);

        CRUD::field('name')->label(trans('backpack::base.name'));
        CRUD::field('description')->label(trans('backpack::base.description'));
        $this->crud->addField([
            'name' => 'image',
            'label' => trans('backpack::base.image'),
            'type' => 'upload',
            'upload' => true,
            // 'disk' => 's3',
            'prefix' => 'market'
        ]);
        $this->crud->addField([
            'name' => 'background_image',
            'label' => trans('backpack::base.background_image'),
            'type' => 'upload',
            'upload' => true,
            // 'disk' => 's3',
            'prefix' => 'market'
        ]);


        CRUD::field('support_delivery')->label(trans('backpack::base.support_delivery'));
        CRUD::field('status')->label(trans('backpack::base.dashboard_home.status'));
        // CRUD::field('category')->label(trans('backpack::base.sidebar.categories'));
        CRUD::addField([
            'name' => 'category',
            'label' => trans('backpack::base.sidebar.categories'),
            'type' => 'select2_multiple',
            'entity' => 'category',
            'attribute' => 'name',
            'options' => (function ($query) {
                if (checkRolesAndPermission(User::ROLE_ADMIN)) {
                    return $query->get();
                }
                return $query->where('user_id', backpack_user()->id)->get();
            }),
        ]);


        $this->crud->addField([
            'label' => trans('validation.attributes.resal_product_id'),
            'name' => 'resal_product_id',
            'type' => 'select2',
            'entity' => 'resalProduct',
            'attribute' => 'title',
            'model' => ResalProduct::class,
        ]);

        if (checkRolesAndPermission(User::ROLE_CHARITY)) {
            $this->crud->addField([
                'name' => 'user_id',
                'type' => 'hidden',
                'value' => backpack_user()->id
            ]);
        } else if (checkRolesAndPermission(User::ROLE_ADMIN)) {
            $this->crud->addField([
                'label' => trans('backpack::base.user'),
                'name' => 'user_id',
                'type' => 'select2',
                'entity' => 'user',
                'attribute' => 'name',
                'model' => User::class,
            ]);
        }

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

        // CRUD::field('name')->label(trans('backpack::base.name'));
        // CRUD::field('description')->label(trans('backpack::base.description'));
        // CRUD::field('category')->label(trans('backpack::base.sidebar.categories'));
        // CRUD::field('status')->label(trans('backpack::base.dashboard_home.status'));
        // $this->crud->addField([
        //     'name' => 'image',
        //     'label' => trans('backpack::base.image'),
        //     'type' => 'upload',
        //     'upload' => true,
        //     'disk' => 's3',
        //     'prefix' => 'market'
        // ]);
        //
        // $this->crud->addField([
        //     'name' => 'background_image',
        //     'label' => trans('backpack::base.background_image'),
        //     'type' => 'upload',
        //     'upload' => true,
        //     'disk' => 's3',
        //     'prefix' => 'market'
        // ]);
    }


    protected function setupShowOperation()
    {
        $this->setupListOperation();

        CRUD::column('id')->label('#');
        CRUD::column('name')->label(trans('backpack::base.name'));

        $this->crud->addColumn([
            'name' => 'status',
            'label' => trans('backpack::base.dashboard_home.status'),
            'value' => fn($entry) => $entry->status->key,
        ]);


        $this->crud->addColumn([
            'label' => trans('backpack::base.image'),
            'type' => 'image',
            'value' => UploadService::getFullPublicUrl($this->crud->getCurrentEntry()->upload?->where('background', false)->first()->file_name, Upload::MARKET),
            'height' => '500px',
            'width' => '500px',
        ]);
        $this->crud->addColumn([
            'label' => trans('backpack::base.background_image'),
            'type' => 'image',
            'value' => UploadService::getFullPublicUrl($this->crud->getCurrentEntry()->upload?->where('background', true)->first()->file_name, Upload::MARKET),
            'height' => '500px',
            'width' => '500px',
        ]);
    }


    public function store(UploadService $uploadService)
    {

        $request = $this->crud->getRequest();

        // ****** Code From traitStore() ******//
        $this->crud->hasAccessOrFail('create');
        $request = $this->crud->validateRequest();
        $this->crud->registerFieldEvents();
        // ****** /////////////////// ******//

        $file = $request->file('image');
        $background_image = $request->file('background_image');

        $this->crud->getRequest()->request->remove('image');

        // insert item in the db
        $item = $this->crud->create($request->all());
        $this->data['entry'] = $this->crud->entry = $item;
        if ($file) {
            $uploadService->uploadFile($file, Upload::MARKET, $item);
        }
        if ($background_image) {
            $uploadService->uploadFile($background_image, Upload::MARKET, $item, true);
        }


        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction();
    }


    public function update(UploadService $uploadService)
    {
        /** @var SpeakerRequest $request */
        $request = $this->crud->getRequest();

        $file = $request->file('image');
        $background_image = $request->file('background_image');

        $this->crud->removeField('image');

        // ****** Code From traitStore() ******//
        $this->crud->hasAccessOrFail('update');
        $request = $this->crud->validateRequest();
        $this->crud->registerFieldEvents();
        // ****** /////////////////// ******//

        \DB::transaction(function () use ($uploadService, $request, $file, $background_image) {
            $this->crud->update($this->crud->getCurrentEntryId(), $this->crud->getStrippedSaveRequest($request));
            $this->data['entry'] = $this->crud->entry = $this->crud->getCurrentEntry();
            if ($file) {
                $uploadService->uploadFile($file, Upload::MARKET, $this->crud->getCurrentEntry());
            }
            if ($background_image) {
                $uploadService->uploadFile($background_image, Upload::MARKET, $this->crud->getCurrentEntry(), true);
            }
        });

        \Alert::success(trans('backpack::crud.update_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($this->crud->getCurrentEntry()->getKey());
    }
}
