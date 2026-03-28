@extends('admin-layouts.app')
@section('title', 'Edit Vendor')
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
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">Marketplace</h1>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.marketplace.vendors') }}">Vendors</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">Edit vendor &quot;{{ $vendor->name }}&quot;</h1>
                                            </li>
                                        </ol>
                                    </nav>

                                </div>
                            </div>
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                        <a href="{{ route('admin.marketplace.vendors.show', $vendor->id) }}" class="btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                               <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                               <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                            </svg>
                                            View
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <main class="page-body page-content">
                    <div class="container-xl">


                        <form method="POST" action="{{ route('admin.marketplace.vendors.update', $vendor->id) }}" accept-charset="UTF-8" id="vendor-edit-form" class="js-base-form dirty-check form-validate-jquery" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="row">
                                <div class="col-md-9">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <ul data-bs-toggle="tabs" class="nav nav-tabs card-header-tabs">
                                                <li class="nav-item">
                                                    <a
                                                        href="#tabs-detail"
                                                        class="nav-link active"
                                                        data-bs-toggle="tab">

                                                        Detail
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="tabs-detail">
                                                    <div class="row row-cols-lg-2">



                                                        <div class="col-lg-6">
                                                            <div class="mb-3 position-relative">

                                                                <label class="form-label" for="name">
                                                                    Name


                                                                </label>


                                                                <input class="form-control" data-counter="120" placeholder="Name" name="name" type="text" value="{{ old('name', $vendor->name) }}" id="name">




                                                            </div>

                                                        </div>




                                                        <div class="col-lg-6">
                                                            <div class="mb-3 position-relative">

                                                                <label class="form-label form-label required" for="email">
                                                                    Email


                                                                </label>


                                                                <input class="form-control" data-counter="60" placeholder="e.g: example@domain.com" required="required" name="email" type="text" value="{{ old('email', $vendor->email) }}" id="email">




                                                            </div>

                                                        </div>



                                                        <div class="col-lg-12">
                                                            <div class="mb-3 position-relative">



                                                                <label class="form-check form-switch d-inline-block ">
                                                                    <input
                                                                        name="is_vendor"
                                                                        type="hidden"
                                                                        value="0" />
                                                                    <input class="form-check-input" name="is_vendor" type="checkbox" value="1" id="is_vendor" {{ old('is_vendor', $vendor->is_vendor ?? true) ? 'checked' : '' }} />

                                                                    <span class="form-check-label">Is vendor?</span>
                                                                </label>




                                                            </div>

                                                        </div>



                                                        <div class="col-lg-6">
                                                            <div class="mb-3 position-relative">
                                                                <label class="form-label" for="shop_name">
                                                                    Shop Name
                                                                </label>
                                                                <input class="form-control" placeholder="Shop Name" name="shop_name" type="text" value="{{ old('shop_name', $vendor->store->name ?? '') }}" id="shop_name">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3 position-relative">
                                                                <label class="form-label" for="website">
                                                                    Shop URL (Website)
                                                                </label>
                                                                <input class="form-control" placeholder="https://example.com" name="website" type="text" value="{{ old('website', $vendor->website) }}" id="website">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3 position-relative">
                                                                <label class="form-label" for="mobile">
                                                                    Phone (Mobile)
                                                                </label>
                                                                <input class="form-control" data-counter="15" placeholder="Phone" id="mobile" name="mobile" type="text" value="{{ old('mobile', $vendor->store->phone ?? $vendor->phone ?? '') }}">
                                                            </div>
                                                        </div>



                                                        <div class="col-lg-6">
                                                            <div class="mb-3 position-relative">

                                                                <label class="form-label" for="dob">
                                                                    Date of birth


                                                                </label>


                                                                <div class="input-group datepicker">
                                                                    <input class="form-control " placeholder="Y-m-d" data-input="" readonly="readonly" name="dob" type="text" value="{{ old('dob', $vendor->dob) }}" id="dob">
                                                                    <button
                                                                        class="btn btn-icon" type="button" data-toggle="data-toggle">
                                                                        <svg class="icon icon-left svg-icon-ti-ti-calendar"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12" />
                                                                            <path d="M16 3v4" />
                                                                            <path d="M8 3v4" />
                                                                            <path d="M4 11h16" />
                                                                            <path d="M11 15h1" />
                                                                            <path d="M12 15v3" />
                                                                        </svg>

                                                                    </button>
                                                                    <button
                                                                        class="btn btn-icon   text-danger" type="button" data-clear="data-clear">
                                                                        <svg class="icon icon-left svg-icon-ti-ti-x"
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
                                                                </div>




                                                            </div>

                                                        </div>



                                                        <div class="col-lg-12">
                                                            <div class="mb-3 position-relative">



                                                                <label class="form-check form-switch d-inline-block ">
                                                                    <input
                                                                        name="is_change_password"
                                                                        type="hidden"
                                                                        value="0" />
                                                                    <input
                                                                        class="form-check-input" name="is_change_password" type="checkbox" value="1" id="is_change_password" data-bb-toggle="collapse" data-bb-target="#password-collapse" />

                                                                    <span class="form-check-label">Change password?</span>
                                                                </label>




                                                            </div>

                                                        </div>



                                                        <div class="col-lg-6">
                                                            <div class="mb-3 position-relative" data-bb-collapse="true" data-bb-trigger="[name=is_change_password]" data-bb-value="1" style="display: none">

                                                                <label class="form-label form-label required" for="password">
                                                                    Password


                                                                </label>

                                                                <input class="form-control" data-counter="60" name="password" type="password" id="password">



                                                            </div>

                                                        </div>



                                                        <div class="col-lg-6">
                                                            <div class="mb-3 position-relative" data-bb-collapse="true" data-bb-trigger="[name=is_change_password]" data-bb-value="1" style="display: none">

                                                                <label class="form-label form-label required" for="password_confirmation">
                                                                    Password confirmation


                                                                </label>

                                                                <input class="form-control" data-counter="60" name="password_confirmation" type="password" id="password_confirmation">



                                                            </div>

                                                        </div>



                                                        <div class="col-lg-12">
                                                            <div class="mb-3 position-relative">

                                                                <label class="form-label" for="private_notes">
                                                                    Private notes


                                                                </label>


                                                                <textarea class="form-control" data-counter="10000" rows="2" id="private_notes" name="private_notes" cols="50"></textarea>


                                                                <small class="form-hint">
                                                                    Private notes are only visible to admins.
                                                                </small>


                                                            </div>

                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                Addresses
                                            </h4>

                                            <div class="card-actions"><button
                                                    class="btn   btn-trigger-add-address" type="button">
                                                    <svg class="icon icon-left svg-icon-ti-ti-plus"
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
                                                    New address

                                                </button></div>
                                        </div>

                                        <div id="address-histories">
                                            <table class="table table-vcenter card-table table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            #
                                                        </th>
                                                        <th>
                                                            Address
                                                        </th>
                                                        <th>
                                                            Country
                                                        </th>
                                                        <th>
                                                            State
                                                        </th>
                                                        <th>
                                                            City
                                                        </th>
                                                        <th>
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td colspan="6" class="text-center text-muted">Thinking about implementing addresses...</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                Wishlist
                                            </h4>
                                        </div>

                                        <table class="table table-vcenter card-table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        #
                                                    </th>
                                                    <th>
                                                        Product
                                                    </th>
                                                    <th>
                                                        Created At
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr class="text-center text-muted">
                                                    <td colspan="7">
                                                        No data to display
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                Payments
                                            </h4>
                                        </div>

                                        <table class="table table-vcenter card-table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        #
                                                    </th>
                                                    <th>
                                                        Order
                                                    </th>
                                                    <th>
                                                        Charge ID
                                                    </th>
                                                    <th>
                                                        Amount
                                                    </th>
                                                    <th>
                                                        Payment methods
                                                    </th>
                                                    <th>
                                                        Status
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr class="text-center text-muted">
                                                    <td colspan="7">
                                                        No data to display
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>




                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4 class="card-title">Reviews</h4>
                                        </div>
                                        <div class="card-body">
                                            <p class="text-muted text-center">No reviews to display.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 gap-3 d-flex flex-column-reverse flex-md-column mb-md-0 mb-5">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                Publish
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="btn-list">
                                             

                                                <button
                                                    class="btn btn-primary" type="submit" name="submitter" value="save">
                                                    <svg class="icon icon-left svg-icon-ti-ti-transfer-in"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M4 18v3h16v-14l-8 -4l-8 4v3" />
                                                        <path d="M4 14h9" />
                                                        <path d="M10 11l3 3l-3 3" />
                                                    </svg>
                                                    Save &amp; Exit

                                                </button>


                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        data-bb-waypoint
                                        data-bb-target="#form-actions"></div>

                                    <header
                                        class="top-0 w-100 position-fixed end-0 z-1000"
                                        id="form-actions"
                                        style="display: none;">
                                        <div class="navbar">
                                            <div class="container-xl">
                                                <div class="row g-2 align-items-center w-100">
                                                    <div class="col">
                                                        <div class="page-pretitle">
                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb">
                                                                </ol>
                                                            </nav>

                                                        </div>
                                                    </div>
                                                    <div class="col-auto ms-auto d-print-none">
                                                        <div class="btn-list">
                                                    
                                                            <button
                                                                class="btn btn-primary" type="submit" name="submitter" value="save">
                                                                <svg class="icon icon-left svg-icon-ti-ti-transfer-in"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    width="24"
                                                                    height="24"
                                                                    viewBox="0 0 24 24"
                                                                    fill="none"
                                                                    stroke="currentColor"
                                                                    stroke-width="2"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                    <path d="M4 18v3h16v-14l-8 -4l-8 4v3" />
                                                                    <path d="M4 14h9" />
                                                                    <path d="M10 11l3 3l-3 3" />
                                                                </svg>
                                                                Save &amp; Exit

                                                            </button>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </header>



                                    <div class="card meta-boxes">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <label class="form-label form-label required" for="status">
                                                    Vendor control


                                                </label>
                                            </h4>
                                        </div>

                                        <div class="card-body">
                                            <p class="text-muted">
                                                Set the status of the vendor.
                                            </p>
                                            
                                            <div class="mb-3"> 
                                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                                    <option value="activated" {{ old('status', $vendor->status) == 'activated' ? 'selected' : '' }}>Activated</option>
                                                    <option value="locked" {{ old('status', $vendor->status) == 'locked' ? 'selected' : '' }}>Locked</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card meta-boxes">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <label class="form-label" for="avatar">
                                                    Avatar


                                                </label>
                                            </h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="image-box image-box-avatar" action="select-image" data-counter="250">
                                                <input class="image-data" name="avatar" type="hidden" value="{{ $vendor->avatar }}" class="" data-counter="250" />
                                                <input type="file" name="avatar_file" class="media-image-input d-none" accept="image/*">


                                                <div
                                                    style="width: 8rem"
                                                    class="preview-image-wrapper mb-1">
                                                    <div class="preview-image-inner">
                                                        <a
                                                            data-bb-toggle="image-picker-choose"
                                                            data-target="direct" class="image-box-actions"
                                                            data-result="avatar"
                                                            data-action="select-image"
                                                            data-allow-thumb="1"
                                                            href="#">
                                                            <img class="preview-image" data-default="{{ asset('home/placeholder.png') }}"
                                                                src="{{ $vendor->avatar_url }}"
                                                                alt="Preview image" onerror="this.src='{{ asset('home/placeholder.png') }}'" />
                                                            <span class="image-picker-backdrop"></span>
                                                        </a>
                                                        <button
                                                            class="btn btn-pill btn-icon  btn-sm image-picker-remove-button p-0" style="--bb-btn-font-size: 0.5rem;" type="button" data-bb-toggle="image-picker-remove"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="Remove image">
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
                                                    </div>
                                                </div>

                                                <a
                                                    data-bb-toggle="image-picker-choose"
                                                    data-target="direct" data-result="avatar"
                                                    data-action="select-image"
                                                    data-allow-thumb="1"
                                                    href="#">
                                                    Choose image
                                                </a>

                                                <div data-bb-toggle="upload-from-url">
                                                   
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </form>



                    </div>
                </main>

     

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.form-validate-jquery').submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var submitBtn = form.find('button[type="submit"]');

            // Disable submit button to prevent multiple submissions
            submitBtn.prop('disabled', true).addClass('btn-loading');

            $.ajax({
                type: "POST",
                url: url,
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    submitBtn.prop('disabled', false).removeClass('btn-loading');
                    
                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        });

                        if(response.redirect_url){
                            setTimeout(function() {
                                window.location.href = response.redirect_url;
                            }, 2000);
                        }
                    } else {
                        notify(response.message || 'Error occurred', 'error');
                    }
                },
                error: function (xhr) {
                    submitBtn.prop('disabled', false).removeClass('btn-loading');
                    
                    var errorMessage = 'Something went wrong!';
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        errorMessage = Object.values(errors).flat().join('<br>');
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorMessage,
                    });
                },
                complete: function() {
                    submitBtn.prop('disabled', false).removeClass('btn-loading');
                }
            });
        });
    });
</script>
@endpush
