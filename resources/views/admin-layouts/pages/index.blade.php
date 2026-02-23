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
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ url('/admin') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
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
                        <button class="btn btn-icon btn-sm btn-show-table-options rounded-pill" type="button">
                            <svg class="icon icon-sm icon-left svg-icon-ti-ti-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6l-12 12" />
                                <path d="M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="wrapper-filter">
                            <p>Filters</p>
                            <form method="GET" action="{{ route('admin.pages.index') }}" accept-charset="UTF-8" class="filter-form">
                                <div class="filter_list inline-block filter-items-wrap">
                                    <div class="row filter-item form-filter filter-item-default">
                                        <div class="col-auto w-50 w-sm-auto">
                                            <div class="mb-3 position-relative">
                                                <select class="form-select filter-column-key" name="filter_columns[]">
                                                    <option value="" selected>Select field</option>
                                                    <option value="name">Name</option>
                                                    <option value="status">Status</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-auto w-50 w-sm-auto">
                                            <div class="mb-3 position-relative">
                                                <select class="form-select filter-operator filter-column-operator" name="filter_operators[]">
                                                    <option value="like">Contains</option>
                                                    <option value="=" selected>Is equal to</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-auto w-100 w-sm-25">
                                            <div class="filter-column-value-wrap mb-3">
                                                <input class="form-control filter-column-value" type="text" placeholder="Value" name="filter_values[]" value="{{ request('filter_values.0') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-list">
                                    <button class="btn add-more-filter" type="button">Add additional filter</button>
                                    <button class="btn btn-primary btn-apply" type="submit">Apply</button>
                                    <a class="btn btn-icon w-6" href="{{ route('admin.pages.index') }}">
                                        <svg class="icon icon-left svg-icon-ti-ti-refresh" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Bulk Actions
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>

                                <button class="btn btn-show-table-options" type="button">
                                    Filters
                                </button>

                                <div class="table-search-input">
                                    <form action="{{ route('admin.pages.index') }}" method="GET">
                                        <label>
                                            <input type="search" name="search" class="form-control input-sm" placeholder="Search..." value="{{ request('search') }}" style="min-width: 120px">
                                        </label>
                                    </form>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">
                                <a href="{{ route('admin.pages.create') }}" class="btn action-item btn-primary">
                                    <svg class="icon svg-icon-ti-ti-plus" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Create
                                </a>

                                <button class="btn" type="button" onclick="window.location.reload()">
                                    <svg class="icon icon-left svg-icon-ti-ti-refresh" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                        <th title="Checkbox"><input class="form-check-input m-0 align-middle table-check-all" type="checkbox"></th>
                                        <th title="ID" width="20" class="text-center">ID</th>
                                        <th title="Name">Name</th>
                                        <th title="Template">Template</th>
                                        <th title="Created At" width="100">Created At</th>
                                        <th title="Status" width="100" class="text-center">Status</th>
                                        <th title="Operations">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pages as $page)
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox" name="id[]" value="{{ $page->id }}"></td>
                                        <td class="text-center">{{ $page->id }}</td>
                                        <td class="text-start">
                                            <a href="{{ route('admin.pages.edit', $page->id) }}">{{ $page->name }}</a>
                                        </td>
                                        <td class="text-start">{{ $page->template ?? 'Default' }}</td>
                                        <td>{{ $page->created_at->format('Y-m-d') }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-{{ $page->status === 'published' ? 'success' : 'warning' }}-lt">
                                                {{ ucfirst($page->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <a href="{{ route('pages.show', $page->id) }}" class="btn btn-sm btn-icon btn-success" target="_blank" title="View">
                                                    <i class="fas fa-eye text-white"></i>
                                                </a>
                                                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-sm btn-icon btn-primary" title="Edit">
                                                    <i class="fas fa-edit text-white"></i>
                                                </a>
                                                <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-icon btn-danger" onclick="return confirm('Are you sure?')" title="Delete">
                                                        <i class="fas fa-trash-alt text-white"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($pages->hasPages())
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-muted">Showing <span>{{ $pages->firstItem() }}</span> to <span>{{ $pages->lastItem() }}</span> of <span>{{ $pages->total() }}</span> entries</p>
                        <ul class="pagination m-0 ms-auto">
                            {{ $pages->links() }}
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

@endsection
