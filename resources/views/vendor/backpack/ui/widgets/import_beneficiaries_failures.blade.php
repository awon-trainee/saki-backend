@if ($errors->any() || Session::has('importing_errors'))
    @php
        $importing_errors = Session::get('importing_errors');
        $total_errors = isset($importing_errors) ? count($importing_errors) : 0;
        $show_errors = min($total_errors, 10);
    @endphp
    {{-- dd all available variables --}}
    <div class="alert alert-danger px-0 pb-0">
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li><i class="la la-info-circle"></i> {{ $error }}</li>
            @endforeach
            @isset($importing_errors)
                @for ($i = 0; $i < $show_errors; $i++)
                    <p class="mb-0"><i class="la la-info-circle"></i> {{ array_keys($importing_errors)[$i] }}:
                        @foreach ($importing_errors[array_keys($importing_errors)[$i]] as $errorNum => $error)
                            {{ $error }}
                        @endforeach
                    </p>
                @endfor
                @if ($total_errors > 10)
                    <button id="show-more-errors" class="btn btn-primary mt-3">{{trans('backpack::crud.show_more')}}</button>
                    <script>
                        var showErrors = {{ $show_errors }};
                        var totalErrors = {{ $total_errors }};
                        var errorsPerPage = 50;
                        var button = document.getElementById('show-more-errors');
                        button.addEventListener('click', function() {
                            for (var i = showErrors; i < Math.min(showErrors + errorsPerPage, totalErrors); i++) {
                                var error = document.createElement('p');
                                error.classList.add('mb-0');
                                error.innerHTML = '<i class="la la-info-circle"></i> ' + Object.keys(@json($importing_errors))[i] + ': ' + Object.values(@json($importing_errors))[i].join(' ');
                                button.parentNode.insertBefore(error, button);
                            }
                            showErrors += errorsPerPage;
                            if (showErrors >= totalErrors) {
                                button.parentNode.removeChild(button);
                            }
                        });
                    </script>
                @endif
            @endisset
        </ul>
    </div>
@endif