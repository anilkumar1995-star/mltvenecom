@extends('admin-layouts.app')
@section('title','Table')
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
                                    <a class="mb-0 d-inline-block fs-6 lh-1"
                                        href="{{ route('home') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Specification Tables</h1>
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
                <div class="card has-actions">
                    <div class="card-header">
                        <div class="w-100 justify-content-between d-flex flex-wrap align-items-center gap-1">
                            <div class="d-flex flex-wrap flex-md-nowrap align-items-center gap-1">
                                <div class="dropdown d-inline-block">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Bulk Actions
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item text-danger" onclick="bulkDelete()">
                                            Delete
                                        </button>
                                    </div>
                                </div>

                                <div class="table-search-input">
                                    <form action="{{ route('admin.producttable.Index') }}" method="GET">
                                        <input type="search" name="q" class="form-control input-sm" placeholder="Search..." value="{{ request('q') }}" style="min-width: 120px">
                                    </form>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">
                                <a href="{{ route('admin.producttable.create') }}" class="btn btn-primary">
                                    <svg class="icon svg-icon-ti-ti-plus" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    <span class="ms-1">Create</span>
                                </a>

                                <button class="btn" type="button" onclick="location.reload()">
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
                        <div class="table-responsive table-has-actions">
                            <table class="table card-table table-vcenter table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="40"><input class="form-check-input m-0 align-middle" id="checkAll" type="checkbox"></th>
                                        <th width="40" class="text-center">ID</th>
                                        <th class="text-start">Name</th>
                                        <th>Description</th>
                                        <th>Assigned Groups</th>
                                        <th width="100">Created At</th>
                                        <th width="100" class="text-center">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tables as $table)
                                    <tr>
                                        <td><input type="checkbox" class="form-check-input row-checkbox" value="{{ $table->id }}"></td>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td class="text-start"><a href="{{ route('admin.producttable.edit', $table->id) }}">{{ $table->name }}</a></td>
                                        <td>{{ $table->description }}</td>
                                        <td>
                                            @foreach($table->groups as $group)
                                                <span class="badge bg-blue-lt">{{ $group->id }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $table->created_at }}</td>
                                        <td class="text-center">
                                            <div class="btn-list flex-nowrap">
                                                <a href="{{ route('admin.producttable.edit', $table->id) }}" class="btn btn-icon btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button onclick="deleteItem({{ $table->id }})" class="btn btn-icon btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No tables found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('scripts')
<script>
    function deleteItem(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to delete this table?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("admin.producttable.Delete") }}',
                    type: 'POST',
                    data: { id: id, _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        if (res.status) {
                            Swal.fire('Deleted!', res.message, 'success').then(() => {
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    }

    function bulkDelete() {
        var ids = [];
        $('.row-checkbox:checked').each(function() {
            ids.push($(this).val());
        });

        if (ids.length === 0) {
            Swal.fire('Error', 'Please select at least one item', 'error');
            return;
        }

        Swal.fire({
            title: "Are you sure?",
            text: "You are about to delete " + ids.length + " items.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete them!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("admin.producttable.bulk-delete") }}',
                    type: 'POST',
                    data: { ids: ids, _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        if (res.status) {
                            Swal.fire('Deleted!', res.message, 'success').then(() => {
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    }

    $(document).ready(function() {
        $(document).on('change', '#checkAll', function() {
            $('.row-checkbox').prop('checked', $(this).prop('checked'));
        });
    });
</script>
@endpush