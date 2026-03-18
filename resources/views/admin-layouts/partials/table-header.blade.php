<div class="card-header">
    <div class="w-100 justify-content-between d-flex flex-wrap align-items-center gap-1">
        <div class="d-flex flex-wrap flex-md-nowrap align-items-center gap-1">
            @if(isset($bulkActions) && $bulkActions)
            <div class="dropdown d-inline-block">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Bulk Actions
                </button>
                <div class="dropdown-menu">
                    <button class="dropdown-item" id="bulk-delete" style="display: none;">Delete</button>
                    @yield('additional_bulk_actions')
                </div>
            </div>
            @endif

            <button class="btn btn-show-table-options" type="button">Filters</button>

            <div class="table-search-input">
                <label>
                    <input type="search" class="form-control input-sm" id="table-search" placeholder="Search..." style="min-width: 120px" value="{{ request('search') }}">
                </label>
            </div>

            <div class="table-limit-selector ms-2">
                <label class="d-flex align-items-center">
                    <span class="me-1">Show</span>
                    <select name="per_page" class="form-select form-select-sm" id="table-per-page">
                        @foreach([10, 20, 50, 100, 500, 1000] as $limit)
                            <option value="{{ $limit }}" {{ request('per_page', 10) == $limit ? 'selected' : '' }}>{{ $limit }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>
        <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">
            @yield('table_actions')
            <button class="btn" type="button" onclick="window.location.reload()">
                <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                </svg>
                Reload
            </button>
        </div>
    </div>
</div>
