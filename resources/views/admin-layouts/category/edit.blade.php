@extends('admin-layouts.app')
@section('title', 'Category Edit')
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
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Create new product category
                                        </h1>
                                    </li>
                                </ol>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <main class="page-body page-content">
            <div class="container-xl">
                <form method="POST" action="{{ route('admin.category.update', $category) }}">
                    @csrf
                    @method('PUT')
                    <div role="alert" class="alert alert-info">
                        <div class="d-flex gap-1">
                            <div>
                                <svg class="icon alert-icon svg-icon-ti-ti-info-circle" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                    <path d="M12 9h.01" />
                                    <path d="M11 12h1v4h1" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="gap-3 col-md-9">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="name">
                                                Name
                                            </label>
                                            <input class="form-control" placeholder="Name" name="name" type="text"
                                                id="name" value="{{ old('name', $category->name) }}">
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="parent_id">
                                                Parent
                                            </label>
                                            <select class="select-search-full form-select" data-allow-clear="false"
                                                id="parent_id" name="parent_id"
                                                value="{{ old('parent_id', $category->parent_id) }}">
                                                <option value="0">None</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="description">
                                                Description
                                            </label>
                                            <div class="mb-2 btn-list"></div>
                                            <textarea class="form-control form-control editor-ckeditor ays-ignore" data-counter="100000" rows="4"
                                                placeholder="Write your content" with-short-code id="description"
                                                value="{{ old('description', $category->description) }}" name="description" cols="50"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 gap-3 d-flex flex-column-reverse flex-md-column mb-md-0 mb-5">
                            <div data-bb-waypoint data-bb-target="#form-actions"></div>
                            <div class="card meta-boxes">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <label class="form-label form-label required" for="status">
                                            Status
                                        </label>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <select class="form-select" required="required" id="status" name="status">
                                        <option value="Pending"
                                            {{ old('status', $category->status) == 'Pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="Published"
                                            {{ old('status', $category->status) == 'Published' ? 'selected' : '' }}>
                                            Published</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        Publish
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="btn-list">
                                        <button class="btn btn-primary" type="submit">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            @endsection
