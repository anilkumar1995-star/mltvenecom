@extends('admin-layouts.app')
@section('title', 'Product Create')
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
                                            href="https://shofy-grocery.botble.com/admin">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="mb-0 d-inline-block fs-6 lh-1"
                                            href="https://shofy-grocery.botble.com/admin/ecommerce/products">Products</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">New product</h1>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">New physical product</h1>
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
                <form method="POST" action="https://shofy-grocery.botble.com/admin/ecommerce/products/create"
                    accept-charset="UTF-8" id="botble-ecommerce-forms-product-form" class="js-base-form dirty-check"
                    enctype="multipart/form-data"><input name="_token" type="hidden"
                        value="fNigUrJw2l108BNrnfXqXdWkKdqM3poqOSHOCKfe">

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
                            <div class="w-100">
                                You are editing "<strong class="current_language_text">English</strong>"
                                version
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
                                            <input class="form-control" data-counter="250" placeholder="Name"
                                                required="required" name="name" type="text" id="name">
                                        </div>
                                        <input type="hidden" name="model" value="Botble\Ecommerce\Models\Product">
                                        <div class="mb-3 ">
                                            <div class="slug-field-wrapper" data-field-name="name">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label required" for="slug">
                                                        Permalink
                                                    </label>
                                                    <div class="input-group input-group-flat">
                                                        <span class="input-group-text">
                                                            https://shofy-grocery.botble.com/products/
                                                        </span>
                                                        <input class="form-control ps-0" type="text" name="slug"
                                                            id="slug" required="required" />
                                                        <span class="input-group-text slug-actions">
                                                            <a href="#" class="link-secondary d-none"
                                                                data-bs-toggle="tooltip" aria-label="Generate URL"
                                                                data-bs-original-title="Generate URL"
                                                                data-bb-toggle="generate-slug">
                                                                <svg class="icon svg-icon-ti-ti-wand"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M6 21l15 -15l-3 -3l-15 15l3 3" />
                                                                    <path d="M15 6l3 3" />
                                                                    <path
                                                                        d="M9 3a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2" />
                                                                    <path
                                                                        d="M19 13a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2" />
                                                                </svg> </a>
                                                        </span>
                                                    </div>
                                                </div>
                                                <small class="form-hint mt-n2 text-truncate">Preview: <a
                                                        href="https://shofy-grocery.botble.com/products/"
                                                        target="_blank">https://shofy-grocery.botble.com/products/</a></small>
                                                <input class="slug-current" name="slug" type="hidden"
                                                    value="">
                                                <div class="slug-data"
                                                    data-url="https://shofy-grocery.botble.com/ajax/slug/create"
                                                    data-view="https://shofy-grocery.botble.com/products/" data-id="0">
                                                </div>
                                                <input name="slug_id" type="hidden" value="0">
                                                <input name="is_slug_editable" type="hidden" value="1">
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="description">
                                                Description
                                            </label>
                                            <div class="mb-2 btn-list">
                                                <button class="btn   show-hide-editor-btn" type="button"
                                                    data-result="description">
                                                    Show/Hide Editor
                                                </button>
                                                <button class="btn   btn_gallery" type="button"
                                                    data-result="description" data-multiple="true"
                                                    data-action="media-insert-ckeditor">
                                                    <svg class="icon icon-left svg-icon-ti-ti-photo"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M15 8h.01" />
                                                        <path
                                                            d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12" />
                                                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                                                        <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />
                                                    </svg>
                                                    Add media
                                                </button>
                                            </div>
                                            <textarea class="form-control form-control editor-ckeditor ays-ignore" data-counter="100000" rows="4"
                                                placeholder="Short description" id="description" name="description" cols="50"></textarea>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="content">
                                                Content
                                            </label>
                                            <div class="mb-2 btn-list">
                                                <button class="btn   show-hide-editor-btn" type="button"
                                                    data-result="content">
                                                    Show/Hide Editor
                                                </button>
                                                <button class="btn   btn_gallery" type="button" data-result="content"
                                                    data-multiple="true" data-action="media-insert-ckeditor">
                                                    <svg class="icon icon-left svg-icon-ti-ti-photo"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M15 8h.01" />
                                                        <path
                                                            d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12" />
                                                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                                                        <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />
                                                    </svg>
                                                    Add media
                                                </button>

                                                <button class="btn   add_shortcode_btn_trigger" type="button"
                                                    data-bb-toggle="shortcode-list-modal" data-result="content">
                                                    <svg class="icon svg-icon-ti-ti-box"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                                        <path d="M12 12l8 -4.5" />
                                                        <path d="M12 12l0 9" />
                                                        <path d="M12 12l-8 -4.5" />
                                                    </svg>
                                                    UI Blocks
                                                </button>
                                            </div>
                                            <textarea class="form-control form-control editor-ckeditor ays-ignore" data-counter="100000" rows="4"
                                                placeholder="Write your content" with-short-code id="content" name="content" cols="50"></textarea>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="images[]">
                                                Images
                                            </label>
                                            <div class="gallery-images-wrapper list-images form-fieldset">
                                                <div class="images-wrapper mb-2">
                                                    <div data-bb-toggle="gallery-add"
                                                        class="text-center cursor-pointer default-placeholder-gallery-image"
                                                        data-name="images[]">
                                                        <div class="mb-3">
                                                            <svg class="icon icon-md  text-secondary svg-icon-ti-ti-photo-plus"
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M15 8h.01" />
                                                                <path
                                                                    d="M12.5 21h-6.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v6.5" />
                                                                <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l4 4" />
                                                                <path d="M14 14l1 -1c.67 -.644 1.45 -.824 2.182 -.54" />
                                                                <path d="M16 19h6" />
                                                                <path d="M19 16v6" />
                                                            </svg>
                                                        </div>
                                                        <p class="mb-0 text-body">
                                                            Click here
                                                            to add more images.
                                                        </p>
                                                    </div>
                                                    <input name="images[]" type="hidden">
                                                    <div class="row w-100 list-gallery-media-images  hidden "
                                                        data-name="images[]" data-allow-thumb="1">
                                                    </div>
                                                </div>
                                                <div style="display: none;" class="footer-action">
                                                    <a data-bb-toggle="gallery-add" href="#"
                                                        class="me-2 cursor-pointer">Add Images</a>
                                                    <a href="#" class="text-danger" data-bb-toggle="gallery-reset">
                                                        Reset
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="video_media">
                                                Video
                                            </label>
                                            <input name="video_media" type="hidden" value="[]">
                                            <div class="repeater-group"
                                                id="repeater_field_59b934d124126a66405adaa4ffa5f7d1_69788ba64c755_group"
                                                data-next-index="0">
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn" type="button" data-target="repeater-add"
                                                    data-id="repeater_field_59b934d124126a66405adaa4ffa5f7d1_69788ba64c755">
                                                    Add new
                                                </button>
                                            </div>
                                        </div>
                                        <input class="form-control" name="product_type" type="hidden" value="physical">
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3 product-specification-table">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        Specification Tables
                                    </h4>
                                    <div class="card-actions"><select class="form-select" name="specification_table_id"
                                            id="specification_table_id">
                                            <option value="">None</option>
                                            <option value="1">General Specification</option>
                                            <option value="2">Technical Specification</option>
                                        </select></div>
                                </div>

                                <p class="text-secondary mb-0 p-3">
                                    Select the specification table to display in this product
                                </p>

                                <div class="specification-table"></div>

                                <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                                <script>
                                    $(() => {
                                        $(document)
                                            .on('change', '#specification_table_id', function() {
                                                const $this = $(this);
                                                const $form = $this.closest('form');
                                                const $table = $this.val();

                                                if ($table) {
                                                    $.ajax({
                                                        url: 'https://shofy-grocery.botble.com/admin/ecommerce/specification-tables',
                                                        data: {
                                                            table: $table,
                                                            product: '',
                                                            ref_lang: '',
                                                        },
                                                        success: function(response) {
                                                            if (response.data) {
                                                                $form.find('.specification-table').html(response.data);
                                                                $('.product-specification-table p').hide();

                                                                $form.find('.specification-table table tbody').sortable({
                                                                    update: function() {
                                                                        $(this).find('tr').each(function(index) {
                                                                            $(this).find(
                                                                                'input[name$="[order]"]'
                                                                            ).val(index);
                                                                        });
                                                                    },
                                                                });
                                                            }
                                                        },
                                                    });
                                                } else {
                                                    $form.find('.specification-table').html('');
                                                    $('.product-specification-table p').show();
                                                }
                                            });

                                        $('#specification_table_id').trigger('change');
                                    });
                                </script>
                            </div>

                            <div id="main-manage-product-type">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Overview
                                        </h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="row price-group">
                                            <input class="detect-schedule d-none" name="sale_type" type="hidden"
                                                value="0">
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="sku">
                                                        SKU
                                                    </label>
                                                    <input class="form-control" type="text" name="sku"
                                                        id="sku" value="SF-2443-IJSR" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="price">
                                                        Price
                                                    </label>
                                                    <div class="input-group input-group-flat">
                                                        <span class="input-group-text currency-symbol">$</span>
                                                        <input class="form-control input-mask-number" type="text"
                                                            name="price" id="price" value="0"
                                                            data-thousands-separator="," data-decimal-separator="."
                                                            step="any" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="sale_price">
                                                        Price sale
                                                        <span class="form-label-description">
                                                            <a class="turn-on-schedule" style=""
                                                                href="javascript:void(0)">
                                                                Choose Discount Period
                                                            </a>
                                                            <a class="turn-off-schedule" style="display: none;"
                                                                href="javascript:void(0)">
                                                                Cancel
                                                            </a>
                                                        </span>
                                                    </label>
                                                    <div class="input-group input-group-flat">
                                                        <span class="input-group-text currency-symbol">$</span>
                                                        <input class="form-control input-mask-number" type="text"
                                                            name="sale_price" id="sale_price"
                                                            data-thousands-separator="," data-decimal-separator="."
                                                            data-sale-percent-text="Discount :percent from original price." />
                                                    </div>
                                                    <small class="form-hint">Discount <strong>0%</strong> from
                                                        original price.</small>
                                                </div>
                                            </div>

                                            <div class="col-md-6 scheduled-time" style="display: none;">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="start_date">
                                                        From date
                                                    </label>
                                                    <input class="form-control form-date-time" type="text"
                                                        name="start_date" id="start_date" placeholder="Y-m-d H:i:s" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 scheduled-time" style="display: none;">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="end_date">
                                                        To date
                                                    </label>
                                                    <input class="form-control form-date-time" type="text"
                                                        name="end_date" id="end_date" placeholder="Y-m-d H:i:s" />
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3 position-relative">
                                                    <input type="hidden" name="price_includes_tax" value="0">
                                                    <label class="form-check">
                                                        <input type="checkbox" name="price_includes_tax"
                                                            class="form-check-input" value="1">
                                                        <span class="form-check-label">
                                                            Price includes tax
                                                        </span>
                                                        <span class="form-check-description">Check this if the
                                                            entered price already includes taxes. The system
                                                            will calculate the base price by removing the tax
                                                            amount.</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="cost_per_item">
                                                        Cost per item
                                                    </label>
                                                    <div class="input-group input-group-flat">
                                                        <span class="input-group-text currency-symbol">$</span>
                                                        <input class="form-control input-mask-number" type="text"
                                                            name="cost_per_item" id="cost_per_item" value="0"
                                                            placeholder="Enter cost per item" step="any" />
                                                    </div>
                                                    <small class="form-hint">Customers won't see this
                                                        price.</small>
                                                </div>
                                            </div>
                                            <input name="product_id" type="hidden" value="">
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="barcode">
                                                        Barcode (ISBN, UPC, GTIN, etc.)
                                                    </label>
                                                    <input class="form-control" type="text" name="barcode"
                                                        id="barcode" step="any" placeholder="Enter barcode" />

                                                    <small class="form-hint">Must be unique for each
                                                        product.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <input type="hidden" name="with_storehouse_management" value="0">
                                            <label class="form-check">
                                                <input type="checkbox" name="with_storehouse_management"
                                                    class="form-check-input storehouse-management-status" value="1">
                                                <span class="form-check-label">
                                                    With storehouse management
                                                </span>
                                            </label>
                                        </div>

                                        <fieldset class="form-fieldset storehouse-info" style="display: none;">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="quantity">
                                                    Quantity
                                                </label>
                                                <input class="form-control input-mask-number" type="text"
                                                    name="quantity" id="quantity" value="0" />
                                            </div>

                                            <div class="mb-3 position-relative">
                                                <input type="hidden" name="allow_checkout_when_out_of_stock"
                                                    value="0">
                                                <label class="form-check">
                                                    <input type="checkbox" name="allow_checkout_when_out_of_stock"
                                                        class="form-check-input" value="1">
                                                    <span class="form-check-label">
                                                        Allow customer checkout when this product out of stock
                                                    </span>
                                                </label>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-fieldset stock-status-wrapper" style=";">
                                            <label class="form-label" for="stock_status">
                                                Stock status
                                            </label>
                                            <label class="form-check form-check-inline mb-3">
                                                <input type="radio" name="stock_status" class="form-check-input"
                                                    value="in_stock" checked>
                                                <span class="form-check-label">
                                                    In stock
                                                </span>
                                            </label>
                                            <label class="form-check form-check-inline mb-3">
                                                <input type="radio" name="stock_status" class="form-check-input"
                                                    value="out_of_stock">
                                                <span class="form-check-label">
                                                    Out of stock
                                                </span>
                                            </label>
                                            <label class="form-check form-check-inline mb-3">
                                                <input type="radio" name="stock_status" class="form-check-input"
                                                    value="on_backorder">
                                                <span class="form-check-label">
                                                    On backorder
                                                </span>
                                            </label>
                                        </fieldset>

                                        <fieldset class="form-fieldset">
                                            <legend>
                                                <h3>Shipping</h3>
                                            </legend>
                                            <div class="row">
                                                <div class="col-md-3 col-md-6">
                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label" for="weight">
                                                            Weight (g)
                                                        </label>
                                                        <div class="input-group input-group-flat">
                                                            <span class="input-group-text">g</span>
                                                            <input class="form-control input-mask-number" type="text"
                                                                name="weight" id="weight" value="0" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-md-6">
                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label" for="length">
                                                            Length (cm)
                                                        </label>
                                                        <div class="input-group input-group-flat">
                                                            <span class="input-group-text">cm</span>
                                                            <input class="form-control input-mask-number" type="text"
                                                                name="length" id="length" value="0" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-md-6">
                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label" for="wide">
                                                            Wide (cm)
                                                        </label>
                                                        <div class="input-group input-group-flat">
                                                            <span class="input-group-text">cm</span>
                                                            <input class="form-control input-mask-number" type="text"
                                                                name="wide" id="wide" value="0" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-md-6">
                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label" for="height">
                                                            Height (cm)
                                                        </label>
                                                        <div class="input-group input-group-flat">
                                                            <span class="input-group-text">cm</span>
                                                            <input class="form-control input-mask-number" type="text"
                                                                name="height" id="height" value="0" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="d-none product-attribute-sets-url"
                                    data-url="https://shofy-grocery.botble.com/admin/ecommerce/products/product-attribute-sets">

                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Attributes
                                        </h4>
                                        <div class="card-actions"><button class="btn   btn-trigger-add-attribute"
                                                type="button" data-toggle-text="Cancel">
                                                Add new attributes
                                            </button></div>
                                    </div>

                                    <div class="card-body">
                                        <div class="add-new-product-attribute-wrap">
                                            <input id="is_added_attributes" name="is_added_attributes" type="hidden"
                                                value="0">
                                            <p class="text-muted">Adding new attributes helps the product to
                                                have many options, such as size or color.</p>
                                            <div class="list-product-attribute-values-wrap" style="display: none">
                                                <div class="product-select-attribute-item-template"></div>
                                            </div>

                                            <fieldset class="form-fieldset list-product-attribute-wrap"
                                                style="display: none;">
                                                <div class="list-product-attribute-items-wrap"></div>

                                                <div class="btn-list">
                                                    <button class="btn   btn-trigger-add-attribute-item" style=";"
                                                        type="button">
                                                        Add more attribute
                                                    </button>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        Product options
                                    </h4>
                                </div>

                                <div class="card-body">
                                    <div class="product-option-form-wrap">
                                        <div class="product-option-form-group">
                                            <div class="product-option-form-body">
                                                <input name="has_product_options" type="hidden" value="1">
                                                <div class="accordion" id="accordion-product-option"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col col-12 col-md-4 mb-3 mb-md-0">
                                                    <button class="btn   add-new-option" type="button"
                                                        id="add-new-option">
                                                        Add new option
                                                    </button>
                                                </div>
                                                <div class="col ms-auto ms-md-0 col-12 col-md-8">
                                                    <div
                                                        class="d-flex gap-2 align-items-start justify-content-start justify-content-md-end">
                                                        <div class="mb-3 position-relative">
                                                            <select class="form-select" id="global-option">
                                                                <option value="0">Select Global Option
                                                                </option>
                                                                <option value="1">Warranty</option>
                                                                <option value="2">RAM</option>
                                                                <option value="3">CPU</option>
                                                                <option value="4">HDD</option>
                                                            </select>
                                                        </div>
                                                        <button class="btn   add-from-global-option" type="button">
                                                            Add Global Option
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wrap-relation-product"
                                data-target="https://shofy-grocery.botble.com/admin/ecommerce/products/get-relations-box/0">
                            </div>
                            <div id="advanced-sortables" class="meta-box-sortables">
                                <div class="card meta-boxes mb-3" id="faq_schema_config_wrapper">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Product FAQs
                                        </h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="alert alert-info mb-3">
                                            <svg class="icon svg-icon-ti-ti-info-circle"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                                <path d="M12 9h.01" />
                                                <path d="M11 12h1v4h1" />
                                            </svg>
                                            <div>
                                                This configuration registers FAQ structured data for SEO
                                                purposes only. It will not be displayed in your front-end theme
                                                content. The schema is embedded in the page source and can be
                                                viewed using &quot;View Source&quot; or tested with
                                                Google&#039;s Rich Results Test tool.
                                                <div class="mt-2">
                                                    <a href="https://search.google.com/test/rich-results" target="_blank"
                                                        rel="noopener noreferrer">Test with
                                                        Google Rich Results Test</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="faq-schema-items">
                                            <input name="faq_schema_config" type="hidden" value="[]">
                                            <div class="repeater-group"
                                                id="repeater_field_87fbb392676c2e40c750bdd1139f90ef_69788ba65966c_group"
                                                data-next-index="0">
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn" type="button" data-target="repeater-add"
                                                    data-id="repeater_field_87fbb392676c2e40c750bdd1139f90ef_69788ba65966c">
                                                    Add new
                                                </button>
                                            </div>
                                        </div>

                                        <div class="d-inline">
                                            <span>or</span>
                                            <a href="javascript:void(0)" data-bb-toggle="select-from-existing">
                                                Select from existing FAQs
                                            </a>
                                        </div>

                                        <div class="existing-faq-schema-items mt-2" style="display: none;">
                                            <div class="position-relative" data-bb-toggle="dropdown-checkboxes"
                                                data-name="selected_existing_faqs[]" data-selected-text="selected"
                                                data-placeholder="Select an option">
                                                <span class="form-select text-truncate">Select an
                                                    option</span>
                                                <input type="text" class="form-select" placeholder="Search..."
                                                    style="display: none">

                                                <div class="dropdown-menu dropdown-menu-end w-100">
                                                    <div data-bb-toggle="tree-checkboxes">
                                                        <ul class="list-unstyled p-3 pb-0">
                                                            <li>
                                                                <label class="form-check">
                                                                    <input type="checkbox"
                                                                        id="selected-existing-faqs-item-1"
                                                                        name="selected_existing_faqs[]"
                                                                        class="form-check-input" value="1">

                                                                    <span class="form-check-label">
                                                                        What Shipping Methods Are Available?
                                                                    </span>

                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label class="form-check">
                                                                    <input type="checkbox"
                                                                        id="selected-existing-faqs-item-2"
                                                                        name="selected_existing_faqs[]"
                                                                        class="form-check-input" value="2">

                                                                    <span class="form-check-label">
                                                                        Do You Ship Internationally?
                                                                    </span>

                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label class="form-check">
                                                                    <input type="checkbox"
                                                                        id="selected-existing-faqs-item-3"
                                                                        name="selected_existing_faqs[]"
                                                                        class="form-check-input" value="3">

                                                                    <span class="form-check-label">
                                                                        How Long Will It Take To Get My Package?
                                                                    </span>

                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label class="form-check">
                                                                    <input type="checkbox"
                                                                        id="selected-existing-faqs-item-4"
                                                                        name="selected_existing_faqs[]"
                                                                        class="form-check-input" value="4">

                                                                    <span class="form-check-label">
                                                                        What Payment Methods Are Accepted?
                                                                    </span>

                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label class="form-check">
                                                                    <input type="checkbox"
                                                                        id="selected-existing-faqs-item-5"
                                                                        name="selected_existing_faqs[]"
                                                                        class="form-check-input" value="5">

                                                                    <span class="form-check-label">
                                                                        Is Buying On-Line Safe?
                                                                    </span>

                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label class="form-check">
                                                                    <input type="checkbox"
                                                                        id="selected-existing-faqs-item-6"
                                                                        name="selected_existing_faqs[]"
                                                                        class="form-check-input" value="6">

                                                                    <span class="form-check-label">
                                                                        How do I place an Order?
                                                                    </span>

                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label class="form-check">
                                                                    <input type="checkbox"
                                                                        id="selected-existing-faqs-item-7"
                                                                        name="selected_existing_faqs[]"
                                                                        class="form-check-input" value="7">

                                                                    <span class="form-check-label">
                                                                        How Can I Cancel Or Change My Order?
                                                                    </span>

                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label class="form-check">
                                                                    <input type="checkbox"
                                                                        id="selected-existing-faqs-item-8"
                                                                        name="selected_existing_faqs[]"
                                                                        class="form-check-input" value="8">

                                                                    <span class="form-check-label">
                                                                        Do I need an account to place an order?
                                                                    </span>

                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label class="form-check">
                                                                    <input type="checkbox"
                                                                        id="selected-existing-faqs-item-9"
                                                                        name="selected_existing_faqs[]"
                                                                        class="form-check-input" value="9">

                                                                    <span class="form-check-label">
                                                                        How Do I Track My Order?
                                                                    </span>

                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label class="form-check">
                                                                    <input type="checkbox"
                                                                        id="selected-existing-faqs-item-10"
                                                                        name="selected_existing_faqs[]"
                                                                        class="form-check-input" value="10">

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
                                        <div class="card-actions"><a href="#" class="btn-trigger-show-seo-detail">
                                                Edit SEO meta
                                            </a></div>
                                    </div>

                                    <div class="card-body">
                                        <div class="seo-preview" v-pre>
                                            <p class="default-seo-description">
                                                Setup meta title &amp; description to make your site easy to
                                                discovered on search engines such as Google
                                            </p>
                                            <div class="existed-seo-meta hidden">
                                                <h4 class="page-title-seo text-truncate">
                                                </h4>
                                                <div class="page-url-seo">
                                                    <p>-
                                                    </p>
                                                </div>
                                                <div>
                                                    <span style="color: #70757a;">Jan 27, 2026
                                                        - </span>
                                                    <span class="page-description-seo">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden seo-edit-section" v-pre>
                                            <hr class="my-4">
                                            </hr>
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="seo_meta[seo_title]">
                                                    SEO Title
                                                </label>
                                                <input class="form-control" data-counter="70" placeholder="SEO Title"
                                                    data-allow-over-limit name="seo_meta[seo_title]" type="text"
                                                    id="seo_meta[seo_title]">
                                                <small class="form-hint">
                                                    Optimal length: 50-60 characters. This appears as the
                                                    clickable headline in search results.
                                                </small>
                                            </div>

                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="seo_meta[seo_description]">
                                                    SEO description
                                                </label>
                                                <textarea class="form-control" data-counter="160" rows="3" placeholder="SEO description" data-allow-over-limit
                                                    id="seo_meta[seo_description]" name="seo_meta[seo_description]" cols="50"></textarea>
                                                <small class="form-hint">
                                                    Optimal length: 120-160 characters. This appears below the
                                                    title in search results and should entice users to click.
                                                </small>
                                            </div>



                                            <div role="alert" class="alert alert-info">
                                                <div class="d-flex gap-1">
                                                    <div>
                                                        <svg class="icon alert-icon svg-icon-ti-ti-info-circle"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                                            <path d="M12 9h.01" />
                                                            <path d="M11 12h1v4h1" />
                                                        </svg>
                                                    </div>
                                                    <div class="w-100">


                                                        Meta keywords was removed by Google, you don't need to
                                                        add meta keywords to your website. Learn more: <a
                                                            href="https://yoast.com/meta-keywords">https://yoast.com/meta-keywords</a>

                                                    </div>
                                                </div>



                                            </div>







                                            <div class="mb-3 position-relative">

                                                <label class="form-label" for="seo_meta_image">
                                                    SEO image


                                                </label>


                                                <div class="image-box image-box-seo_meta_image" action="select-image"
                                                    data-counter="250">
                                                    <input class="image-data" name="seo_meta_image" type="hidden"
                                                        value="" class="" data-counter="250" />


                                                    <div style="width: 8rem" class="preview-image-wrapper mb-1">
                                                        <div class="preview-image-inner">
                                                            <a data-bb-toggle="image-picker-choose" data-target="popup"
                                                                class="image-box-actions" data-result="seo_meta_image"
                                                                data-action="select-image" data-allow-thumb="1"
                                                                href="#">
                                                                <img class="preview-image default-image"
                                                                    data-default="https://shofy-grocery.botble.com/vendor/core/core/base/images/placeholder.png"
                                                                    src="https://shofy-grocery.botble.com/vendor/core/core/base/images/placeholder.png"
                                                                    alt="Preview image" />
                                                                <span class="image-picker-backdrop"></span>
                                                            </a>
                                                            <button
                                                                class="btn btn-pill btn-icon  btn-sm image-picker-remove-button p-0"
                                                                style="display: none; --bb-btn-font-size: 0.5rem;"
                                                                type="button" data-bb-toggle="image-picker-remove"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Remove image">
                                                                <svg class="icon icon-sm  icon-left svg-icon-ti-ti-x"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M18 6l-12 12" />
                                                                    <path d="M6 6l12 12" />
                                                                </svg>

                                                            </button>
                                                        </div>
                                                    </div>

                                                    <a data-bb-toggle="image-picker-choose" data-target="popup"
                                                        data-result="seo_meta_image" data-action="select-image"
                                                        data-allow-thumb="1" href="#">
                                                        Choose image
                                                    </a>

                                                    <div data-bb-toggle="upload-from-url">
                                                        <span class="text-muted">or</span>
                                                        <a href="javascript:void(0)" class="mt-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#image-picker-add-from-url"
                                                            data-bb-target=".image-box-seo_meta_image">
                                                            Add from URL
                                                        </a>
                                                    </div>
                                                </div>


                                                <small class="form-hint">
                                                    Recommended size: 1200x630px. This image appears when your
                                                    page is shared on social media platforms.
                                                </small>


                                            </div>



                                            <div class="mb-3 position-relative">

                                                <label class="form-label" for="seo_meta[index]">
                                                    Index


                                                </label>


                                                <div class="position-relative form-check-group">

                                                    <label class="form-check form-check-inline">
                                                        <input class="form-check-input" id="seo_meta[index]_index"
                                                            type="radio" name="seo_meta[index]" value="index" checked>

                                                        <span class="form-check-label">Index</span>
                                                    </label>

                                                    <label class="form-check form-check-inline">
                                                        <input class="form-check-input" id="seo_meta[index]_index_noindex"
                                                            type="radio" name="seo_meta[index]" value="noindex">

                                                        <span class="form-check-label">No index</span>
                                                    </label>
                                                </div>


                                                <small class="form-hint">
                                                    Choose "Index" to allow search engines to show this page in
                                                    search results, or "No index" to prevent it from appearing
                                                    in search results.
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
                                        <button class="btn btn-primary" type="submit" value="apply" name="submitter">
                                            <svg class="icon icon-left svg-icon-ti-ti-device-floppy"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                <path d="M10 14a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M14 4l0 4l-6 0l0 -4" />
                                            </svg>
                                            Save

                                        </button>

                                        <button class="btn" type="submit" name="submitter" value="save">
                                            <svg class="icon icon-left svg-icon-ti-ti-transfer-in"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 18v3h16v-14l-8 -4l-8 4v3" />
                                                <path d="M4 14h9" />
                                                <path d="M10 11l3 3l-3 3" />
                                            </svg>
                                            Save &amp; Exit

                                        </button>


                                    </div>
                                </div>
                            </div>

                            <div data-bb-waypoint data-bb-target="#form-actions"></div>

                            <header class="top-0 w-100 position-fixed end-0 z-1000" id="form-actions"
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
                                                    <button class="btn btn-primary" type="submit" value="apply"
                                                        name="submitter">
                                                        <svg class="icon icon-left svg-icon-ti-ti-device-floppy"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path
                                                                d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                            <path d="M10 14a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                            <path d="M14 4l0 4l-6 0l0 -4" />
                                                        </svg>
                                                        Save

                                                    </button>

                                                    <button class="btn" type="submit" name="submitter"
                                                        value="save">
                                                        <svg class="icon icon-left svg-icon-ti-ti-transfer-in"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
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
                                    <select class="form-select" required="required" id="status-select-10704"
                                        name="status">
                                        <option value="published">Published</option>
                                        <option value="draft">Draft</option>
                                        <option value="pending">Pending</option>
                                    </select>






                                </div>
                            </div>
                            <div class="card meta-boxes">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <label class="form-label" for="store_id">
                                            Store


                                        </label>
                                    </h4>
                                </div>


                                <div class=" card-body">
                                    <select class="select-search-full form-select" data-placeholder="Select a store..."
                                        data-allow-clear="true" id="store_id-select-87151" name="store_id">
                                        <option selected="selected" value="">Select a store...
                                        </option>
                                        <option value="1">GoPro</option>
                                        <option value="2">Global Office</option>
                                        <option value="3">Young Shop</option>
                                        <option value="4">Global Store</option>
                                        <option value="5">Robert’s Store</option>
                                        <option value="6">Stouffer</option>
                                        <option value="7">StarKist</option>
                                        <option value="8">Old El Paso</option>
                                    </select>






                                </div>
                            </div>
                            <div class="card meta-boxes">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <label class="form-label" for="is_featured">
                                            Is featured?


                                        </label>
                                    </h4>
                                </div>


                                <div class=" card-body">
                                    <label class="form-check form-switch d-inline-block ">
                                        <input name="is_featured" type="hidden" value="0" />
                                        <input class="form-check-input" name="is_featured" type="checkbox"
                                            value="1" id="is_featured" />

                                    </label>






                                </div>
                            </div>
                            <div class="card meta-boxes">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <label class="form-label" for="is_new_until">
                                            New until


                                        </label>
                                    </h4>
                                </div>


                                <div class=" card-body">
                                    <div class="input-group datepicker">
                                        <input class="form-control " placeholder="Y-m-d" data-input=""
                                            readonly="readonly" name="is_new_until" type="text" id="is_new_until">
                                        <button class="btn btn-icon" type="button" data-toggle="data-toggle">
                                            <svg class="icon icon-left svg-icon-ti-ti-calendar"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12" />
                                                <path d="M16 3v4" />
                                                <path d="M8 3v4" />
                                                <path d="M4 11h16" />
                                                <path d="M11 15h1" />
                                                <path d="M12 15v3" />
                                            </svg>

                                        </button>
                                        <button class="btn btn-icon   text-danger" type="button"
                                            data-clear="data-clear">
                                            <svg class="icon icon-left svg-icon-ti-ti-x"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M18 6l-12 12" />
                                                <path d="M6 6l12 12" />
                                            </svg>

                                        </button>
                                    </div>


                                    <small class="form-hint">
                                        Set a date until which this product will be marked as "New". Leave empty
                                        to not mark as new based on date.
                                    </small>




                                </div>
                            </div>
                            <div class="card meta-boxes">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <label class="form-label" for="categories[]">
                                            Categories


                                        </label>
                                    </h4>
                                </div>


                                <div class=" card-body">
                                    <div class="mb-3">
                                        <div class="input-icon">
                                            <input type="text" id="search-category-input-60252237"
                                                class="form-control" placeholder="Search..."
                                                onkeyup="filter_categories_60252237(60252237)" formnovalidate />
                                            <span class="input-icon-addon">
                                                <svg class="icon svg-icon-ti-ti-search" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                    <path d="M21 21l-6 -6" />
                                                </svg> </span>
                                        </div>
                                    </div>

                                    <div data-bb-toggle="tree-checkboxes" class="tree-categories-list-60252237">
                                        <ul class="list-unstyled ">

                                            <li>
                                                <label class="form-check">
                                                    <input type="checkbox" name="categories[]" class="form-check-input"
                                                        value="1">

                                                    <span class="form-check-label">
                                                        Frozen Food
                                                    </span>

                                                </label>

                                                <ul class="list-unstyled ms-3 me-0 mt-2">

                                                    <li>
                                                        <label class="form-check">
                                                            <input type="checkbox" name="categories[]"
                                                                class="form-check-input" value="2">

                                                            <span class="form-check-label">
                                                                Baby Food
                                                            </span>

                                                        </label>

                                                    </li>

                                                    <li>
                                                        <label class="form-check">
                                                            <input type="checkbox" name="categories[]"
                                                                class="form-check-input" value="3">

                                                            <span class="form-check-label">
                                                                Strawberry
                                                            </span>

                                                        </label>

                                                    </li>

                                                    <li>
                                                        <label class="form-check">
                                                            <input type="checkbox" name="categories[]"
                                                                class="form-check-input" value="4">

                                                            <span class="form-check-label">
                                                                Ice Cream
                                                            </span>

                                                        </label>

                                                    </li>
                                                </ul>
                                            </li>

                                            <li>
                                                <label class="form-check">
                                                    <input type="checkbox" name="categories[]" class="form-check-input"
                                                        value="5">

                                                    <span class="form-check-label">
                                                        Meat &amp; Seafood
                                                    </span>

                                                </label>

                                                <ul class="list-unstyled ms-3 me-0 mt-2">

                                                    <li>
                                                        <label class="form-check">
                                                            <input type="checkbox" name="categories[]"
                                                                class="form-check-input" value="6">

                                                            <span class="form-check-label">
                                                                Chicken
                                                            </span>

                                                        </label>

                                                    </li>

                                                    <li>
                                                        <label class="form-check">
                                                            <input type="checkbox" name="categories[]"
                                                                class="form-check-input" value="7">

                                                            <span class="form-check-label">
                                                                Fish
                                                            </span>

                                                        </label>

                                                    </li>

                                                    <li>
                                                        <label class="form-check">
                                                            <input type="checkbox" name="categories[]"
                                                                class="form-check-input" value="8">

                                                            <span class="form-check-label">
                                                                Beef
                                                            </span>

                                                        </label>

                                                    </li>
                                                </ul>
                                            </li>

                                            <li>
                                                <label class="form-check">
                                                    <input type="checkbox" name="categories[]"
                                                        class="form-check-input" value="9">

                                                    <span class="form-check-label">
                                                        Milk &amp; Dairy
                                                    </span>

                                                </label>

                                                <ul class="list-unstyled ms-3 me-0 mt-2">

                                                    <li>
                                                        <label class="form-check">
                                                            <input type="checkbox" name="categories[]"
                                                                class="form-check-input" value="10">

                                                            <span class="form-check-label">
                                                                Milk
                                                            </span>

                                                        </label>

                                                    </li>

                                                    <li>
                                                        <label class="form-check">
                                                            <input type="checkbox" name="categories[]"
                                                                class="form-check-input" value="11">

                                                            <span class="form-check-label">
                                                                Cheese
                                                            </span>

                                                        </label>

                                                    </li>

                                                    <li>
                                                        <label class="form-check">
                                                            <input type="checkbox" name="categories[]"
                                                                class="form-check-input" value="12">

                                                            <span class="form-check-label">
                                                                Yogurt
                                                            </span>

                                                        </label>

                                                    </li>
                                                </ul>
                                            </li>

                                            <li>
                                                <label class="form-check">
                                                    <input type="checkbox" name="categories[]"
                                                        class="form-check-input" value="13">

                                                    <span class="form-check-label">
                                                        Beverages
                                                    </span>

                                                </label>

                                            </li>

                                            <li>
                                                <label class="form-check">
                                                    <input type="checkbox" name="categories[]"
                                                        class="form-check-input" value="14">

                                                    <span class="form-check-label">
                                                        Vegetables
                                                    </span>

                                                </label>

                                                <ul class="list-unstyled ms-3 me-0 mt-2">

                                                    <li>
                                                        <label class="form-check">
                                                            <input type="checkbox" name="categories[]"
                                                                class="form-check-input" value="15">

                                                            <span class="form-check-label">
                                                                Carrot
                                                            </span>

                                                        </label>

                                                    </li>

                                                    <li>
                                                        <label class="form-check">
                                                            <input type="checkbox" name="categories[]"
                                                                class="form-check-input" value="16">

                                                            <span class="form-check-label">
                                                                Tomato
                                                            </span>

                                                        </label>

                                                    </li>

                                                    <li>
                                                        <label class="form-check">
                                                            <input type="checkbox" name="categories[]"
                                                                class="form-check-input" value="17">

                                                            <span class="form-check-label">
                                                                Potato
                                                            </span>

                                                        </label>

                                                    </li>
                                                </ul>
                                            </li>

                                            <li>
                                                <label class="form-check">
                                                    <input type="checkbox" name="categories[]"
                                                        class="form-check-input" value="18">

                                                    <span class="form-check-label">
                                                        Fruits
                                                    </span>

                                                </label>

                                                <ul class="list-unstyled ms-3 me-0 mt-2">

                                                    <li>
                                                        <label class="form-check">
                                                            <input type="checkbox" name="categories[]"
                                                                class="form-check-input" value="19">

                                                            <span class="form-check-label">
                                                                Banana
                                                            </span>

                                                        </label>

                                                    </li>

                                                    <li>
                                                        <label class="form-check">
                                                            <input type="checkbox" name="categories[]"
                                                                class="form-check-input" value="20">

                                                            <span class="form-check-label">
                                                                Mango
                                                            </span>

                                                        </label>

                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                    <script>
                                        function filter_categories_60252237(inputSearchId) {
                                            const searchInput = document.getElementById('search-category-input-' + inputSearchId).value.toLowerCase();
                                            const categories = document.querySelectorAll('.tree-categories-list-' + inputSearchId + ' label');

                                            categories.forEach(category => {
                                                const text = category.textContent.toLowerCase();
                                                category.style.display = text.includes(searchInput) ? '' : 'none';
                                            });
                                        }
                                    </script>


                                </div>
                            </div>
                            <div class="card meta-boxes">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <label class="form-label" for="brand_id">
                                            Brand


                                        </label>
                                    </h4>
                                </div>


                                <div class=" card-body">
                                    <select class="select-search-full form-select" data-placeholder="Select a brand..."
                                        data-allow-clear="true" id="brand_id-select-70809" name="brand_id">
                                        <option selected="selected" value="">Select a brand...
                                        </option>
                                        <option value="1">FoodPound</option>
                                        <option value="2">iTea JSC</option>
                                        <option value="3">Soda Brand</option>
                                        <option value="4">Shofy</option>
                                        <option value="5">Soda Brand</option>
                                    </select>






                                </div>
                            </div>
                            <div class="card meta-boxes">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <label class="form-label" for="image">
                                            Featured image (optional)


                                        </label>
                                    </h4>
                                </div>


                                <div class=" card-body">
                                    <div class="image-box image-box-image" action="select-image" data-counter="250">
                                        <input class="image-data" name="image" type="hidden" value=""
                                            class="" data-counter="250" />


                                        <div style="width: 8rem" class="preview-image-wrapper mb-1">
                                            <div class="preview-image-inner">
                                                <a data-bb-toggle="image-picker-choose" data-target="popup"
                                                    class="image-box-actions" data-result="image"
                                                    data-action="select-image" data-allow-thumb="1" href="#">
                                                    <img class="preview-image default-image"
                                                        data-default="https://shofy-grocery.botble.com/vendor/core/core/base/images/placeholder.png"
                                                        src="https://shofy-grocery.botble.com/vendor/core/core/base/images/placeholder.png"
                                                        alt="Preview image" />
                                                    <span class="image-picker-backdrop"></span>
                                                </a>
                                                <button
                                                    class="btn btn-pill btn-icon  btn-sm image-picker-remove-button p-0"
                                                    style="display: none; --bb-btn-font-size: 0.5rem;" type="button"
                                                    data-bb-toggle="image-picker-remove" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Remove image">
                                                    <svg class="icon icon-sm  icon-left svg-icon-ti-ti-x"
                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M18 6l-12 12" />
                                                        <path d="M6 6l12 12" />
                                                    </svg>

                                                </button>
                                            </div>
                                        </div>

                                        <a data-bb-toggle="image-picker-choose" data-target="popup"
                                            data-result="image" data-action="select-image" data-allow-thumb="1"
                                            href="#">
                                            Choose image
                                        </a>

                                        <div data-bb-toggle="upload-from-url">
                                            <span class="text-muted">or</span>
                                            <a href="javascript:void(0)" class="mt-1" data-bs-toggle="modal"
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
                                        <label class="form-label" for="product_collections[]">
                                            Product collections


                                        </label>
                                    </h4>
                                </div>


                                <div class=" card-body">
                                    <fieldset class="form-fieldset fieldset-for-multi-check-list">
                                        <div class="multi-check-list-wrapper">

                                            <label class="form-check">
                                                <input type="checkbox" id="product-collections-item-1"
                                                    name="product_collections[]" class="form-check-input"
                                                    value="1">

                                                <span class="form-check-label">
                                                    Weekly Gadget Spotlight
                                                </span>

                                            </label>
                                            <label class="form-check">
                                                <input type="checkbox" id="product-collections-item-2"
                                                    name="product_collections[]" class="form-check-input"
                                                    value="2">

                                                <span class="form-check-label">
                                                    Electronics Trendsetters
                                                </span>

                                            </label>
                                            <label class="form-check">
                                                <input type="checkbox" id="product-collections-item-3"
                                                    name="product_collections[]" class="form-check-input"
                                                    value="3">

                                                <span class="form-check-label">
                                                    Digital Workspace Gear
                                                </span>

                                            </label>
                                            <label class="form-check">
                                                <input type="checkbox" id="product-collections-item-4"
                                                    name="product_collections[]" class="form-check-input"
                                                    value="4">

                                                <span class="form-check-label">
                                                    Cutting-Edge Tech Showcase
                                                </span>

                                            </label>
                                        </div>
                                    </fieldset>






                                </div>
                            </div>
                            <div class="card meta-boxes">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <label class="form-label" for="product_labels[]">
                                            Labels


                                        </label>
                                    </h4>
                                </div>


                                <div class=" card-body">
                                    <fieldset class="form-fieldset fieldset-for-multi-check-list">
                                        <div class="multi-check-list-wrapper">

                                            <label class="form-check">
                                                <input type="checkbox" id="product-labels-item-1"
                                                    name="product_labels[]" class="form-check-input" value="1">

                                                <span class="form-check-label">
                                                    Hot
                                                </span>

                                            </label>
                                            <label class="form-check">
                                                <input type="checkbox" id="product-labels-item-2"
                                                    name="product_labels[]" class="form-check-input" value="2">

                                                <span class="form-check-label">
                                                    New
                                                </span>

                                            </label>
                                            <label class="form-check">
                                                <input type="checkbox" id="product-labels-item-3"
                                                    name="product_labels[]" class="form-check-input" value="3">

                                                <span class="form-check-label">
                                                    Sale
                                                </span>

                                            </label>
                                        </div>
                                    </fieldset>






                                </div>
                            </div>
                            <div class="card meta-boxes">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <label class="form-label" for="taxes[]">
                                            Taxes


                                        </label>
                                    </h4>
                                </div>


                                <div class=" card-body">
                                    <fieldset class="form-fieldset fieldset-for-multi-check-list">
                                        <div class="multi-check-list-wrapper">

                                            <label class="form-check">
                                                <input type="checkbox" id="taxes-item-2" name="taxes[]"
                                                    class="form-check-input" value="2">

                                                <span class="form-check-label">
                                                    None (0%)
                                                </span>

                                            </label>
                                            <label class="form-check">
                                                <input type="checkbox" id="taxes-item-1" name="taxes[]"
                                                    class="form-check-input" value="1">

                                                <span class="form-check-label">
                                                    VAT (10%)
                                                </span>

                                            </label>
                                            <label class="form-check">
                                                <input type="checkbox" id="taxes-item-3" name="taxes[]"
                                                    class="form-check-input" value="3">

                                                <span class="form-check-label">
                                                    Import Tax (15%)
                                                </span>

                                            </label>
                                        </div>
                                    </fieldset>






                                </div>
                            </div>
                            <div class="card meta-boxes">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <label class="form-label" for="minimum_order_quantity">
                                            Minimum order quantity


                                        </label>
                                    </h4>
                                </div>


                                <div class=" card-body">
                                    <input class="form-control" name="minimum_order_quantity" type="number"
                                        value="0" id="minimum_order_quantity">


                                    <small class="form-hint">
                                        Minimum quantity to place an order, if the value is 0, there is no
                                        limit.
                                    </small>




                                </div>
                            </div>
                            <div class="card meta-boxes">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <label class="form-label" for="maximum_order_quantity">
                                            Maximum order quantity


                                        </label>
                                    </h4>
                                </div>


                                <div class=" card-body">
                                    <input class="form-control" name="maximum_order_quantity" type="number"
                                        value="0" id="maximum_order_quantity">


                                    <small class="form-hint">
                                        Maximum quantity to place an order, if the value is 0, there is no
                                        limit.
                                    </small>




                                </div>
                            </div>
                            <div class="card meta-boxes">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <label class="form-label" for="tag">
                                            Tags


                                        </label>
                                    </h4>
                                </div>


                                <div class=" card-body">
                                    <input class="form-control tags" placeholder="Write some tags"
                                        data-url="https://shofy-grocery.botble.com/admin/ecommerce/product-tags/all"
                                        name="tag" type="text" id="tag">






                                </div>
                            </div>

                        </div>
                    </div>

                </form>



            </div>






@endsection
