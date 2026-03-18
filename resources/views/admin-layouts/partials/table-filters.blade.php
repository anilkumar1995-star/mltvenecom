<div class="card mb-3 table-configuration-wrap" style="display: none;">
    <div class="card-body">
        <button class="btn btn-icon btn-sm btn-show-table-options rounded-pill" type="button">
            <svg class="icon icon-sm icon-left" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6l-12 12" />
                <path d="M6 6l12 12" />
            </svg>
        </button>

        <div class="wrapper-filter">
            <p>Filters</p>
            <input type="hidden" class="filter-data-url" value="{{ url()->current() }}" />

            <div class="sample-filter-item-wrap hidden">
                <div class="row filter-item form-filter">
                    <div class="col-auto w-50 w-sm-auto">
                        <div class="mb-3 position-relative">
                            <select class="form-select filter-column-key" name="filter_columns[]">
                                @foreach($filterColumns as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-auto w-50 w-sm-auto">
                        <div class="mb-3 position-relative">
                            <select class="form-select filter-operator filter-column-operator" name="filter_operators[]">
                                <option value="like">Contains</option>
                                <option value="=">Is equal to</option>
                                <option value="&gt;">Greater than</option>
                                <option value="&lt;">Less than</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-auto w-100 w-sm-25">
                        <span class="filter-column-value-wrap">
                            <input class="form-control filter-column-value" type="text" placeholder="Value" name="filter_values[]">
                        </span>
                    </div>

                    <div class="col">
                        <button class="btn btn-icon btn-remove-filter-item mb-3 text-danger" type="button" data-bs-toggle="tooltip" title="Delete">
                            <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 7l16 0" />
                                <path d="M10 11l0 6" />
                                <path d="M14 11l0 6" />
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <form method="GET" action="{{ url()->current() }}" accept-charset="UTF-8" class="filter-form">
                <div class="filter_list inline-block filter-items-wrap">
                    @php 
                        $requestFilters = request('filter_columns', []);
                        $count = count($requestFilters) > 0 ? count($requestFilters) : 1;
                    @endphp
                    
                    @for($i = 0; $i < $count; $i++)
                    <div class="row filter-item form-filter {{ $i == 0 ? 'filter-item-default' : '' }}">
                        <div class="col-auto w-50 w-sm-auto">
                            <div class="mb-3 position-relative">
                                <select class="form-select filter-column-key" name="filter_columns[]">
                                    <option value="" selected>Select field</option>
                                    @foreach($filterColumns as $key => $label)
                                        <option value="{{ $key }}" {{ request("filter_columns.$i") == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-auto w-50 w-sm-auto">
                            <div class="mb-3 position-relative">
                                <select class="form-select filter-operator filter-column-operator" name="filter_operators[]">
                                    <option value="like" {{ request("filter_operators.$i") == 'like' ? 'selected' : '' }}>Contains</option>
                                    <option value="=" {{ request("filter_operators.$i") == '=' ? 'selected' : '' }}>Is equal to</option>
                                    <option value="&gt;" {{ request("filter_operators.$i") == '>' ? 'selected' : '' }}>Greater than</option>
                                    <option value="&lt;" {{ request("filter_operators.$i") == '<' ? 'selected' : '' }}>Less than</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto w-100 w-sm-25">
                            <div class="filter-column-value-wrap mb-3">
                                <input class="form-control filter-column-value" type="text" placeholder="Value" name="filter_values[]" value="{{ request("filter_values.$i") }}">
                            </div>
                        </div>

                        <div class="col">
                            @if($i > 0)
                            <button class="btn btn-icon btn-remove-filter-item mb-3 text-danger" type="button">
                                <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            </button>
                            @endif
                        </div>
                    </div>
                    @endfor
                </div>
                <div class="btn-list">
                    <button class="btn add-more-filter" type="button">Add additional filter</button>
                    <button class="btn btn-primary btn-apply" type="submit">Apply</button>
                    <a class="btn btn-icon w-6" style="{{ request()->has('filter_columns') ? '' : 'display: none;' }}" type="button" href="{{ url()->current() }}" data-bb-toggle="datatable-reset-filter">
                        <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                        </svg>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
