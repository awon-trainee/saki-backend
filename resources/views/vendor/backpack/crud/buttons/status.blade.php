@if (backpack_user()->hasRole(\App\Models\User::ROLE_ADMIN) && $entry->status->value == \App\Enums\TransferStatus::PENINDING)
    <form class="d-inline" action="{{ url($crud->route.'/'.$entry->getKey().'/accept_transfer') }}" method="POST">
        @csrf
    <div class="btn-group" role="group" aria-label="Basic example">

            <button onclick="return confirm('are you sure ?')" class="btn btn-success btn-sm"
                aria-pressed="true">{{ trans('backpack::base.transfer_status.accept') }}</button>

        </form>
        <form class="d-inline mx-2" action="{{ url($crud->route . '/' . $entry->getKey() . '/reject_reject') }}"
            method="POST">
            @csrf
            <button onclick="return confirm('are you sure ?')" class="btn btn-danger btn-sm"
                aria-pressed="true">{{ trans('backpack::base.transfer_status.reject') }}</button>
        </form>
    </div>
@endif
