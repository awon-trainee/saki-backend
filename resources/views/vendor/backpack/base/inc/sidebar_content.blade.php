{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i
                class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('transfer') }}"><i class="nav-icon la la-dollar"></i>
        {{trans('backpack::base.transfer')}}</a></li>
@if(checkRolesAndPermission(\App\Models\User::ROLE_ADMIN))
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('country') }}"><i
                    class="nav-icon la la-flag"></i>
            {{trans('backpack::base.country')}}</a></li>
@endif

@if( checkRolesAndPermission(\App\Models\User::ROLE_ADMIN))
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('purchase') }}"><i
                    class="nav-icon la la-shopping-cart"></i>
            {{trans('backpack::base.dashboard_home.Purchase')}}</a></li>
@endif


@if( checkRolesAndPermission(\App\Models\User::ROLE_ADMIN))
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-users"></i>
            {{trans('backpack::base.sidebar.users')}}</a>
    </li>
@endif


<li class="nav-item"><a class="nav-link" href="{{ backpack_url('beneficiaries') }}"><i
                class="nav-icon la la-users"></i> {{trans('backpack::base.sidebar.beneficiaries')}}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('balance') }}"><i class="nav-icon la la-dollar"></i>
        {{trans('backpack::base.balance')}}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('resal-variant') }}"><i
                class="nav-icon la la-shopping-cart"></i> {{trans('backpack::base.sidebar.resal_variants')}}</a>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('category') }}"><i
                class="nav-icon la la-list"></i> {{trans('backpack::base.sidebar.categories')}}</a></li>

<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('market') }}">
        <i class="nav-icon la la-shopping-cart"></i>
        {{trans('backpack::base.sidebar.markets')}}
    </a>
</li>