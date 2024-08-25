@extends(backpack_view('blank'))

<style>
    .btn-primary {
        color: #fff !important;
    }
</style>

@section('content')
    <div class="row">
        <!-- /.col-->
        <div class="col-6 col-lg-3 card text-center bg-transparent border-0">
            <a class="btn btn-primary" href="{{backpack_url('/beneficiaries/export')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" style="width: 1rem">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75"/>
                </svg>
                {{trans('backpack::base.dashboard_home.export_beneficiaries')}}
            </a>
        </div>
        <!-- /.col-->
        <div class="col-6 col-lg-3 card text-center bg-transparent border-0">
            <a class="btn btn-primary" href="{{backpack_url('/purchase/export')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" style="width: 1rem">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75"/>
                </svg>
                {{trans('backpack::base.dashboard_home.export_purchases')}}
            </a>
        </div>
    </div>
    <div class="row">
        <!-- /.col-->
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center"><i
                            class="fa fa-cogs bg-primary p-3 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-primary">
                            @if(checkRolesAndPermission(\App\Models\User::ROLE_ADMIN))
                                {{\App\Models\Beneficiaries::count()}}
                            @else
                                {{\App\Models\Beneficiaries::query()->count()}}
                            @endif
                        </div>
                        <div class="text-muted text-uppercase font-weight-bold small">{{trans('backpack::base.sidebar.beneficiaries')}}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-3 d-flex align-items-center"><i
                            class="fa fa-laptop bg-info p-3 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-info">{{\App\Models\Purchase::count()}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">{{trans('backpack::base.dashboard_home.Purchase')}}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
        @if(checkRolesAndPermission(\App\Models\User::ROLE_ADMIN))
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center"><i
                                class="fa fa-moon-o bg-warning p-3 font-2xl mr-3"></i>
                        <div>
                            <div class="text-value-sm text-warning">{{\App\Models\User::query()->where('type' , \App\Models\User::CHARITY)->count()}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">{{trans('backpack::base.roles.charity')}}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- /.col-->
        @if(checkRolesAndPermission(\App\Models\User::ROLE_ADMIN))
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center"><i
                                class="fa fa-moon-o bg-warning p-3 font-2xl mr-3"></i>
                        <div>
                            <div class="text-value-sm text-warning">{{convertToSar(\App\Models\Balance::sum('amount'))}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">{{trans('backpack::base.balance')}}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(checkRolesAndPermission(\App\Models\User::ROLE_ADMIN))
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center"><i
                                class="fa fa-moon-o bg-warning p-3 font-2xl mr-3"></i>
                        <div>
                            <div class="text-value-sm text-warning">{{\App\Models\Market::count()}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">{{trans('backpack::base.sidebar.markets')}}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(checkRolesAndPermission(\App\Models\User::ROLE_ADMIN))
            <div class="col-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-3 d-flex align-items-center"><i
                                class="fa fa-moon-o bg-warning p-3 font-2xl mr-3"></i>
                        <div>
                            <div class="text-value-sm text-warning">{{\App\Models\Category::count()}}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">{{trans('backpack::base.sidebar.categories')}}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><i
                            class="fa fa-align-justify"></i> {{trans('backpack::base.dashboard_home.latest_purchase')}}
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('backpack::base.sidebar.beneficiaries')}}</th>
                            <th>{{trans('backpack::base.sidebar.markets')}}</th>
                            <th>{{trans('backpack::base.amount')}}</th>
                            <th>{{trans('backpack::base.dashboard_home.purchase_resal_id')}}</th>
                            <th>{{trans('backpack::base.dashboard_home.status')}}</th>
                            <th>{{trans('backpack::base.dashboard_home.created_at')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\Models\Purchase::query()->with('beneficiary')->orderByDesc('id')->limit(10)->get() as $purchase)
                            <tr>
                                <td>{{$purchase->id}}</td>
                                <td>{{$purchase->beneficiary->name}}</td>
                                <td>{{$purchase->item->resalProduct->market->name}}</td>
                                {{--                                <td>{{convertToSar($purchase->amount)}}</td>--}}
                                <td>{{$purchase->amount}}</td>
                                <td>{{$purchase->resal_redemption_id}}</td>
                                <td>
                                    <span class="badge badge-success">{{trans('backpack::base.dashboard_home.completed')}}</span>
                                </td>
                                <td>{{$purchase->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><i
                            class="fa fa-align-justify"></i> {{trans('backpack::base.dashboard_home.Latest_beneficiaries_register')}}
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('backpack::base.name')}}</th>
                            <th>{{trans('backpack::base.email_address')}}</th>
                            <th>{{trans('backpack::base.phone')}}</th>
                            <th>{{trans('backpack::base.dashboard_home.nationality')}}</th>
                            <th>{{trans('backpack::base.beneficiaries.gender')}}</th>
                            <th>{{trans('backpack::base.beneficiaries.material_status')}}</th>
                            <th>{{trans('backpack::base.dashboard_home.monthly_income')}}</th>
                            <th>{{trans('backpack::base.dashboard_home.created_at')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\Models\Beneficiaries::query()->with('balance')->orderByDesc('id')->limit(10)->get() as $beneficiary)
                            <tr>
                                <td>{{$beneficiary->id}}</td>
                                <td>{{$beneficiary->name}}</td>
                                <td>{{$beneficiary->email}}</td>
                                <td>{{$beneficiary->phone}}</td>
                                <td>{{$beneficiary->nationality->nationality_ar}}</td>
                                {{-- <td>{{$beneficiary->nationality}}</td> --}}
                                <td>{{$beneficiary->gender}}</td>
                                <td>{{$beneficiary->material_status}}</td>
                                <td>{{$beneficiary->monthly_income}}</td>
                                <td>{{$beneficiary->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
@endsection
