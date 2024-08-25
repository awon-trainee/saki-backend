{{-- This file is used to store topbar (right) items --}}

{{--<li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="la la-bell"></i><span class="badge badge-pill badge-danger">5</span></a></li>--}}
{{--<li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="la la-list"></i></a></li>--}}
{{--<li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="la la-map"></i></a></li>--}}

@if(checkRolesAndPermission(\App\Models\User::ROLE_CHARITY))
    <a class="badge badge-primary" href="#">{{convertToSar(backpack_user()->balance->amount)}} SAR</a>
@endif
@push('after_scripts')
    <script>
        $(document).ready(function () {
            $(".dataTables_info").hide()});
    </script>
@endpush
