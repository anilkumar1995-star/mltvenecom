@extends('admin-layouts.app')
@section('title', 'Categories')
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
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Product Categories</h1>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="page-body page-content">
            <div class="container-xl">
                <div class="table-wrapper">
                    {{-- Shared Filter Panel --}}
                    @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

                        {{-- Table Card --}}
                        <div class="card has-actions has-filter">
                            {{-- Custom Action Buttons for this page --}}
                            @section('table_actions')
                                <a href="{{ route('admin.category.create') }}" class="btn btn-primary d-flex align-items-center">
                                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 5v14" />
                                        <path d="M5 12h14" />
                                    </svg>
                                    Create
                                </a>
                            @endsection

                            {{-- Shared Header --}}
                            @include('admin-layouts.partials.table-header', [
                                'bulkActions' => true,
                                'tableId' => 'categoriesTable'
                            ])

                        <div class="card-table">
                            <div class="table-responsive table-has-actions table-has-filter">
                                <table class="table card-table table-vcenter table-hover datatable" id="categoriesTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 20px;">
                                                <input class="form-check-input m-0 align-middle table-check-all" type="checkbox" id="check-all">
                                            </th>
                                            <th title="ID" width="50">ID</th>
                                            <th title="Image" width="70">Image</th>
                                            <th title="Name">Name</th>
                                            <th title="Subcategories">Subcategories</th>
                                            <th title="Description">Description</th>
                                            <th title="Featured" width="80" class="text-center">Featured</th>
                                            <th title="Status" width="100">Status</th>
                                            <th title="Created At" width="150">Created At</th>
                                            <th title="Operations" width="100" class="text-center">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $category->id }}">
                                            </td>
                                            <td>{{ $category->id }}</td>
                                            <td>
                                                <div class="avatar avatar-md" style="background-image: url({{ $category->image ? (str_starts_with($category->image, 'http') ? $category->image : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($category->image, '/')) : asset('home/placeholder.png') }}); border-radius: 8px; border: 1px solid #eee; background-size: cover; width: 45px; height: 45px;"></div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    @if($category->parent_id != 0)
                                                        <div class="small text-muted">{{ $category->parent->name ?? 'None' }} &gt;</div>
                                                    @endif
                                                    <a href="{{ route('admin.category.edit', $category->id) }}" class="text-primary font-weight-bold text-decoration-none">
                                                        {{ $category->name }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    @php $children = $category->children; @endphp
                                                    @if($children->count() > 0)
                                                        @foreach($children as $child)
                                                            <span class="badge bg-blue-lt border">{{ $child->name }}</span>
                                                        @endforeach
                                                    @else
                                                        <span class="text-muted small">No subcategories</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-muted small">
                                                {{ Str::limit($category->description, 100) }}
                                            </td>
                                            <td class="text-center">
                                                @if($category->is_featured)
                                                    <span class="badge bg-purple-lt">Featured</span>
                                                @else
                                                    <span class="text-muted small">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge {{ strtolower($category->status) === 'published' ? 'bg-success text-success-fg' : 'bg-warning text-warning-fg' }}">
                                                    {{ ucwords($category->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($category->created_at)
                                                    {{ is_string($category->created_at) ? $category->created_at : $category->created_at->format('M d, Y') }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" data-url="{{ route('admin.category.destroy', $category->id) }}" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() ?? 0 }} entries
                            </div>
                            {{ $categories->appends(request()->all())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'bulkDeleteUrl' => route('admin.category.bulk-delete'),
        'tableId' => 'categoriesTable'
    ])
@endpush
