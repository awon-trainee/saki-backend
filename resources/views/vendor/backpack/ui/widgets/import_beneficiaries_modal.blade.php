@push('after_scripts')
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl p-3" role="document" style="max-width: unset !important">
            <form id="importSubmitForm" class="modal-content" action="{{ url($crud->route . '/import') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('backpack::crud.import') . ' ' . $crud->entity_name_plural }}</h5>
                    <button type="button" class="close mx-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- EXAMPLE TABLES --}}
                    <div id="modal-main-content" class="text-center">
                        <h5 class="modal-title">
                            {{ trans('backpack::crud.import_example') }}
                            (
                            <a href="{{ asset('assets/doc/قالب ملف الاستيراد.xlsx') }}" download>
                                {{ trans('backpack::crud.download_import_file') }}
                            </a>
                            )
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped-columns table-bordered">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col">#</th>
                                        <th scope="col">{{ trans('validation.attributes.id_number') }} (A)</th>
                                        <th scope="col">{{ trans('validation.attributes.name') }} (B)</th>
                                        <th scope="col">{{ trans('validation.attributes.email') }} (C)</th>
                                        <th scope="col">{{ trans('validation.attributes.phone') }} (D)</th>
                                        <th scope="col">{{ trans('validation.attributes.nationality_id') }} (E)</th>
                                        <th scope="col">{{ trans('validation.attributes.gender') }} (F)</th>
                                        <th scope="col">{{ trans('validation.attributes.material_status') }} (G)</th>
                                        <th scope="col">{{ trans('validation.attributes.monthly_income') }} (H)</th>
                                        <th scope="col">{{ trans('validation.attributes.income_source') }} (I)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>XXXXXXXXXX</td>
                                        <td>محمد أحمد</td>
                                        <td>example1@example.com</td>
                                        <td>05xxxxxxxx</td>
                                        <td>SA</td>
                                        <td>{{ trans('backpack::base.beneficiaries.male') }}</td>
                                        <td>{{ trans('backpack::base.beneficiaries.single') }}</td>
                                        <td>3500</td>
                                        <td>{{ trans('backpack::base.beneficiaries.example_income_source') }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>XXXXXXXXXX</td>
                                        <td>فاطمة أحمد</td>
                                        <td>example2@example.com</td>
                                        <td>5xxxxxxxx</td>
                                        <td>AE</td>
                                        <td>{{ trans('backpack::base.beneficiaries.female') }}</td>
                                        <td>{{ trans('backpack::base.beneficiaries.married') }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>XXXXXXXXXX</td>
                                        <td>أحمد أحمد</td>
                                        <td>example3@example.com</td>
                                        <td>9665xxxxxxxx</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ trans('backpack::base.beneficiaries.widower') }}</td>
                                        <td>3000</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>XXXXXXXXXX</td>
                                        <td>أحمد أحمد</td>
                                        <td></td>
                                        <td><span>+9665xxxxxxxx</span></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ trans('backpack::base.beneficiaries.divorced') }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>XXXXXXXXXX</td>
                                        <td>Ahmad Ahmad</td>
                                        <td>example5@example.com</td>
                                        <td><span>05xxxxxxxx</span></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">...</th>
                                        <td>...</td>
                                        <td>...</td>
                                        <td>...</td>
                                        <td>...</td>
                                        <td>...</td>
                                        <td>...</td>
                                        <td>...</td>
                                        <td>...</td>
                                        <td>...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h5 class="modal-title">{{ trans('backpack::crud.import_attributes') }} </h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped-columns table-bordered">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col">{{ trans('backpack::crud.attribute_name') }}</th>
                                        <th scope="col">{{ trans('backpack::crud.column_letter') }}</th>
                                        <th scope="col">{{ trans('backpack::crud.column_order') }}</th>
                                        <th scope="col">{{ trans('backpack::crud.type') }}</th>
                                        <th scope="col">{{ trans('backpack::crud.possible_values') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="col">{{ trans('validation.attributes.id_number') }}</th>
                                        <td scope="col">A</td>
                                        <td scope="col">1</td>
                                        <td scope="col">
                                            {{ trans('backpack::crud.required') . ' - ' . trans('backpack::crud.unique') }}
                                        </td>
                                        <td scope="col">{{ trans('validation.attributes.id_number') }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">{{ trans('validation.attributes.name') }}</th>
                                        <td scope="col">B</td>
                                        <td scope="col">2</td>
                                        <td scope="col">{{ trans('backpack::crud.required') }}</td>
                                        <td scope="col">{{ trans('backpack::crud.any_value') }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">{{ trans('validation.attributes.email') }}</th>
                                        <td scope="col">C</td>
                                        <td scope="col">3</td>
                                        <td scope="col">
                                            {{ trans('backpack::crud.optional') }}
                                        </td>
                                        <td scope="col">{{ trans('backpack::base.email_address') }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">{{ trans('validation.attributes.phone') }}</th>
                                        <td scope="col">D</td>
                                        <td scope="col">4</td>
                                        <td scope="col">
                                            {{ trans('backpack::crud.required') . ' - ' . trans('backpack::crud.unique') }}
                                        </td>
                                        <td scope="col">{{ trans('backpack::crud.saudi_phone') }}</td>

                                    </tr>
                                    <tr>
                                        <th scope="col">{{ trans('validation.attributes.nationality_id') }}</th>
                                        <td scope="col">E</td>
                                        <td scope="col">5</td>
                                        <td scope="col">{{ trans('backpack::crud.optional') }}</td>
                                        <td scope="col"><a
                                                href="/admin/country">{{ trans('backpack::crud.country_code') . ' - ' . trans('backpack::crud.click_here') }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col">{{ trans('validation.attributes.gender') }}</th>
                                        <td scope="col">F</td>
                                        <td scope="col">6</td>
                                        <td scope="col">{{ trans('backpack::crud.optional') }}</td>
                                        <td scope="col">
                                            {{ implode(' | ', [
                                                'ذكر',
                                                'رجل',
                                                'ولد',
                                                'انثى',
                                                'فتاه',
                                                'بنت',
                                                'male',
                                                'm',
                                                'man',
                                                'female',
                                                'f',
                                                'woman',
                                                'girl',
                                            ]) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col">{{ trans('validation.attributes.material_status') }}</th>
                                        <td scope="col">G</td>
                                        <td scope="col">7</td>
                                        <td scope="col">{{ trans('backpack::crud.optional') }}</td>
                                        <td scope="col">
                                            {{ implode(' | ', [
                                                'اعزب',
                                                'عازب',
                                                'عازبه',
                                                'متزوج',
                                                'متزوجه',
                                                'مطلق',
                                                'مطلقه',
                                                'منفصل',
                                                'منفصله',
                                                'ارمل',
                                                'ارمله',
                                                'single',
                                                'unmarried',
                                                'bachelor',
                                                'married',
                                                'wedded',
                                                'divorced',
                                                'separated',
                                                'widower',
                                                'bereaved',
                                                'widowed',
                                            ]) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col">{{ trans('validation.attributes.monthly_income') }}</th>
                                        <td scope="col">H</td>
                                        <td scope="col">8</td>
                                        <td scope="col">{{ trans('backpack::crud.optional') }}</td>
                                        <td scope="col">
                                            {{ trans('backpack::crud.any_value') . ' ' . trans('backpack::crud.integer') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col">{{ trans('validation.attributes.income_source') }}</th>
                                        <td scope="col">I</td>
                                        <td scope="col">9</td>
                                        <td scope="col">{{ trans('backpack::crud.optional') }}</td>
                                        <td scope="col">{{ trans('backpack::crud.any_value') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h5 class="modal-title">{{ trans('backpack::crud.upload_import_file') }} </h5>
                    <div>
                        <div class="file-upload">
                            <div class="file-select">
                                <div class="file-select-button" id="fileName">{{ trans('backpack::crud.chose_file') }}
                                </div>
                                <div class="file-select-name" id="noFile">-</div>
                                <input id="importFile" required name="import_file" type="file"
                                    accept=".xlsx,.csv,.xls,.xml" class="form-control border-0">
                            </div>
                        </div>
                    </div>
                    @if (backpack_user()->hasRole(\App\Models\User::ROLE_ADMIN))
                        <div class="mb-3">
                            <label>
                                {{ trans('backpack::base.roles.charity') }}
                            </label>
                            <select required name="user_id" class="form-select" aria-label="User id">
                                @foreach (\App\Models\User::where('type', \App\Models\User::CHARITY)->get() as $charity)
                                    <option value="{{ $charity->id }}">
                                        {{ $charity->charity_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('backpack::crud.cancel') }}</button>
                    <button id="importSubmitButton" type="submit" class="btn btn-primary">
                        {{ trans('backpack::crud.import') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Restricts file size
        let importFile = document.getElementById('importFile');
        importFile.onchange = function() {
            if (this.files[0].size > 5242880) {
                alert(
                    '{{ trans('validation.max.file', ['attribute' => trans('validation.attributes.import_file'), 'max' => 5120]) }}'
                );
                this.value = "";
            };
        };

        // Allo user to view more errors
        $('#importFile').bind('change', function() {
            var filename = $("#importFile").val();
            if (/^\s*$/.test(filename)) {
                $(".file-upload").removeClass('active');
                $("#noFile").text("-");
            } else {
                $(".file-upload").addClass('active');
                $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
            }
        });

        $(document).ready(function() {
            $("#importSubmitForm").submit(function() {
                $("#importSubmitButton").attr("disabled", true);
                $("#modal-main-content").html(
                    '<div class="lds-dual-ring"></div>'
                );
                return true;
            });
        });
    </script>
@endpush
