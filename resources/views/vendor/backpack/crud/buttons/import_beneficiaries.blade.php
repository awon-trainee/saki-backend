<div class="d-inline px-1">
    @csrf

    {{-- <button onclick="return confirm('are you sure ?')" class="btn btn-pill btn-sm btn-block btn-success active" aria-pressed="true">Accept</button> --}}
    <button type="button" class="btn btn-primary" data-style="zoom-in" data-toggle="modal" data-target="#importModal">
        <span class="ladda-label">
            <i class="la la-arrow-up"></i>
            {{ trans('backpack::crud.import') }} {{ $crud->entity_name_plural }}
        </span>
    </button>
</div>