@extends('admin-layouts.app')
@section('title', 'Store Create')
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
                                                    href="https://shofy-grocery.botble.com/admin">Dashboard</a>
                                            </li>
                                            <li
                                                class="breadcrumb-item">
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">Marketplace</h1>
                                            </li>
                                            <li
                                                class="breadcrumb-item">
                                                <a
                                                    class="mb-0 d-inline-block fs-6 lh-1"
                                                    href="https://shofy-grocery.botble.com/admin/marketplaces/stores">Stores</a>
                                            </li>
                                            <li
                                                class="breadcrumb-item active"
                                                aria-current="page">
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">New store</h1>
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


                        <div class="card">
                            <div class="card-header">
                                <ul data-bs-toggle="tabs" class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item">
                                        <a
                                            href="#information-tab"
                                            class="nav-link active"
                                            data-bs-toggle="tab">

                                            Store
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="information-tab">
                                        <form method="POST" action="{{ route('admin.marketplace.store.store') }}" id="store" enctype="multipart/form-data">
                                         
                                           @csrf
                                            <div
                                                role="alert"
                                                class="alert alert-info">
                                                <div class="d-flex gap-1">
                                                    <div>
                                                        <svg class="icon alert-icon svg-icon-ti-ti-info-circle"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                                            <path d="M12 9h.01" />
                                                            <path d="M11 12h1v4h1" />
                                                        </svg>
                                                    </div>
                                                    <div class="w-100">


                                                        You are editing "<strong class="current_language_text">English</strong>" version

                                                    </div>
                                                </div>



                                            </div>

                                            <div class="row row-cols-lg-6">



                                                <div class="col-lg-12">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label form-label required" for="name">
                                                            Name


                                                        </label>


                                                        <input class="form-control" data-counter="250" placeholder="Name" required="required" name="name" type="text" id="name">
                                                    </div>

                                                </div>



                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <input
                                                                name="reference_id"
                                                                type="hidden"
                                                                value="">
                                                            <input type="hidden" name="is_slug_editable" value="1">

                                                            <div class="mb-3 position-relative shop-url-wrapper">
                                                                <label class="form-label required" for="shop-url">
                                                                    Shop URL

                                                                    <span class="form-label-description">

                                                                    </span>

                                                                </label>



                                                                <input
                                                                    class="form-control" style="direction: ltr; text-align: left;" type="text" name="slug" id="shop-url" value="" required="required" data-url="https://shofy-grocery.botble.com/ajax/stores/check-store-url" placeholder="Shop URL" dir="ltr" />

                                                                <small class="form-hint" data-base-url="https://shofy-grocery.botble.com/stores">https://shofy-grocery.botble.com/stores</small>
                                                                <small class="form-hint">This will be your store&#039;s unique URL. Only letters, numbers, and hyphens are allowed. Example: my-awesome-store</small>
                                                            </div>
                                                        </div>
                                                    </div>





                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label form-label required" for="email">
                                                            Email


                                                        </label>


                                                        <input class="form-control" data-counter="60" placeholder="e.g: example@domain.com" required="required" name="email" type="email" id="email">




                                                    </div>

                                                </div>


                                                <div class="col-lg-12">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label form-label required" for="phone">
                                                            Phone


                                                        </label>


                                                        <input class="form-control" placeholder="Phone" data-counter="15" required="required" name="phone" type="text" id="phone">




                                                    </div>

                                                </div>


                                                <div class="col-lg-12">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label" for="description">
                                                            Description


                                                        </label>


                                                        <textarea class="form-control" data-counter="400" rows="4" placeholder="Short description" id="description" name="description" cols="50"></textarea>




                                                    </div>

                                                </div>


                                                <div class="col-lg-12">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label" for="content">
                                                            Content


                                                        </label>


                                                        <div class="mb-2 btn-list">
                                                            <button
                                                                class="btn   show-hide-editor-btn" type="button" data-result="content">

                                                                Show/Hide Editor

                                                            </button>

                                                            <button
                                                                class="btn   btn_gallery" type="button" data-result="content" data-multiple="true" data-action="media-insert-ckeditor">
                                                                <svg class="icon icon-left svg-icon-ti-ti-photo"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    width="24"
                                                                    height="24"
                                                                    viewBox="0 0 24 24"
                                                                    fill="none"
                                                                    stroke="currentColor"
                                                                    stroke-width="2"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                    <path d="M15 8h.01" />
                                                                    <path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12" />
                                                                    <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                                                                    <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />
                                                                </svg>
                                                                Add media

                                                            </button>


                                                        </div>



                                                        <textarea class="form-control form-control editor-ckeditor ays-ignore" data-counter="100000" rows="4" placeholder="Write your content" id="content" name="content" cols="50"></textarea>




                                                    </div>

                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label" for="country">
                                                            Country


                                                        </label>


                                                       <select class="form-select" name="country" id="country">
                                                            <option value="">Select country...</option>

                                                            @foreach($countries as $country)
                                                                <option value="{{ $country->code }}"
                                                                    {{ $country->is_default ? 'selected' : '' }}>
                                                                    {{ $country->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>


                                                    </div>

                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label" for="state">
                                                            State
                                                        </label>

                                                        <input class="form-control" data-counter="250" placeholder="Select state..." name="state" type="text" id="state">

                                                    </div>

                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label" for="city">
                                                            City


                                                        </label>


                                                        <input class="form-control" data-counter="250" placeholder="Select city..." name="city" type="text" id="city">

                                                    </div>

                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label" for="address">
                                                            Address


                                                        </label>


                                                        <input class="form-control" data-counter="250" placeholder="Enter address" name="address" type="text" id="address">




                                                    </div>

                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label" for="company">
                                                            Company


                                                        </label>


                                                        <input class="form-control" data-counter="255" placeholder="Company" name="company" type="text" id="company">




                                                    </div>

                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label" for="tax_id">
                                                            Tax ID


                                                        </label>


                                                        <input class="form-control" data-counter="255" name="tax_id" type="text" id="tax_id">




                                                    </div>

                                                </div>


                                                <div class="col-lg-4">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label" for="logo">
                                                            Logo


                                                        </label>


                                                        <div class="image-box image-box-logo" action="select-image" data-counter="250">
                                                            <input
                                                                class="image-data"
                                                                name="logo"
                                                                type="hidden"
                                                                value=""
                                                                class="" data-counter="250" />


                                                            <div
                                                                style="width: 8rem"
                                                                class="preview-image-wrapper mb-1">
                                                                <div class="preview-image-inner">
                                                                    <a
                                                                        data-bb-toggle="image-picker-choose"
                                                                        data-target="popup" class="image-box-actions"
                                                                        data-result="logo"
                                                                        data-action="select-image"
                                                                        data-allow-thumb="1"
                                                                        href="#">
                                                                        <img
                                                                            class="preview-image default-image" data-default="https://shofy-grocery.botble.com/vendor/core/core/base/images/placeholder.png"
                                                                            src="https://shofy-grocery.botble.com/vendor/core/core/base/images/placeholder.png"
                                                                            alt="Preview image" />
                                                                        <span class="image-picker-backdrop"></span>
                                                                    </a>
                                                                    <button
                                                                        class="btn btn-pill btn-icon  btn-sm image-picker-remove-button p-0" style="display: none; --bb-btn-font-size: 0.5rem;" type="button" data-bb-toggle="image-picker-remove"
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
                                                                data-target="popup" data-result="logo"
                                                                data-action="select-image"
                                                                data-allow-thumb="1"
                                                                href="#">
                                                                Choose image
                                                            </a>

                                                            <div data-bb-toggle="upload-from-url">
                                                                <span class="text-muted">or</span>
                                                                <a
                                                                    href="javascript:void(0)"
                                                                    class="mt-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#image-picker-add-from-url"
                                                                    data-bb-target=".image-box-logo">
                                                                    Add from URL
                                                                </a>
                                                            </div>
                                                        </div>




                                                    </div>

                                                </div>


                                                <div class="col-lg-4">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label" for="logo_square">
                                                            Square logo


                                                        </label>


                                                        <div class="image-box image-box-logo_square" action="select-image" data-counter="250">
                                                            <input
                                                                class="image-data"
                                                                name="logo_square"
                                                                type="hidden"
                                                                value=""
                                                                class="" data-counter="250" />


                                                            <div
                                                                style="width: 8rem"
                                                                class="preview-image-wrapper mb-1">
                                                                <div class="preview-image-inner">
                                                                    <a
                                                                        data-bb-toggle="image-picker-choose"
                                                                        data-target="popup" class="image-box-actions"
                                                                        data-result="logo_square"
                                                                        data-action="select-image"
                                                                        data-allow-thumb="1"
                                                                        href="#">
                                                                        <img
                                                                            class="preview-image default-image" data-default="https://shofy-grocery.botble.com/vendor/core/core/base/images/placeholder.png"
                                                                            src="https://shofy-grocery.botble.com/vendor/core/core/base/images/placeholder.png"
                                                                            alt="Preview image" />
                                                                        <span class="image-picker-backdrop"></span>
                                                                    </a>
                                                                    <button
                                                                        class="btn btn-pill btn-icon  btn-sm image-picker-remove-button p-0" style="display: none; --bb-btn-font-size: 0.5rem;" type="button" data-bb-toggle="image-picker-remove"
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
                                                                data-target="popup" data-result="logo_square"
                                                                data-action="select-image"
                                                                data-allow-thumb="1"
                                                                href="#">
                                                                Choose image
                                                            </a>

                                                            <div data-bb-toggle="upload-from-url">
                                                                <span class="text-muted">or</span>
                                                                <a
                                                                    href="javascript:void(0)"
                                                                    class="mt-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#image-picker-add-from-url"
                                                                    data-bb-target=".image-box-logo_square">
                                                                    Add from URL
                                                                </a>
                                                            </div>
                                                        </div>


                                                        <small class="form-hint">
                                                            Used in places that require a square version of your logo (for example, the checkout page).
                                                        </small>


                                                    </div>

                                                </div>


                                                <div class="col-lg-4">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label" for="cover_image">
                                                            Cover image


                                                        </label>


                                                        <div class="image-box image-box-cover_image" action="select-image" data-counter="250">
                                                            <input
                                                                class="image-data"
                                                                name="cover_image"
                                                                type="hidden"
                                                                value=""
                                                                class="" data-counter="250" />


                                                            <div
                                                                style="width: 8rem"
                                                                class="preview-image-wrapper mb-1">
                                                                <div class="preview-image-inner">
                                                                    <a
                                                                        data-bb-toggle="image-picker-choose"
                                                                        data-target="popup" class="image-box-actions"
                                                                        data-result="cover_image"
                                                                        data-action="select-image"
                                                                        data-allow-thumb="1"
                                                                        href="#">
                                                                        <img
                                                                            class="preview-image default-image" data-default="https://shofy-grocery.botble.com/vendor/core/core/base/images/placeholder.png"
                                                                            src="https://shofy-grocery.botble.com/vendor/core/core/base/images/placeholder.png"
                                                                            alt="Preview image" />
                                                                        <span class="image-picker-backdrop"></span>
                                                                    </a>
                                                                    <button
                                                                        class="btn btn-pill btn-icon  btn-sm image-picker-remove-button p-0" style="display: none; --bb-btn-font-size: 0.5rem;" type="button" data-bb-toggle="image-picker-remove"
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
                                                                data-target="popup" data-result="cover_image"
                                                                data-action="select-image"
                                                                data-allow-thumb="1"
                                                                href="#">
                                                                Choose image
                                                            </a>

                                                            <div data-bb-toggle="upload-from-url">
                                                                <span class="text-muted">or</span>
                                                                <a
                                                                    href="javascript:void(0)"
                                                                    class="mt-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#image-picker-add-from-url"
                                                                    data-bb-target=".image-box-cover_image">
                                                                    Add from URL
                                                                </a>
                                                            </div>
                                                        </div>




                                                    </div>

                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label form-label required" for="status">
                                                            Status


                                                        </label>


                                                        <select class="form-select" required="required" id="status-select-92989" name="status">
                                                            <option value="published">Published</option>
                                                            <option value="draft">Draft</option>
                                                            <option value="pending">Pending</option>
                                                        </select>




                                                    </div>

                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="mb-3 position-relative">

                                                        <label class="form-label form-label required" for="customer_id">
                                                            Store owner


                                                        </label>


                                                        <select class="form-select" required="required" id="customer_id-select-34191" name="customer_id">
                                                            <option value="0">Select a store owner...</option>
                                                            <option value="2">Juvenal Bins</option>
                                                            <option value="3">Bettie Wolf</option>
                                                            <option value="4">Linnea Rodriguez</option>
                                                            <option value="5">Mrs. Sister Ondricka</option>
                                                            <option value="6">Jailyn Mosciski</option>
                                                            <option value="7">Garth Hegmann</option>
                                                            <option value="8">Ena Buckridge</option>
                                                        </select>




                                                    </div>

                                                </div>


                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social_links_facebook">Facebook</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text px-2">https://facebook.com/</span>
                                                                    <input class="form-control" placeholder="{username}" id="social_links_facebook" name="social_links[facebook]" type="text">
                                                                    <span class="input-group-text">
                                                                        <svg class="icon svg-icon-ti-ti-brand-facebook"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                                                                        </svg> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social_links_twitter">X (Twitter)</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text px-2">https://x.com/</span>
                                                                    <input class="form-control" placeholder="{username}" id="social_links_twitter" name="social_links[twitter]" type="text">
                                                                    <span class="input-group-text">
                                                                        <svg class="icon svg-icon-ti-ti-brand-x"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M4 4l11.733 16h4.267l-11.733 -16l-4.267 0" />
                                                                            <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                                                                        </svg> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social_links_instagram">Instagram</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text px-2">https://instagram.com/</span>
                                                                    <input class="form-control" placeholder="{username}" id="social_links_instagram" name="social_links[instagram]" type="text">
                                                                    <span class="input-group-text">
                                                                        <svg class="icon svg-icon-ti-ti-brand-instagram"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M4 8a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4l0 -8" />
                                                                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                                                            <path d="M16.5 7.5v.01" />
                                                                        </svg> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social_links_pinterest">Pinterest</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text px-2">https://pinterest.com/</span>
                                                                    <input class="form-control" placeholder="{username}" id="social_links_pinterest" name="social_links[pinterest]" type="text">
                                                                    <span class="input-group-text">
                                                                        <svg class="icon svg-icon-ti-ti-brand-pinterest"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M8 20l4 -9" />
                                                                            <path d="M10.7 14c.437 1.263 1.43 2 2.55 2c2.071 0 3.75 -1.554 3.75 -4a5 5 0 1 0 -9.7 1.7" />
                                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                                        </svg> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social_links_youtube">Youtube</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text px-2">https://youtube.com/</span>
                                                                    <input class="form-control" placeholder="{username}" id="social_links_youtube" name="social_links[youtube]" type="text">
                                                                    <span class="input-group-text">
                                                                        <svg class="icon svg-icon-ti-ti-brand-youtube"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M2 8a4 4 0 0 1 4 -4h12a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-12a4 4 0 0 1 -4 -4v-8" />
                                                                            <path d="M10 9l5 3l-5 3l0 -6" />
                                                                        </svg> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social_links_linkedin">Linkedin</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text px-2">https://linkedin.com/</span>
                                                                    <input class="form-control" placeholder="{username}" id="social_links_linkedin" name="social_links[linkedin]" type="text">
                                                                    <span class="input-group-text">
                                                                        <svg class="icon svg-icon-ti-ti-brand-linkedin"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M8 11v5" />
                                                                            <path d="M8 8v.01" />
                                                                            <path d="M12 16v-5" />
                                                                            <path d="M16 16v-3a2 2 0 1 0 -4 0" />
                                                                            <path d="M3 7a4 4 0 0 1 4 -4h10a4 4 0 0 1 4 4v10a4 4 0 0 1 -4 4h-10a4 4 0 0 1 -4 -4l0 -10" />
                                                                        </svg> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social_links_messenger">Messenger</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text px-2">https://messenger.com/</span>
                                                                    <input class="form-control" placeholder="{username}" id="social_links_messenger" name="social_links[messenger]" type="text">
                                                                    <span class="input-group-text">
                                                                        <svg class="icon svg-icon-ti-ti-brand-messenger"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
                                                                            <path d="M8 13l3 -2l2 2l3 -2" />
                                                                        </svg> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social_links_flickr">Flickr</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text px-2">https://flickr.com/</span>
                                                                    <input class="form-control" placeholder="{username}" id="social_links_flickr" name="social_links[flickr]" type="text">
                                                                    <span class="input-group-text">
                                                                        <svg class="icon svg-icon-ti-ti-brand-flickr"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M4 12a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                                            <path d="M14 12a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                                        </svg> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social_links_tiktok">Tiktok</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text px-2">https://tiktok.com/</span>
                                                                    <input class="form-control" placeholder="{username}" id="social_links_tiktok" name="social_links[tiktok]" type="text">
                                                                    <span class="input-group-text">
                                                                        <svg class="icon svg-icon-ti-ti-brand-tiktok"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M21 7.917v4.034a9.948 9.948 0 0 1 -5 -1.951v4.5a6.5 6.5 0 1 1 -8 -6.326v4.326a2.5 2.5 0 1 0 4 2v-11.5h4.083a6.005 6.005 0 0 0 4.917 4.917" />
                                                                        </svg> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social_links_skype">Skype</label>
                                                                <div class="input-group mb-3">
                                                                    <input class="form-control" placeholder="Ex: https://skype.com/{username}" id="social_links_skype" name="social_links[skype]" type="text">
                                                                    <span class="input-group-text">
                                                                        <svg class="icon svg-icon-ti-ti-brand-skype"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M12 3a9 9 0 0 1 8.603 11.65a4.5 4.5 0 0 1 -5.953 5.953a9 9 0 0 1 -11.253 -11.253a4.5 4.5 0 0 1 5.953 -5.954a8.987 8.987 0 0 1 2.65 -.396" />
                                                                            <path d="M8 14.5c.5 2 2.358 2.5 4 2.5c2.905 0 4 -1.187 4 -2.5c0 -1.503 -1.927 -2.5 -4 -2.5s-4 -1 -4 -2.5c0 -1.313 1.095 -2.5 4 -2.5c1.642 0 3.5 .5 4 2.5" />
                                                                        </svg> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social_links_snapchat">Snapchat</label>
                                                                <div class="input-group mb-3">
                                                                    <input class="form-control" placeholder="Ex: https://snapchat.com/{username}" id="social_links_snapchat" name="social_links[snapchat]" type="text">
                                                                    <span class="input-group-text">
                                                                        <svg class="icon svg-icon-ti-ti-brand-snapchat"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M16.882 7.842a4.882 4.882 0 0 0 -9.764 0c0 4.273 -.213 6.409 -4.118 8.118c2 .882 2 .882 3 3c3 0 4 2 6 2s3 -2 6 -2c1 -2.118 1 -2.118 3 -3c-3.906 -1.709 -4.118 -3.845 -4.118 -8.118m-13.882 8.119c4 -2.118 4 -4.118 1 -7.118m17 7.118c-4 -2.118 -4 -4.118 -1 -7.118" />
                                                                        </svg> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social_links_tumblr">Tumblr</label>
                                                                <div class="input-group mb-3">
                                                                    <input class="form-control" placeholder="Ex: https://tumblr.com/{username}" id="social_links_tumblr" name="social_links[tumblr]" type="text">
                                                                    <span class="input-group-text">
                                                                        <svg class="icon svg-icon-ti-ti-brand-tumblr"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M14 21h4v-4h-4v-6h4v-4h-4v-4h-4v1a3 3 0 0 1 -3 3h-1v4h4v6a4 4 0 0 0 4 4" />
                                                                        </svg> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social_links_whatsapp">Whatsapp</label>
                                                                <div class="input-group mb-3">
                                                                    <input class="form-control" placeholder="Ex: https://whatsapp.com/{username}" id="social_links_whatsapp" name="social_links[whatsapp]" type="text">
                                                                    <span class="input-group-text">
                                                                        <svg class="icon svg-icon-ti-ti-brand-whatsapp"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                                                                            <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                                                                        </svg> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social_links_wechat">Wechat</label>
                                                                <div class="input-group mb-3">
                                                                    <input class="form-control" placeholder="Ex: https://wechat.com/{username}" id="social_links_wechat" name="social_links[wechat]" type="text">
                                                                    <span class="input-group-text">
                                                                        <svg class="icon svg-icon-ti-ti-brand-wechat"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M16.5 10c3.038 0 5.5 2.015 5.5 4.5c0 1.397 -.778 2.645 -2 3.47l0 2.03l-1.964 -1.178a6.649 6.649 0 0 1 -1.536 .178c-3.038 0 -5.5 -2.015 -5.5 -4.5s2.462 -4.5 5.5 -4.5" />
                                                                            <path d="M11.197 15.698c-.69 .196 -1.43 .302 -2.197 .302a8.008 8.008 0 0 1 -2.612 -.432l-2.388 1.432v-2.801c-1.237 -1.082 -2 -2.564 -2 -4.199c0 -3.314 3.134 -6 7 -6c3.782 0 6.863 2.57 7 5.785l0 .233" />
                                                                            <path d="M10 8h.01" />
                                                                            <path d="M7 8h.01" />
                                                                            <path d="M15 14h.01" />
                                                                            <path d="M18 14h.01" />
                                                                        </svg> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="social_links_vimeo">Vimeo</label>
                                                                <div class="input-group mb-3">
                                                                    <input class="form-control" placeholder="Ex: https://vimeo.com/{username}" id="social_links_vimeo" name="social_links[vimeo]" type="text">
                                                                    <span class="input-group-text">
                                                                        <svg class="icon svg-icon-ti-ti-brand-vimeo"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M3 8.5l1 1s1.5 -1.102 2 -.5c.509 .609 1.863 7.65 2.5 9c.556 1.184 1.978 2.89 4 1.5c2 -1.5 7.5 -5.5 8.5 -11.5c.444 -2.661 -1 -4 -2.5 -4c-2 0 -4.047 1.202 -4.5 4c2.05 -1.254 2.551 1 1.5 3c-1.052 2 -2 3 -2.5 3c-.49 0 -.924 -1.165 -1.5 -3.5c-.59 -2.42 -.5 -6.5 -3 -6.5s-5.5 4.5 -5.5 4.5" />
                                                                        </svg> </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>







                                            </div>


                                            <div
                                                id="advanced-sortables"
                                                class="meta-box-sortables">
                                                <div class="card meta-boxes mb-3" id="seo_wrap">
                                                    <div class="card-header">
                                                        <h4 class="card-title">
                                                            Search Engine Optimize
                                                        </h4>

                                                        <div class="card-actions"><a
                                                                href="#"
                                                                class="btn-trigger-show-seo-detail">
                                                                Edit SEO meta
                                                            </a></div>
                                                    </div>

                                                    <div class="card-body">
                                                        <div
                                                            class="seo-preview"
                                                            v-pre>
                                                            <p class="default-seo-description">
                                                                Setup meta title &amp; description to make your site easy to discovered on search engines such as Google
                                                            </p>

                                                            <div class="existed-seo-meta hidden">

                                                                <h4 class="page-title-seo text-truncate">

                                                                </h4>

                                                                <div class="page-url-seo">
                                                                    <p>-
                                                                    </p>
                                                                </div>

                                                                <div>
                                                                    <span
                                                                        style="color: #70757a;">Jan 30, 2026
                                                                        - </span>
                                                                    <span class="page-description-seo">
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="hidden seo-edit-section"
                                                            v-pre>
                                                            <hr class="my-4">
                                                            </hr>

                                                            <div class="mb-3 position-relative">

                                                                <label class="form-label" for="seo_meta[seo_title]">
                                                                    SEO Title


                                                                </label>


                                                                <input class="form-control" data-counter="70" placeholder="SEO Title" data-allow-over-limit name="seo_meta[seo_title]" type="text" id="seo_meta[seo_title]">


                                                                <small class="form-hint">
                                                                    Optimal length: 50-60 characters. This appears as the clickable headline in search results.
                                                                </small>


                                                            </div>



                                                            <div class="mb-3 position-relative">

                                                                <label class="form-label" for="seo_meta[seo_description]">
                                                                    SEO description


                                                                </label>


                                                                <textarea class="form-control" data-counter="160" rows="3" placeholder="SEO description" data-allow-over-limit id="seo_meta[seo_description]" name="seo_meta[seo_description]" cols="50"></textarea>


                                                                <small class="form-hint">
                                                                    Optimal length: 120-160 characters. This appears below the title in search results and should entice users to click.
                                                                </small>


                                                            </div>



                                                            <div
                                                                role="alert"
                                                                class="alert alert-info">
                                                                <div class="d-flex gap-1">
                                                                    <div>
                                                                        <svg class="icon alert-icon svg-icon-ti-ti-info-circle"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                                                            <path d="M12 9h.01" />
                                                                            <path d="M11 12h1v4h1" />
                                                                        </svg>
                                                                    </div>
                                                                    <div class="w-100">


                                                                        Meta keywords was removed by Google, you don't need to add meta keywords to your website. Learn more: <a href="https://yoast.com/meta-keywords">https://yoast.com/meta-keywords</a>

                                                                    </div>
                                                                </div>



                                                            </div>







                                                            <div class="mb-3 position-relative">

                                                                <label class="form-label" for="seo_meta_image">
                                                                    SEO image


                                                                </label>


                                                                <div class="image-box image-box-seo_meta_image" action="select-image" data-counter="250">
                                                                    <input
                                                                        class="image-data"
                                                                        name="seo_meta_image"
                                                                        type="hidden"
                                                                        value=""
                                                                        class="" data-counter="250" />


                                                                    <div
                                                                        style="width: 8rem"
                                                                        class="preview-image-wrapper mb-1">
                                                                        <div class="preview-image-inner">
                                                                            <a
                                                                                data-bb-toggle="image-picker-choose"
                                                                                data-target="popup" class="image-box-actions"
                                                                                data-result="seo_meta_image"
                                                                                data-action="select-image"
                                                                                data-allow-thumb="1"
                                                                                href="#">
                                                                                <img
                                                                                    class="preview-image default-image" data-default="https://shofy-grocery.botble.com/vendor/core/core/base/images/placeholder.png"
                                                                                    src="https://shofy-grocery.botble.com/vendor/core/core/base/images/placeholder.png"
                                                                                    alt="Preview image" />
                                                                                <span class="image-picker-backdrop"></span>
                                                                            </a>
                                                                            <button
                                                                                class="btn btn-pill btn-icon  btn-sm image-picker-remove-button p-0" style="display: none; --bb-btn-font-size: 0.5rem;" type="button" data-bb-toggle="image-picker-remove"
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
                                                                        data-target="popup" data-result="seo_meta_image"
                                                                        data-action="select-image"
                                                                        data-allow-thumb="1"
                                                                        href="#">
                                                                        Choose image
                                                                    </a>

                                                                    <div data-bb-toggle="upload-from-url">
                                                                        <span class="text-muted">or</span>
                                                                        <a
                                                                            href="javascript:void(0)"
                                                                            class="mt-1"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#image-picker-add-from-url"
                                                                            data-bb-target=".image-box-seo_meta_image">
                                                                            Add from URL
                                                                        </a>
                                                                    </div>
                                                                </div>


                                                                <small class="form-hint">
                                                                    Recommended size: 1200x630px. This image appears when your page is shared on social media platforms.
                                                                </small>


                                                            </div>



                                                            <div class="mb-3 position-relative">

                                                                <label class="form-label" for="seo_meta[index]">
                                                                    Index


                                                                </label>


                                                                <div class="position-relative form-check-group">

                                                                    <label class="form-check form-check-inline">
                                                                        <input
                                                                            class="form-check-input" id="seo_meta[index]_index"
                                                                            type="radio"
                                                                            name="seo_meta[index]"
                                                                            value="index"
                                                                            checked>

                                                                        <span class="form-check-label">Index</span>
                                                                    </label>

                                                                    <label class="form-check form-check-inline">
                                                                        <input
                                                                            class="form-check-input" id="seo_meta[index]_index_noindex"
                                                                            type="radio"
                                                                            name="seo_meta[index]"
                                                                            value="noindex">

                                                                        <span class="form-check-label">No index</span>
                                                                    </label>
                                                                </div>


                                                                <small class="form-hint">
                                                                    Choose "Index" to allow search engines to show this page in search results, or "No index" to prevent it from appearing in search results.
                                                                </small>


                                                            </div>

                                                        </div>
                                                    </div>
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
                                                      

                                                        <button
                                                            class="btn btn-success" type="submit" name="submitter" value="save">
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


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </main>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#store').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            var formData = new FormData(form);
            var submitBtn = $(form).find('button[type="submit"]');
            
            // Clear previous errors
            $('.invalid-feedback').remove();
            $('.is-invalid').removeClass('is-invalid');
            
            $.ajax({
                url: $(form).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    submitBtn.prop('disabled', true).addClass('btn-loading');
                },
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(function() {
                            if (response.redirect_url) {
                                window.location.href = response.redirect_url;
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Something went wrong!'
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            var input = $('[name="' + key + '"]');
                            input.addClass('is-invalid');
                            input.after('<div class="invalid-feedback">' + value[0] + '</div>');
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: 'Please check the form for errors.'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An unexpected error occurred. Please try again.'
                        });
                    }
                },
                complete: function() {
                    submitBtn.prop('disabled', false).removeClass('btn-loading');
                }
            });
        });
    });
</script>
@endpush
