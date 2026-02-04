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
                                        href="{{ url('/admin') }}">Dashboard</a>
                                </li>
                                <li
                                    class="breadcrumb-item">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Marketplace</h1>
                                </li>
                                <li
                                    class="breadcrumb-item">
                                    <a
                                        class="mb-0 d-inline-block fs-6 lh-1"
                                        href="{{ route('admin.marketplace.store.index') }}">Stores</a>
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
                                                        class="form-control" style="direction: ltr; text-align: left;" type="text" name="slug" id="shop-url" value="" required="required" data-url="{{ url('/ajax/stores/check-store-url') }}" placeholder="Shop URL" dir="ltr" />

                                                    <small class="form-hint" data-base-url="{{ url('/stores') }}">{{ url('/stores') }}</small>
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
                                                <!-- <option value="">Select country...</option> -->
                                                <option value="India">India</option>
                                              

                                              
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


                                            <div class="image-box image-box-logo">
                                                <input type="file" name="logo" id="logo-input" style="display:none" accept="image/*" onchange="previewImage(this, '.preview-logo', '.remove-logo-btn')">
                                                <div class="preview-image-wrapper mb-1" style="width: 8rem">
                                                    <div class="preview-image-inner">
                                                        <a href="javascript:void(0)" onclick="$('#logo-input').trigger('click')" class="image-box-actions">
                                                            <img class="preview-logo preview-image default-image" 
                                                                 data-default="{{ asset('images/placeholder.png') }}"
                                                                 src="{{ asset('images/placeholder.png') }}"
                                                                 alt="Preview image" style="width: 8rem; height: 8rem; object-fit: cover;" />
                                                            <span class="image-picker-backdrop"></span>
                                                        </a>
                                                        <button class="btn btn-pill btn-icon btn-sm image-picker-remove-button p-0 remove-logo-btn" 
                                                                style="display: none; --bb-btn-font-size: 0.5rem;" 
                                                                type="button" 
                                                                onclick="removeImage('.preview-logo', '#logo-input', this)"
                                                                title="Remove image">
                                                            <svg class="icon icon-sm icon-left svg-icon-ti-ti-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M18 6l-12 12" />
                                                                <path d="M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0)" onclick="$('#logo-input').trigger('click')">Choose image</a>
                                            </div>




                                        </div>

                                    </div>


                                    <div class="col-lg-4">
                                        <div class="mb-3 position-relative">

                                            <label class="form-label" for="logo_square">
                                                Square logo


                                            </label>


                                            <div class="image-box image-box-logo_square">
                                                <input type="file" name="logo_square" id="logo-square-input" style="display:none" accept="image/*" onchange="previewImage(this, '.preview-logo-square', '.remove-logo-square-btn')">
                                                <div class="preview-image-wrapper mb-1" style="width: 8rem">
                                                    <div class="preview-image-inner">
                                                        <a href="javascript:void(0)" onclick="$('#logo-square-input').trigger('click')" class="image-box-actions">
                                                            <img class="preview-logo-square preview-image default-image" 
                                                                 data-default="{{ asset('images/placeholder.png') }}"
                                                                 src="{{ asset('images/placeholder.png') }}"
                                                                 alt="Preview image" style="width: 8rem; height: 8rem; object-fit: cover;" />
                                                            <span class="image-picker-backdrop"></span>
                                                        </a>
                                                        <button class="btn btn-pill btn-icon btn-sm image-picker-remove-button p-0 remove-logo-square-btn" 
                                                                style="display: none; --bb-btn-font-size: 0.5rem;" 
                                                                type="button" 
                                                                onclick="removeImage('.preview-logo-square', '#logo-square-input', this)"
                                                                title="Remove image">
                                                            <svg class="icon icon-sm icon-left svg-icon-ti-ti-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M18 6l-12 12" />
                                                                <path d="M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0)" onclick="$('#logo-square-input').trigger('click')">Choose image</a>
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


                                            <div class="image-box image-box-cover_image">
                                                <input type="file" name="cover_image" id="cover-image-input" style="display:none" accept="image/*" onchange="previewImage(this, '.preview-cover-image', '.remove-cover-image-btn')">
                                                <div class="preview-image-wrapper mb-1" style="width: 8rem">
                                                    <div class="preview-image-inner">
                                                        <a href="javascript:void(0)" onclick="$('#cover-image-input').trigger('click')" class="image-box-actions">
                                                            <img class="preview-cover-image preview-image default-image" 
                                                                 data-default="{{ asset('images/placeholder.png') }}"
                                                                 src="{{ asset('images/placeholder.png') }}"
                                                                 alt="Preview image" style="width: 8rem; height: 8rem; object-fit: cover;" />
                                                            <span class="image-picker-backdrop"></span>
                                                        </a>
                                                        <button class="btn btn-pill btn-icon btn-sm image-picker-remove-button p-0 remove-cover-image-btn" 
                                                                style="display: none; --bb-btn-font-size: 0.5rem;" 
                                                                type="button" 
                                                                onclick="removeImage('.preview-cover-image', '#cover-image-input', this)"
                                                                title="Remove image">
                                                            <svg class="icon icon-sm icon-left svg-icon-ti-ti-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M18 6l-12 12" />
                                                                <path d="M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0)" onclick="$('#cover-image-input').trigger('click')">Choose image</a>
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
                                                <option value="">Select a store owner...</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}"
                                                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                        {{ $customer->name }}
                                                    </option>
                                                @endforeach
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


                                                    <div class="image-box image-box-seo_meta_image">
                                                        <input type="file" name="seo_meta_image" id="seo-meta-image-input" style="display:none" accept="image/*" onchange="previewImage(this, '.preview-seo-meta-image', '.remove-seo-meta-image-btn')">
                                                        <div class="preview-image-wrapper mb-1" style="width: 8rem">
                                                            <div class="preview-image-inner">
                                                                <a href="javascript:void(0)" onclick="$('#seo-meta-image-input').trigger('click')" class="image-box-actions">
                                                                    <img class="preview-seo-meta-image preview-image default-image" 
                                                                         data-default="{{ asset('images/placeholder.png') }}"
                                                                         src="{{ asset('images/placeholder.png') }}"
                                                                         alt="Preview image" style="width: 8rem; height: 8rem; object-fit: cover;" />
                                                                    <span class="image-picker-backdrop"></span>
                                                                </a>
                                                                <button class="btn btn-pill btn-icon btn-sm image-picker-remove-button p-0 remove-seo-meta-image-btn" 
                                                                        style="display: none; --bb-btn-font-size: 0.5rem;" 
                                                                        type="button" 
                                                                        onclick="removeImage('.preview-seo-meta-image', '#seo-meta-image-input', this)"
                                                                        title="Remove image">
                                                                    <svg class="icon icon-sm icon-left svg-icon-ti-ti-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path d="M18 6l-12 12" />
                                                                        <path d="M6 6l12 12" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <a href="javascript:void(0)" onclick="$('#seo-meta-image-input').trigger('click')">Choose image</a>
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
        function previewImage(input, selector, btnSelector) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(selector).attr('src', e.target.result);
                    if(btnSelector) $(btnSelector).show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage(imageSelector, inputSelector, btn) {
            if (confirm('Are you sure you want to remove this image?')) {
                $(imageSelector).attr('src', $(imageSelector).data('default'));
                $(inputSelector).val('');
                $(btn).hide();
            }
        }

        $(document).ready(function() {
            $('#store').on('submit', function(e) {
                e.preventDefault();
                var form = this;

                // Ensure CKEditor content is synced
                if (typeof CKEDITOR !== 'undefined') {
                    for (var instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }
                }

                var formData = new FormData(form);
                
                // Manually append files to ensure they are captured
                if ($('#logo-input')[0].files[0]) {
                    formData.append('logo', $('#logo-input')[0].files[0]);
                }
                if ($('#logo-square-input')[0].files[0]) {
                    formData.append('logo_square', $('#logo-square-input')[0].files[0]);
                }
                if ($('#cover-image-input')[0].files[0]) {
                    formData.append('cover_image', $('#cover-image-input')[0].files[0]);
                }
                if ($('#seo-meta-image-input')[0].files[0]) {
                    formData.append('seo_meta_image', $('#seo-meta-image-input')[0].files[0]);
                }

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

                            var firstError = $('.is-invalid').first();
                            if (firstError.length) {
                                $('html, body').animate({
                                    scrollTop: firstError.offset().top - 150
                                }, 500);
                                firstError.focus();
                            }
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