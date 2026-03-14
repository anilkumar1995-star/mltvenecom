@extends('admin-layouts.app')
@section('title', 'Announcements')

@section('content')

<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none mb-0">
        <div class="container-xl">
            <div class="row g-2 align-items-center mb-3">
                <div class="col">
                    <div class="page-pretitle breadcrumb-arrows mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">DASHBOARD</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ANNOUNCEMENTS</li>
                        </ol>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible bg-success-lt" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                        </div>
                        <div>
                            {{ session('success') }}
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible bg-danger-lt" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12.01" y2="8"></line><polyline points="11 12 12 12 12 16 13 16"></polyline></svg>
                        </div>
                        <div>
                            {{ session('error') }}
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible bg-danger-lt" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12.01" y2="8"></line><polyline points="11 12 12 12 12 16 13 16"></polyline></svg>
                        </div>
                        <div>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body mt-0">
        <div class="container-xl">
            <div class="card">
                <div class="card-body p-0">
                    <div class="d-flex justify-content-between align-items-center p-3 border-bottom table-toolbar">
                        <div class="d-flex gap-2 align-items-center">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle btn-light-shofy" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Bulk Actions
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item text-danger bulk-delete-btn" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                </ul>
                            </div>
                            <button class="btn btn-light-shofy">
                                Filters
                            </button>
                            <div class="ms-0" style="width: 180px;">
                                <div class="input-icon">
                                    <input type="text" class="form-control form-control-shofy" placeholder="Search..." id="searchInput">
                                    <span class="input-icon-addon">
                                        <i class="fas fa-search" style="font-size: 11px;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary" style="background: #206bc4; border-color: #206bc4; font-size: 13px; font-weight: 500;">
                                <i class="fas fa-plus me-2"></i> Create
                            </a>
                            <button class="btn btn-light-shofy" onclick="window.location.reload();">
                                <i class="fas fa-sync-alt me-2"></i> Reload
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive" id="table-container">
                        <table class="table card-table table-vcenter table-hover datatable" id="postsTable">
    <thead>
        <tr>
            <th class="w-1 text-center">
                <input class="form-check-input m-0 align-middle" type="checkbox" id="checkAll">
            </th>
            <th style="width: 80px;">ID <i class="fas fa-sort text-muted ms-1" style="font-size: 10px;"></i></th>
            <th>NAME <i class="fas fa-sort text-muted ms-1" style="font-size: 10px;"></i></th>
            <th>IS ACTIVE <i class="fas fa-sort text-muted ms-1" style="font-size: 10px;"></i></th>
            <th>CREATED AT <i class="fas fa-sort text-muted ms-1" style="font-size: 10px;"></i></th>
            <th class="text-center">OPERATIONS</th>
        </tr>
    </thead>
    <tbody>
        @forelse($announcements as $item)
        <tr>
            <td class="text-center">
                <input class="form-check-input m-0 align-middle row-checkbox" type="checkbox" value="{{ $item->id }}">
            </td>
            <td>{{ $item->id }}</td>
            <td><a href="{{ route('admin.announcements.edit', $item->id) }}" class="text-primary text-decoration-none fw-normal">{{ $item->name }}</a></td>
            <td>
                @if($item->is_active)
                    <span class="badge bg-success text-success-fg px-2 py-1">Yes</span>
                @else
                    <span class="badge bg-secondary text-secondary-fg px-2 py-1">No</span>
                @endif
            </td>
            <td class="text-muted">{{ $item->created_at->format('Y-m-d') }}</td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-1">
                    <a href="{{ route('admin.announcements.edit', $item->id) }}" class="btn btn-primary btn-icon btn-sm" style="border-radius: 4px;" data-bs-toggle="tooltip" title="Edit">
                        <svg class="icon svg-icon-ti-ti-edit" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415" />
                            <path d="M16 5l3 3" />
                        </svg>
                    </a>
                    <button type="button" class="btn btn-danger btn-icon btn-sm" style="border-radius: 4px;" onclick="deleteItem({{ $item->id }})" data-bs-toggle="tooltip" title="Delete">
                        <svg class="icon svg-icon-ti-ti-trash" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 7l16 0" />
                            <path d="M10 11l0 6" />
                            <path d="M14 11l0 6" />
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted p-5">
                No announcements found.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="d-flex justify-content-between align-items-center p-3 border-top">
    <div class="text-muted fs-5">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-world me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6c7a91" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
            <path d="M3.6 9h16.8" />
            <path d="M3.6 15h16.8" />
            <path d="M11.5 3a17 17 0 0 0 0 18" />
            <path d="M12.5 3a17 17 0 0 1 0 18" />
        </svg>
        Show from {{ $announcements->firstItem() ?? 0 }} to {{ $announcements->lastItem() ?? 0 }} in <span class="badge bg-secondary text-white">{{ $announcements->total() }}</span> records
    </div>
    <div class="m-0">
        {{ $announcements->links('pagination::bootstrap-5') }}
    </div>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .breadcrumb-item+.breadcrumb-item::before {
        content: "/";
        padding: 0 5px;
        color: #adb5bd;
    }
    .breadcrumb-item a {
        text-decoration: none;
        color: #206bc4;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
    }
    .breadcrumb-item.active {
        color: #6c7a91;
        font-size: 14px;
        font-weight: 400;
        text-transform: uppercase;
    }
    .btn-light-shofy {
        background: #fff;
        border: 1px solid #e6e8e9;
        color: #495057;
        font-size: 13px;
        font-weight: 500;
    }
    .btn-light-shofy:hover {
        background: #f8f9fa;
        border-color: #d1d4d7;
    }
    .form-control-shofy {
        border-color: #e6e8e9;
        font-size: 13px;
    }
    .table thead th {
        background: #f8f9fa;
        border-top: none;
        border-bottom: 1px solid #e6e8e9;
        color: #6c7a91;
        font-weight: 600;
        letter-spacing: 0.5px;
        font-size: 12px;
        padding: 15px 10px;
        text-transform: uppercase;
    }
    .table tbody td {
        border-bottom: 1px solid #e6e8e9;
        padding: 15px 10px;
        vertical-align: middle;
    }
    .btn-light {
        background: #fff;
        border-color: #e6e8e9;
    }
    .form-check-input {
        cursor: pointer;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // Check all functionality
    $(document).on('change', '#checkAll', function() {
        $('.row-checkbox').prop('checked', $(this).prop('checked'));
    });

    // Single Delete
    function deleteItem(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to delete this record?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url("admin/announcements") }}/' + id,
                    type: 'DELETE',
                    success: function (response) {
                        if (response.status) {
                            Swal.fire("Deleted!", response.message, "success");
                            reloadTable();
                        } else {
                            Swal.fire("Error", response.message, "error");
                        }
                    },
                    error: function(xhr) {
                        Swal.fire("Error", "Something went wrong", "error");
                    }
                });
            }
        });
    }

    // Bulk Delete
    $('.bulk-delete-btn').on('click', function(e) {
        e.preventDefault();
        let selected = [];
        $('.row-checkbox:checked').each(function() {
            selected.push($(this).val());
        });

        if (selected.length === 0) {
            Swal.fire("Warning", "Please select at least one record to delete.", "warning");
            return;
        }

        Swal.fire({
            title: "Are you sure?",
            text: "You will delete " + selected.length + " selected record(s).",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete them!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("admin.announcements.bulk_delete") }}',
                    type: 'POST',
                    data: { ids: selected },
                    success: function (response) {
                        if (response.status) {
                            Swal.fire("Deleted!", response.message, "success");
                            $('#checkAll').prop('checked', false);
                            reloadTable();
                        } else {
                            Swal.fire("Error", response.message, "error");
                        }
                    },
                    error: function (xhr) {
                        Swal.fire("Error", "Something went wrong.", "error");
                    }
                });
            }
        });
    });

    // Simple reload table
    function reloadTable() {
        $.ajax({
            url: window.location.href,
            type: 'GET',
            success: function(data) {
                $('#table-container').html(data);
            }
        });
    }

    // Simple search filter (client side for now since datatables isn't initialized server side)
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $("#table-container tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
</script>
@endpush
