@extends('admin-layouts.app')

@section('title', 'Edit Page')

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
                                                <a
                                                    class="mb-0 d-inline-block fs-6 lh-1"
                                                    href="{{ route('admin.pages.index') }}">Pages</a>
                                            </li>
                                            <li
                                                class="breadcrumb-item active"
                                                aria-current="page">
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">Edit Page: {{ $page->name }}</h1>
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


                        <form method="POST" action="{{ route('admin.pages.update', $page->id) }}" accept-charset="UTF-8" id="botble-page-forms-page-form" class="js-base-form dirty-check">
                            @csrf
                            @method('PUT')

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

                            <div class="row">
                                <div class="gap-3 col-md-9">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="form-body">




                                                <div class="mb-3 position-relative">

                                                    <label class="form-label form-label required" for="name">
                                                        Name


                                                    </label>


                                                    <input class="form-control" data-counter="120" placeholder="Name" required="required" name="name" type="text" id="name" value="{{ old('name', $page->name) }}">




                                                </div>





                                                <input
                                                    type="hidden"
                                                    name="model"
                                                    value="Botble\Page\Models\Page">

                                                <div class="mb-3 ">
                                                    <div
                                                        class="slug-field-wrapper"
                                                        data-field-name="name">
                                                        <div class="mb-3 position-relative">
                                                            <label class="form-label required" for="slug">
                                                                Permalink


                                                            </label>

                                                            <div class="input-group input-group-flat">

                                                                <span class="input-group-text">
                                                                    {{ url('/') }}/
                                                                </span>

                                                                <input
                                                                    class="form-control ps-0" type="text" name="slug" id="slug" required="required" value="{{ old('slug', $page->slug) }}" />


                                                                <span class="input-group-text slug-actions">
                                                                    <a
                                                                        href="#"
                                                                        class="link-secondary d-none"
                                                                        data-bs-toggle="tooltip"
                                                                        aria-label="Generate URL"
                                                                        data-bs-original-title="Generate URL"
                                                                        data-bb-toggle="generate-slug">
                                                                        <svg class="icon svg-icon-ti-ti-wand"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24"
                                                                            height="24"
                                                                            viewBox="0 0 24 24"
                                                                            fill="none"
                                                                            stroke="currentColor"
                                                                            stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                            <path d="M6 21l15 -15l-3 -3l-15 15l3 3" />
                                                                            <path d="M15 6l3 3" />
                                                                            <path d="M9 3a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2" />
                                                                            <path d="M19 13a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2" />
                                                                        </svg> </a>
                                                                </span>

                                                            </div>
                                                        </div>
                                                        <small class="form-hint mt-n2 text-truncate">Preview: <a
                                                                href="{{ url('/') }}/{{ $page->slug }}"
                                                                target="_blank">{{ url('/') }}/{{ $page->slug }}</a></small>
                                                        <input
                                                            class="slug-current"
                                                            name="slug"
                                                            type="hidden"
                                                            value="">
                                                        <div
                                                            class="slug-data"
                                                            data-url="https://shofy-grocery.botble.com/ajax/slug/create"
                                                            data-view="https://shofy-grocery.botble.com/"
                                                            data-id="0"></div>
                                                        <input
                                                            name="slug_id"
                                                            type="hidden"
                                                            value="0">
                                                        <input
                                                            name="is_slug_editable"
                                                            type="hidden"
                                                            value="1">
                                                    </div>


                                                </div>




                                                <div class="mb-3 position-relative">

                                                    <label class="form-label" for="description">
                                                        Description


                                                    </label>


                                                    <textarea class="form-control" data-counter="400" rows="4" placeholder="Short description" id="description" name="description" cols="50">{{ old('description', $page->description) }}</textarea>




                                                </div>




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

                                                        <button
                                                            class="btn   add_shortcode_btn_trigger" type="button" data-bb-toggle="shortcode-list-modal" data-result="content">

                                                            <svg class="icon svg-icon-ti-ti-box"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="24"
                                                                height="24"
                                                                viewBox="0 0 24 24"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                stroke-width="2"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                                                <path d="M12 12l8 -4.5" />
                                                                <path d="M12 12l0 9" />
                                                                <path d="M12 12l-8 -4.5" />
                                                            </svg>
                                                            UI Blocks

                                                        </button>

                                                    </div>



                                                    <textarea class="form-control form-control editor-ckeditor ays-ignore" data-counter="100000" rows="4" placeholder="Write your content" with-short-code id="content" name="content" cols="50">{{ old('content', $page->content) }}</textarea>




                                                </div>




                                            </div>
                                        </div>
                                    </div>


                                    <div
                                        id="advanced-sortables"
                                        class="meta-box-sortables">
                                        <div class="card meta-boxes mb-3" id="faq_schema_config_wrapper">
                                            <div class="card-header">
                                                <h4 class="card-title">
                                                    FAQ schema configuration (<a href="https://developers.google.com/search/docs/appearance/structured-data/faqpage" target="_blank" rel="noreferrer noopener">Learn more</a>)
                                                </h4>
                                            </div>

                                            <div class="card-body">
                                                <div class="alert alert-info mb-3">
                                                    <svg class="icon svg-icon-ti-ti-info-circle"
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
                                                    <div>
                                                        This configuration registers FAQ structured data for SEO purposes only. It will not be displayed in your front-end theme content. The schema is embedded in the page source and can be viewed using &quot;View Source&quot; or tested with Google&#039;s Rich Results Test tool.
                                                        <div class="mt-2">
                                                            <a href="https://search.google.com/test/rich-results" target="_blank" rel="noopener noreferrer">Test with Google Rich Results Test</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="faq-schema-items">
                                                    <input
                                                        name="faq_schema_config"
                                                        type="hidden"
                                                        value="[]">

                                                    <div
                                                        class="repeater-group"
                                                        id="repeater_field_87fbb392676c2e40c750bdd1139f90ef_6985db1373f7b_group"
                                                        data-next-index="0">
                                                    </div>

                                                    <div class="mb-3">
                                                        <button
                                                            class="btn" type="button" data-target="repeater-add" data-id="repeater_field_87fbb392676c2e40c750bdd1139f90ef_6985db1373f7b">

                                                            Add new

                                                        </button>
                                                    </div>


                                                </div>

                                                <div class="d-inline">
                                                    <span>or</span>
                                                    <a
                                                        href="javascript:void(0)"
                                                        data-bb-toggle="select-from-existing">
                                                        Select from existing FAQs
                                                    </a>
                                                </div>

                                                <div
                                                    class="existing-faq-schema-items mt-2"
                                                    style="display: none;">
                                                    <div
                                                        class="position-relative"
                                                        data-bb-toggle="dropdown-checkboxes"
                                                        data-name="selected_existing_faqs[]"
                                                        data-selected-text="selected"
                                                        data-placeholder="Select an option">
                                                        <span class="form-select text-truncate">Select an option</span>


                                                        <input
                                                            type="text"
                                                            class="form-select"
                                                            placeholder="Search..."
                                                            style="display: none">

                                                        <div class="dropdown-menu dropdown-menu-end w-100">
                                                            <div data-bb-toggle="tree-checkboxes">
                                                                <ul class="list-unstyled p-3 pb-0">
                                                                    <li>
                                                                        <label class="form-check">
                                                                            <input
                                                                                type="checkbox" id="selected-existing-faqs-item-1" name="selected_existing_faqs[]" class="form-check-input"
                                                                                value="1">

                                                                            <span class="form-check-label">
                                                                                What Shipping Methods Are Available?
                                                                            </span>

                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="form-check">
                                                                            <input
                                                                                type="checkbox" id="selected-existing-faqs-item-2" name="selected_existing_faqs[]" class="form-check-input"
                                                                                value="2">

                                                                            <span class="form-check-label">
                                                                                Do You Ship Internationally?
                                                                            </span>

                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="form-check">
                                                                            <input
                                                                                type="checkbox" id="selected-existing-faqs-item-3" name="selected_existing_faqs[]" class="form-check-input"
                                                                                value="3">

                                                                            <span class="form-check-label">
                                                                                How Long Will It Take To Get My Package?
                                                                            </span>

                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="form-check">
                                                                            <input
                                                                                type="checkbox" id="selected-existing-faqs-item-4" name="selected_existing_faqs[]" class="form-check-input"
                                                                                value="4">

                                                                            <span class="form-check-label">
                                                                                What Payment Methods Are Accepted?
                                                                            </span>

                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="form-check">
                                                                            <input
                                                                                type="checkbox" id="selected-existing-faqs-item-5" name="selected_existing_faqs[]" class="form-check-input"
                                                                                value="5">

                                                                            <span class="form-check-label">
                                                                                Is Buying On-Line Safe?
                                                                            </span>

                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="form-check">
                                                                            <input
                                                                                type="checkbox" id="selected-existing-faqs-item-6" name="selected_existing_faqs[]" class="form-check-input"
                                                                                value="6">

                                                                            <span class="form-check-label">
                                                                                How do I place an Order?
                                                                            </span>

                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="form-check">
                                                                            <input
                                                                                type="checkbox" id="selected-existing-faqs-item-7" name="selected_existing_faqs[]" class="form-check-input"
                                                                                value="7">

                                                                            <span class="form-check-label">
                                                                                How Can I Cancel Or Change My Order?
                                                                            </span>

                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="form-check">
                                                                            <input
                                                                                type="checkbox" id="selected-existing-faqs-item-8" name="selected_existing_faqs[]" class="form-check-input"
                                                                                value="8">

                                                                            <span class="form-check-label">
                                                                                Do I need an account to place an order?
                                                                            </span>

                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="form-check">
                                                                            <input
                                                                                type="checkbox" id="selected-existing-faqs-item-9" name="selected_existing_faqs[]" class="form-check-input"
                                                                                value="9">

                                                                            <span class="form-check-label">
                                                                                How Do I Track My Order?
                                                                            </span>

                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="form-check">
                                                                            <input
                                                                                type="checkbox" id="selected-existing-faqs-item-10" name="selected_existing_faqs[]" class="form-check-input"
                                                                                value="10">

                                                                            <span class="form-check-label">
                                                                                How Can I Return a Product?
                                                                            </span>

                                                                        </label>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
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
                                                                style="color: #70757a;">Feb 06, 2026
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
                                                    class="btn btn-primary" type="submit" value="apply" name="submitter">
                                                    <svg class="icon icon-left svg-icon-ti-ti-device-floppy"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                        <path d="M10 14a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M14 4l0 4l-6 0l0 -4" />
                                                    </svg>
                                                    Save

                                                </button>

                                                <button
                                                    class="btn" type="submit" name="submitter" value="save">
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
                                                                class="btn btn-primary" type="submit" value="apply" name="submitter">
                                                                <svg class="icon icon-left svg-icon-ti-ti-device-floppy"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    width="24"
                                                                    height="24"
                                                                    viewBox="0 0 24 24"
                                                                    fill="none"
                                                                    stroke="currentColor"
                                                                    stroke-width="2"
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round">
                                                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                                    <path d="M10 14a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                                                </svg>
                                                                Save

                                                            </button>

                                                            <button
                                                                class="btn" type="submit" name="submitter" value="save">
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
                                                    Status


                                                </label>
                                            </h4>
                                        </div>


                                        <div class=" card-body">
                                            <select class="form-select" required="required" id="status-select-75923" name="status">
                                                <option value="published" {{ old('status', $page->status) == 'published' ? 'selected' : '' }}>Published</option>
                                                <option value="draft" {{ old('status', $page->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                                <option value="pending" {{ old('status', $page->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                            </select>






                                        </div>
                                    </div>
                                    <div class="card meta-boxes">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <label class="form-label form-label required" for="template">
                                                    Template


                                                </label>
                                            </h4>
                                        </div>


                                        <div class=" card-body">
                                            <select class="form-select" required="required" id="template-select-56730" name="template">
                                                <option value="default" {{ old('template', $page->template) == 'default' ? 'selected' : '' }}>Default</option>
                                                <option value="full-width" {{ old('template', $page->template) == 'full-width' ? 'selected' : '' }}>Full width</option>
                                                <option value="without-layout" {{ old('template', $page->template) == 'without-layout' ? 'selected' : '' }}>Without layout</option>
                                            </select>






                                        </div>
                                    </div>
                                    <div class="card meta-boxes">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <label class="form-label" for="image">
                                                    Image


                                                </label>
                                            </h4>
                                        </div>


                                        <div class=" card-body">
                                            <div class="image-box image-box-image" action="select-image" data-counter="250">
                                                <input
                                                    class="image-data"
                                                    name="image"
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
                                                            data-result="image"
                                                            data-action="select-image"
                                                            data-allow-thumb="1"
                                                            href="#">
                                                            <img
                                                                class="preview-image default-image" data-default="{{ asset('storage/' . ($page->image ?? 'placeholder.png')) }}"
                                                                src="{{ asset('storage/' . ($page->image ?? 'placeholder.png')) }}"
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
                                                    data-target="popup" data-result="image"
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
                                                        data-bb-target=".image-box-image">
                                                        Add from URL
                                                    </a>
                                                </div>
                                            </div>






                                        </div>
                                    </div>
                                    <div class="card meta-boxes">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <label class="form-label" for="breadcrumb_style">
                                                    Breadcrumb style


                                                </label>
                                            </h4>
                                        </div>


                                        <div class=" card-body">
                                            <select class="form-select" id="breadcrumb_style-select-40918" name="breadcrumb_style">
                                                <option value="align-start">Align start</option>
                                                <option value="align-center">Align center</option>
                                                <option value="without-title">Without title</option>
                                                <option value="none">None</option>
                                            </select>






                                        </div>
                                    </div>
                                    <div class="card meta-boxes">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <label class="form-label" for="breadcrumb_background">
                                                    Breadcrumb background


                                                </label>
                                            </h4>
                                        </div>


                                        <div class=" card-body">
                                            <div class="image-box image-box-breadcrumb_background" action="select-image" data-counter="250">
                                                <input
                                                    class="image-data"
                                                    name="breadcrumb_background"
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
                                                            data-result="breadcrumb_background"
                                                            data-action="select-image"
                                                            data-allow-thumb="1"
                                                            href="#">
                                                            <img
                                                                class="preview-image default-image" data-default="{{ asset('storage/placeholder.png') }}"
                                                                src="{{ asset('storage/placeholder.png') }}"
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
                                                    data-target="popup" data-result="breadcrumb_background"
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
                                                        data-bb-target=".image-box-breadcrumb_background">
                                                        Add from URL
                                                    </a>
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
    $(document).ready(function() {
        $('#botble-page-forms-page-form').on('submit', function(e) {
            e.preventDefault();
            
            // Sync CKEditor content before serialize
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            let form = $(this);
            let formData = new FormData(this);
            let submitBtn = form.find('button[type="submit"]:focus');
            
            // If no button is focused (e.g. enter key), default to 'save'
            let submitValue = submitBtn.length ? submitBtn.val() : 'save';
            formData.append('submitter', submitValue);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (response.redirect) {
                                window.location.href = response.redirect;
                            }
                        });
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorHtml = '<ul>';
                    $.each(errors, function(key, value) {
                        errorHtml += '<li>' + value + '</li>';
                    });
                    errorHtml += '</ul>';

                    Swal.fire({
                        title: 'Error!',
                        html: errorHtml,
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            });
        });
    });
</script>
@endpush
