    @extends('admin-layouts.app')
    @section('title', 'Category')
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
                                            <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('home') }}">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            <h1 class="mb-0 d-inline-block fs-6 lh-1">Products Categories</h1>
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
                        <div class="card has-actions has-filter">
                            <div class="card-header">
                                <div class="w-100 justify-content-between d-flex flex-wrap align-items-center gap-1">
                                    <div class="d-flex flex-wrap flex-md-nowrap align-items-center gap-1"></div>
                                    <div
                                        class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">

                                        <div class="dropdown d-inline-block">
                                            <a href="{{ route('admin.category.create') }}"
                                                class="btn buttons-collection action-item btn-primary">
                                                <svg class="icon svg-icon-ti-ti-plus" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M12 5l0 14" />
                                                    <path d="M5 12l14 0" />
                                                </svg>
                                                <span class="ms-1">Create</span>
                                            </a>  
                                        </div>


                                        <button class="btn" type="button" data-bb-toggle="dt-buttons"
                                            data-bb-target=".buttons-reload" tabindex="0"
                                            aria-controls="botble-ecommerce-tables-product-table">
                                            <svg class="icon icon-left svg-icon-ti-ti-refresh"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
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
                                    <table class="table" id="myTable">
                                        <thead>
                                            <tr>
                                                <th title="ID" width="20"
                                                    class="text-center no-column-visibility width="50"   column-key-0">ID</th>
                                                <th title="CategoryName" width="50" class=" column-key-1">Name
                                                </th>
                                                <th title="Description" class="text-center  column-key-2">description
                                                </th>
                                                <th title="Created_at" class="text-center  column-key-2">Created At
                                                </th>
                                                <th title="Status" class="text-center  column-key-1">Status</th>
                                                <th title="Action" class="text-center  column-key-1">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @php
                                                $index = 1;
                                            @endphp
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $index++ }}</td>
                                                    <td>
                                                        {{ $category->name }}
                                                    </td>
                                                    <td>{{ $category->description }}</td>
                                                    <td>{{ $category->created_at }}</td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $category->status === 'Published' ? 'badge bg-success text-success-fg' : 'badge bg-danger text-danger-fg' }}">
                                                            {{ ucwords($category->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.category.edit', $category) }}"
                                                            class="btn btn-sm btn-primary btn-icon-square">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                            <button type="submit" onclick="deleteCategory({{ $category->id }})"
                                                                class="btn btn-sm btn-danger btn-icon-square">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                    </td>
                                                </tr>
                                                @if ($category->children->count())
                                                    @foreach ($category->children as $child)
                                                        <tr>
                                                            <td>{{ $index++ }}</td>
                                                            <td>
                                                                {!! '&nbsp;&nbsp;&nbsp;↳ ' !!}
                                                                {{ $child->name }}
                                                            </td>
                                                            <td>{{ $child->description }}</td>
                                                            <td>{{ $child->created_at }}</td>
                                                            <td>
                                                                <span
                                                                    class="badge {{ $child->status === 'Published' ? 'badge bg-success text-success-fg' : 'badge bg-danger text-danger-fg' }}">
                                                                    {{ ucwords($child->status) }}
                                                                </span>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="{{ route('admin.category.edit', $child) }}"
                                                                    class="btn btn-sm btn-primary btn-icon-square">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <button type="submit" onclick="deleteCategory({{ $category->id }})"
                                                                    class="btn btn-sm btn-danger btn-icon-square">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @endforeach
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
        function deleteCategory(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to delete this category?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: '{{ route("admin.category.Delete") }}',
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { id: id },

                    beforeSend: function() {
                        Swal.fire({
                            title: 'Deleting...',
                            didOpen: () => Swal.showLoading(),
                            allowOutsideClick: false
                        });
                    },
                    success: function(res) {
                        Swal.close();

                        if (res.status === true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: res.message
                            }).then(() => {
                                window.location.href = "{{ route('admin.category.Index') }}";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message || 'Something went wrong!'
                            });
                        }
                    },

                    error: function() {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong!'
                        });
                    }
                });

            } else {
                notify('Delete cancelled', 'info');
            }
        });
    }

    </script>
    @endpush
