<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use Propaganistas\LaravelPhone\PhoneNumber;
use Database\Seeders\RolesAndPermissionsSeeder;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation {
        destroy as traitDestroy;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings(trans('backpack::base.user'), trans('backpack::base.user'));

        if (!checkRolesAndPermission(User::ROLE_ADMIN)) {
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
        CRUD::column('name')->label(trans('backpack::base.name'));
        CRUD::column('email')->label(trans('backpack::base.email_address'));
        CRUD::column('charity_name')->label(trans('backpack::base.charity_name'));


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
        CRUD::addFields([
            [
                'name' => 'name',
                'label' => trans('backpack::base.name'),
                'type' => 'text',
            ],
            [
                'name' => 'email',
                'label' => trans('backpack::base.email_address'),
                'type' => 'email',
            ],
            [
                'name' => 'phone',
                'label' => trans('backpack::base.phone'),
                'type' => 'text',
            ],
            [
                'name' => 'password',
                'label' => trans('backpack::base.password'),
                'type' => 'password',
            ],
            [
                'name' => 'password_confirmation',
                'label' => trans('backpack::base.confirm_password'),
                'type' => 'password',
            ],
            [
                'name' => 'type',
                'label' => trans('backpack::base.roles.role'),
                'type' => 'enum',
                'options' => [
                    User::ADMIN => trans('backpack::base.roles.admin'),
                    User::CHARITY => trans('backpack::base.roles.charity')
                ],
                'default' => User::CHARITY,
            ],
            [
                'name' => 'charity_name',
                'label' => trans('backpack::base.charity_name'),
                'type' => 'text',
            ]
        ]);
        CRUD::setValidation(UserRequest::class);

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

        CRUD::removeField('type');
        // if entry is admin, remove charity_name field
        if ($this->crud->getCurrentEntry()->type == User::ADMIN) {
            CRUD::removeField('charity_name');
        }
    }

    /**
     * Store a newly created resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->crud->hasAccessOrFail('create');
        $this->crud->setRequest($this->handleInput($this->crud->getRequest()));
        $this->crud->unsetValidation();

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();

        // register any Model Events defined on fields
        $this->crud->registerFieldEvents();

        // insert item in the db
        $user = \DB::transaction(function() use ($request) {
            $user = $this->crud->create($request->only('name' , 'email' , 'phone' , 'type' , 'charity_name' , 'password'));
            $this->data['entry'] = $this->crud->entry = $user;

            if ($user->type == User::ADMIN) {
                $user->syncRoles(User::ROLE_ADMIN);
            } else {
                $user->syncRoles(User::ROLE_CHARITY);
                $user->balance()->create(['amount' => '0']);
            }

            return $user;
        });


        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($user->getKey());
    }

    /**
     * Update the specified resource in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $this->crud->setRequest($this->handleInput($this->crud->getRequest()));
        $this->crud->unsetValidation(); // validation has already been run

        return $this->traitUpdate();
    }

    public function destroy($id)
    {
        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;

        $this->crud->hasAccessOrFail('delete');
        $user = User::findOrFail($id);
        if ($user->type == User::CHARITY) {
            $user->balance()->delete();
        }
        return $this->crud->delete($id);
    }

    /**
     * Handle password and phone input fields.
     *
     * @return \Illuminate\Http\Request
     */
    protected function handleInput($request)
    {
        $request = $this->crud->validateRequest();
        // Remove fields not present on the user.
        $request->request->remove('password_confirmation');

        // Encrypt password if specified.
        if ($request->input('password')) {
            $request->request->set('password', bcrypt($request->input('password')));
        } else {
            $request->request->remove('password');
        }

        $full_phone = new PhoneNumber($request->input('phone'), 'SA');
        $request->request->set('phone', $full_phone->formatE164());
        // validate phone number is unique
        $request->validate([
            'phone' => [
                'required',
                Rule::unique('users')->ignore($request->route('id')),
            ],
        ]);

        return $request;
    }
}
