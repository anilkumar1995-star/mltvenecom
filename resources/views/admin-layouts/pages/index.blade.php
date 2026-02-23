@extends('admin-layouts.app')

@section('page-title', 'Pages')

@section('content')
      <div class="page-wrapper">
                <div class="page-header d-print-none">
                    <div class="container-xl">
                        <div class="row g-2 align-items-center">
                            <div class="col">
                                <div class="page-pretitle">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li
                                                class="breadcrumb-item">
                                                <a
                                                    class="mb-0 d-inline-block fs-6 lh-1"
                                                    href="{{ url('/admin') }}">Dashboard</a>
                                            </li>
                                            <li
                                                class="breadcrumb-item active"
                                                aria-current="page">
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">Pages</h1>
                                            </li>
                                        </ol>
                                    </nav>

                                </div>
                            </div>
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <main class="page-body page-content">
                    <div class="container-xl">


                        <div class="table-wrapper">
                            <div class="card mb-3 table-configuration-wrap" style="display: none;">
                                <div class="card-body">
                                    <button
                                        class="btn btn-icon  btn-sm btn-show-table-options rounded-pill" type="button">
                                        <svg class="icon icon-sm  icon-left svg-icon-ti-ti-x"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M18 6l-12 12" />
                                            <path d="M6 6l12 12" />
                                        </svg>

                                    </button>

                                    <div class="wrapper-filter">
                                        <p>Filters</p>

                                        <input
                                            type="hidden"
                                            class="filter-data-url"
                                            value="{{ url('/admin/tables/filters') }}" />

                                        <div class="sample-filter-item-wrap hidden">
                                            <div class="row filter-item form-filter">
                                                <div class="col-auto w-50 w-sm-auto">
                                                    <div class="mb-3 position-relative">
                                                        <select class="form-select filter-column-key" name="filter_columns[]" id="filter_columns[]">
                                                            <option
                                                                value="name">Name</option>
                                                            <option
                                                                value="template">Template</option>
                                                            <option
                                                                value="status">Status</option>
                                                            <option
                                                                value="created_at">Created At</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-auto w-50 w-sm-auto">
                                                    <div class="mb-3 position-relative">
                                                        <select class="form-select filter-operator filter-column-operator" name="filter_operators[]" id="filter_operators[]">
                                                            <option
                                                                value="like">Contains</option>
                                                            <option
                                                                value="=">Is equal to</option>
                                                            <option
                                                                value="&gt;">Greater than</option>
                                                            <option
                                                                value="&lt;">Less than</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-auto w-100 w-sm-25">
                                                    <span class="filter-column-value-wrap">
                                                        <input
                                                            class="form-control filter-column-value"
                                                            type="text"
                                                            placeholder="Value"
                                                            name="filter_values[]">
                                                    </span>
                                                </div>

                                                <div class="col">
                                                    <button
                                                        class="btn btn-icon   btn-remove-filter-item mb-3 text-danger" type="button"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Delete">
                                                        <svg class="icon icon-left svg-icon-ti-ti-trash"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round">
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

                                        <form method="GET" action="{{ route('admin.pages.index') }}" accept-charset="UTF-8" class="filter-form">
                                            <input
                                                type="hidden"
                                                name="filter_table_id"
                                                class="filter-data-table-id"
                                                value="botble-page-tables-page-table">
                                            <input
                                                type="hidden"
                                                name="class"
                                                class="filter-data-class"
                                                value="Botble\Page\Tables\PageTable">
                                            <div class="filter_list inline-block filter-items-wrap">
                                                <div class="row filter-item form-filter filter-item-default">
                                                    <div class="col-auto w-50 w-sm-auto">
                                                        <div class="mb-3 position-relative">
                                                            <select class="form-select filter-column-key" name="filter_columns[]" id="filter_columns[]">
                                                                <option
                                                                    value=""
                                                                    selected>Select field</option>
                                                                <option
                                                                    value="name">Name</option>
                                                                <option
                                                                    value="template">Template</option>
                                                                <option
                                                                    value="status">Status</option>
                                                                <option
                                                                    value="created_at">Created At</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-auto w-50 w-sm-auto">
                                                        <div class="mb-3 position-relative">
                                                            <select class="form-select filter-operator filter-column-operator" name="filter_operators[]" id="filter_operators[]">
                                                                <option
                                                                    value="like">Contains</option>
                                                                <option
                                                                    value="="
                                                                    selected>Is equal to</option>
                                                                <option
                                                                    value="&gt;">Greater than</option>
                                                                <option
                                                                    value="&lt;">Less than</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-auto w-100 w-sm-25">
                                                        <div class="filter-column-value-wrap mb-3">
                                                            <input
                                                                class="form-control filter-column-value"
                                                                type="text"
                                                                placeholder="Value"
                                                                name="filter_values[]"
                                                                value="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-list">
                                                <button
                                                    class="btn   add-more-filter" type="button">

                                                    Add additional filter

                                                </button>
                                                <button
                                                    class="btn btn-primary  btn-apply" type="submit">

                                                    Apply

                                                </button>
                                                <a
                                                    class="btn btn-icon   w-6" style="display: none;" type="button" href="{{ route('admin.pages.index') }}" data-bb-toggle="datatable-reset-filter">
                                                    <svg class="icon icon-left svg-icon-ti-ti-refresh"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                                    </svg>

                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card has-actions has-filter">
                                <div class="card-header">
                                    <div class="w-100 justify-content-between d-flex flex-wrap align-items-center gap-1">
                                        <div class="d-flex flex-wrap flex-md-nowrap align-items-center gap-1">
                                            <div class="dropdown d-inline-block">
                                                <button
                                                    class="btn   dropdown-toggle" type="button" data-bs-toggle="dropdown">

                                                    Bulk Actions

                                                </button>

                                                <div class="dropdown-menu">
                                                    <div class="dropdown-submenu">
                                                        <button class="dropdown-item">

                                                            Bulk changes

                                                            <svg class="icon dropdown-item-icon ms-auto me-0 svg-icon-ti-ti-chevron-right"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="24"
                                                                height="24"
                                                                viewBox="0 0 24 24"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                stroke-width="2"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path d="M9 6l6 6l-6 6" />
                                                            </svg> </button>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item bulk-change-item" data-key="name" data-class-item="Botble\Page\Tables\PageTable" data-save-url="{{ url('/admin/tables/bulk-changes/save') }}">

                                                                Name

                                                            </button>
                                                            <button class="dropdown-item bulk-change-item" data-key="template" data-class-item="Botble\Page\Tables\PageTable" data-save-url="{{ url('/admin/tables/bulk-changes/save') }}">

                                                                Template

                                                            </button>
                                                            <button class="dropdown-item bulk-change-item" data-key="status" data-class-item="Botble\Page\Tables\PageTable" data-save-url="{{ url('/admin/tables/bulk-changes/save') }}">

                                                                Status

                                                            </button>
                                                            <button class="dropdown-item bulk-change-item" data-key="created_at" data-class-item="Botble\Page\Tables\PageTable" data-save-url="{{ url('/admin/tables/bulk-changes/save') }}">

                                                                Created At

                                                            </button>
                                                        </div>
                                                    </div>

                                                    <a class="dropdown-item" href="{{ url('/admin/tables/bulk-actions') }}" data-trigger-bulk-action="data-trigger-bulk-action" data-method="POST" data-table-target="Botble\Page\Tables\PageTable" data-target="Botble\Table\BulkActions\DeleteBulkAction" data-confirmation-modal-title="Confirm to perform this action" data-confirmation-modal-message="Are you sure you want to do this action? This cannot be undone." data-confirmation-modal-button="Delete" data-confirmation-modal-cancel-button="Cancel">

                                                        Delete

                                                    </a>
                                                </div>
                                            </div>

                                            <button
                                                class="btn   btn-show-table-options" type="button">

                                                Filters

                                            </button>

                                            <div class="table-search-input">
                                                <label>
                                                    <input
                                                        type="search"
                                                        class="form-control input-sm"
                                                        placeholder="Search..."
                                                        style="min-width: 120px">
                                                    <button
                                                        type="button"
                                                        title="Search..."
                                                        class="search-icon"><svg class="icon svg-icon-ti-ti-search"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                            <path d="M21 21l-6 -6" />
                                                        </svg></button>
                                                    <button
                                                        type="button"
                                                        title="Clear"
                                                        class="search-reset-icon"><svg class="icon svg-icon-ti-ti-x"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M18 6l-12 12" />
                                                            <path d="M6 6l12 12" />
                                                        </svg></button>
                                                </label>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">
                                            <a
                                                class="btn action-item btn-primary"
                                                href="{{ route('admin.pages.create') }}">
                                                <span>
                                                    <svg class="icon svg-icon-ti-ti-plus"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M12 5l0 14" />
                                                        <path d="M5 12l14 0" />
                                                    </svg>
                                                    Create
                                                </span>

                                            </a>

                                            <button
                                                class="btn" type="button" data-bb-toggle="dt-buttons" data-bb-target=".buttons-reload" tabindex="0" aria-controls="botble-page-tables-page-table">
                                                <svg class="icon icon-left svg-icon-ti-ti-refresh"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                                </svg>
                                                Reload

                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-table">
                                    <div class="table-responsive table-has-actions table-has-filter">
                                        <table class="table card-table table-vcenter table-striped table-hover" id="botble-page-tables-page-table">
                                            <thead>
                                                <tr>
                                                    <th title="Checkbox"><input class="form-check-input m-0 align-middle table-check-all" data-set=".dataTable .checkboxes" name="" type="checkbox"></th>
                                                    <th title="ID" width="20" class="text-center no-column-visibility  column-key-0">ID</th>
                                                    <th title="Name" class="text-start  column-key-1">Name</th>
                                                    <th title="Template" class="text-start  column-key-2">Template</th>
                                                    <th title="Created At" width="100" class=" column-key-3">Created At</th>
                                                    <th title="Status" width="100" class="text-center  column-key-4">Status</th>
                                                    <th title="Operations">Operations</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($pages as $page)
                                                    <tr>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $page->id }}">
                                                        </td>
                                                        <td class="text-center">{{ $page->id }}</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                @if($page->image)
                                                                    <span class="avatar avatar-sm me-2" style="background-image: url({{ asset('storage/' . $page->image) }})"></span>
                                                                @else
                                                                    <span class="avatar avatar-sm me-2"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 8h.01"></path><path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z"></path><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5"></path><path d="M13 13l1 -1c.928 -.893 2.072 -.893 3 0l3 3"></path></svg></span>
                                                                @endif
                                                                <a href="{{ route('admin.pages.edit', $page->id) }}" class="fw-bold text-decoration-none text-dark">{{ $page->name }}</a>
                                                            </div>
                                                        </td>
                                                        <td>{{ ucfirst($page->template) }}</td>
                                                        <td>{{ $page->created_at ? $page->created_at->format('Y-m-d') : '' }}</td>
                                                        <td class="text-center">
                                                            @if($page->status == 'published')
                                                                <span class="badge bg-success  text-white">Published</span>
                                                            @elseif($page->status == 'draft')
                                                                <span class="badge bg-warning  text-white">Draft</span>
                                                            @else
                                                                <span class="badge bg-secondary  text-white">{{ ucfirst($page->status) }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-list flex-nowrap">
                                                                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-icon btn-sm btn-primary" title="Edit">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                                                </a>
                                                                <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this page?');" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-icon btn-sm btn-danger" title="Delete">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center py-4 text-muted">No pages found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($pages->hasPages())
                                        <div class="card-footer d-flex align-items-center">
                                            <div class="m-0 text-muted">
                                                Showing <span>{{ $pages->firstItem() }}</span> to <span>{{ $pages->lastItem() }}</span> of <span>{{ $pages->total() }}</span> entries
                                            </div>
                                            <div class="ms-auto">
                                                {{ $pages->links() }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </main>

           

@endsection