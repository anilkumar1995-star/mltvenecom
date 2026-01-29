@extends('admin-layouts.app')
@section('title', 'Brand')
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
                                        <a href="{{ route('admin.brand.create') }}"
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
                                <table class="table card-table table-vcenter table-striped table-hover"
                                    id="botble-ecommerce-tables-product-table">
                                    <thead>
                                        <tr>
                                            <th title="ID" width="20"class="text-center no-column-visibility  column-key-0">ID</th>
                                            <th title="Logo" width="20" class="text-center no-column-visibility  column-key-0">Logo</th>
                                            <th title="CategoryName" width="50" class=" column-key-1">Name</th>
                                            <th title="Created_at" class="text-start  column-key-2">Created At</th>
                                            <th title="Status" class="text-start  column-key-1">Status</th>
                                            <th title="Action" class="text-start  column-key-1">Oerations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{--  @foreach($categories as $category)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $category->name }}</a></td>
                                                <td>{{ $category->description }}</td>
                                                <td>{{ optional($category->created_at)->format('Y-m-d') }}</td>
                                                <td>
                                                        {!! $category->status == 'Published'
                                                            ? '<span class="badge bg-success">Published</span>'
                                                            : '<span class="badge bg-warning">Pending</span>' !!}
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('admin.category.edit', $category) }}" class="btn btn-sm btn-primary btn-icon-square"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('admin.category.Delete', $category) }}" method="POST" style="display:inline-block" class="confirm-delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger btn-icon-square btn-delete"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach  --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
