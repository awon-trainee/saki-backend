<?php

namespace App\Http\Controllers\Admin;

use App\Imports\BeneficiariesImport;
use App\Models\Beneficiaries;
use App\Models\User;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\BeneficiariesRequest;
use Propaganistas\LaravelPhone\PhoneNumber;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;

/**
 * Class BeneficiariesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BeneficiariesCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Beneficiaries::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/beneficiaries');
        CRUD::setEntityNameStrings(trans('backpack::base.sidebar.beneficiary'), trans('backpack::base.sidebar.beneficiaries'));
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
        CRUD::column('name')->label(trans('backpack::base.name'));
        CRUD::column('email')->label(trans('backpack::base.email_address'));
        CRUD::column('phone')->label(trans('backpack::base.phone'));
        CRUD::addColumn([
            'name' => trans('backpack::base.balance'),
            'value' => fn($entry) => convertToSar($entry->balance->amount),
        ]);
        CRUD::column('user.charity_name')->label(trans('backpack::base.roles.charity'));
        // CRUD::column('nationality')->label(trans('backpack::base.dashboard_home.nationality'));
        CRUD::addColumn([
            'name' => 'nationality',
            'label' => trans('backpack::base.dashboard_home.nationality'),
            'entity' => false,
            'value' => fn($entry) => $entry->nationality[app()->getLocale() == 'ar' ? 'nationality_ar' : 'nationality_en'],
        ]);
        CRUD::addButtonFromView('top', 'import_beneficiaries', 'import_beneficiaries', 'end');
        Widget::add([
            'type' => 'view',
            'view' => 'backpack::ui.widgets.import_beneficiaries_modal',
        ]);
        Widget::add([
            'type' => 'view',
            'view' => 'backpack::ui.widgets.import_beneficiaries_failures',
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
        CRUD::setValidation(BeneficiariesRequest::class);

        CRUD::field('id_number')->label(trans('backpack::base.dashboard_home.id_number'));
        CRUD::field('name')->label(trans('backpack::base.name'));
        CRUD::field('email')->label(trans('backpack::base.email_address'));
        CRUD::addField([
            'name' => 'phone',
            'label' => trans('backpack::base.phone'),
            'type' => 'phone',
            'config' => [
                'onlyCountries' => ['sa'],
                'initialCountry' => 'sa',
                'separateDialCode' => true,
                'nationalMode' => true,
                'autoHideDialCode' => false,
                'placeholderNumberType' => 'MOBILE',
            ]
        ]);
        // CRUD::field('nationality_id')->label(trans('backpack::base.dashboard_home.nationality'));
        CRUD::addField([  // Select2
            'label' => trans('backpack::base.dashboard_home.nationality'),
            'type' => 'select2',
            'name' => 'nationality_id', // the db column for the foreign key

            // optional
            'entity' => 'nationality', // the method that defines the relationship in your Model
            'model' => "App\Models\Country", // foreign key model
            'attribute' => app()->getLocale() == 'ar' ? 'nationality_ar' : 'nationality_en', // foreign key attribute that is shown to user

            //  // also optional
            // 'options'   => (function ($query) {
            //      return $query->orderBy('name', 'ASC')->where('depth', 1)->get();
            //  }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);
        CRUD::field('monthly_income')->label(trans('backpack::base.dashboard_home.monthly_income'));
        CRUD::field('income_source')->label(trans('backpack::base.dashboard_home.income_source'));
        CRUD::field('id_number')->label(trans('backpack::base.dashboard_home.id_number'));
        #CRUD::field('categories')->label(trans('backpack::base.sidebar.categories'));
        CRUD::addField([
            'name' => 'gender',
            'label' => trans('backpack::base.beneficiaries.gender'),
            'type' => 'enum',
            // optional, specify the enum options with custom display values
            'options' => [
                'male' => trans('backpack::base.beneficiaries.male'),
                'female' => trans('backpack::base.beneficiaries.female'),
            ]
        ]);
        CRUD::addField([
            'name' => 'material_status',
            'label' => trans('backpack::base.beneficiaries.material_status'),
            'type' => 'enum',
            // optional, specify the enum options with custom display values
            'options' => [
                'married' => trans('backpack::base.beneficiaries.married'),
                'single' => trans('backpack::base.beneficiaries.single'),
                'widower' => trans('backpack::base.beneficiaries.widower'),
                'divorced' => trans('backpack::base.beneficiaries.divorced'),
            ]
        ]);

        // if the current user is admin
        if (checkRolesAndPermission(User::ROLE_ADMIN)) {
            // add a CRUD field for user_id, that is a select showing all users with type User::CHARITY
            $charities = User::where('type', User::CHARITY)->get();
            $charities = $charities->pluck('charity_name', 'id')->toArray();
            CRUD::addField([
                'name' => 'user_id',
                'label' => trans('backpack::base.roles.charity'),
                'type' => 'select2_from_array',
                'options' => $charities,
                'allows_null' => false,
                'allows_multiple' => false,
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
    }


    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');

        $charity_user_id = backpack_auth()->id();

        if (backpack_user()->type == User::ADMIN) {
            $charity_user_id = $this->crud->getEntry($id)->user_id;
        }
        // delete associated balance
        $this->crud->getEntry($id)->balance()->delete();
        return $this->crud->addClause('where', 'user_id', '=', $charity_user_id)->delete($id);
    }


    public function store()
    {
        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $this->crud->setRequest($this->handleInput($this->crud->getRequest()));
        $request = $this->crud->getRequest();

        $current_user = backpack_user();
        if ($current_user->type == User::CHARITY) {
            $request['user_id'] = $current_user->id;
        }

        // register any Model Events defined on fields
        $this->crud->registerFieldEvents();

        // insert item in the db
        $item = \DB::transaction(function () use ($request) {
            $item = $this->crud->create($request->all());
            $this->data['entry'] = $this->crud->entry = $item;
            $this->data['entry']->balance()->create(['amount' => '0']);;
            return $item;
        });

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
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

    /**
     * Handle phone input field.
     *
     * @return \Illuminate\Http\Request
     */
    protected function handleInput($request)
    {
        $request = $this->crud->validateRequest();

        $full_phone = new PhoneNumber($request->input('phone'), 'SA');
        $request->request->set('phone', $full_phone->formatE164());
        // validate phone number is unique
        $request->validate([
            'phone' => [
                'required',
                Rule::unique('beneficiaries')->ignore($request->input('id')),
            ],
        ]);

        return $request;
    }

    protected function setupImportRoutes($segment, $routeName, $controller)
    {
        Route::post($segment . '/import', [
            'as' => $routeName . '.import',
            'uses' => $controller . '@import',
            'operation' => 'import',
        ]);
    }

    // method import that will accept an uploaded file to import
    public function import()
    {
        // $this->crud->hasAccessOrFail('import');

        $this->crud->setValidation([
            'import_file' => 'required|file|mimes:xlsx,csv,xls,xml|max:5120',
            'user_id' => checkRolesAndPermission(User::ROLE_ADMIN) ? 'required|exists:users,id' : 'prohibited',
        ]);

        $this->crud->setRequest($this->crud->validateRequest());
        $request = $this->crud->getRequest();

        $import_file = $request->file('import_file');

        $user_id = checkRolesAndPermission(User::ROLE_ADMIN) ? $request['user_id'] : backpack_user()->id;

        $import = new BeneficiariesImport($user_id);
        $import->import($import_file);

        $importing_errors = [];
        // $failures = $failures->sortBy(fn($f) => $f->row())->groupBy(fn($f) => $f->row());
        foreach ($import->custom_failures as $row_failure) {
            $row = trans('backpack::crud.row') . ' ' . $row_failure['row'];
            foreach ($row_failure['errors'] as $errors) {
                foreach ($errors as $error) {
                    $importing_errors[$row][] = $error;
                }
            }
        }

        if ($import->successful_count > 0) {
            \Alert::success(trans('backpack::crud.import_success', ['count' => $import->successful_count]))->flash();
        }

        if ($importing_errors) {
            \Alert::error(trans('backpack::crud.import_failed', ['count' => count($importing_errors)]))->flash();
            return redirect()->back()->with('importing_errors', $importing_errors);
        }
        return redirect()->back()->with('success', 'Imported successfully');
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
        // $this->crud->hasAccessOrFail('export');

        return Excel::download(new \App\Exports\BeneficiariesExport, 'beneficiaries.xlsx');
    }

}
