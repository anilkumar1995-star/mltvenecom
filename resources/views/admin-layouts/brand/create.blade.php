@extends('admin-layouts.app')
@section('title', 'Brand Create')
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
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('home') }}">Dashboard
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="mb-0 d-inline-block fs-6 lh-1"
                                            href="https://shofy-grocery.botble.com/admin/ecommerce/brands">Brands</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">New brand</h1>
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
                <form method="POST">
                    <div class="row">
                        <div class="gap-3 col-md-9">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="name">Name</label>
                                            <input class="form-control" placeholder="Name" name="name" type="text"
                                                id="name">
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="description">
                                                Description
                                            </label>
                                            <textarea class="form-control" data-counter="400" rows="4" placeholder="Short description" id="description"
                                                name="description" cols="50"></textarea>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="order">
                                                Sort order
                                            </label>
                                            <input class="form-control" placeholder="Order by" name="order" type="number"
                                                value="0" id="order">
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
                                        <label class="form-label" for="logo">
                                            Logo
                                        </label>
                                    </h4>
                                </div>
                                <div class=" card-body">
                                    <div class="image-box image-box-logo" action="select-image">
                                        <input class="image-data" name="logo" type="hidden" value=""
                                            class="" />
                                        <div style="width: 8rem" class="preview-image-wrapper mb-1">
                                            <div class="preview-image-inner">
                                                <a data-bb-toggle="image-picker-choose" data-target="popup"
                                                    class="image-box-actions" data-result="logo" data-action="select-image"
                                                    data-allow-thumb="1" href="#">
                                                    <img class="preview-image default-image"
                                                        data-default="https://shofy-grocery.botble.com/vendor/core/core/base/images/placeholder.png"
                                                        src="https://shofy-grocery.botble.com/vendor/core/core/base/images/placeholder.png"
                                                        alt="Preview image" />
                                                    <span class="image-picker-backdrop"></span>
                                                </a>
                                                <button class="btn btn-pill btn-icon  btn-sm image-picker-remove-button p-0"
                                                    style="display: none; --bb-btn-font-size: 0.5rem;" type="button"
                                                    data-bb-toggle="image-picker-remove" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Remove image">
                                                    <svg class="icon icon-sm  icon-left svg-icon-ti-ti-x"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M18 6l-12 12" />
                                                        <path d="M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                        <a data-bb-toggle="image-picker-choose" data-target="popup" data-result="logo"
                                            data-action="select-image" data-allow-thumb="1" href="#">
                                            Choose image
                                        </a>

                                        <div data-bb-toggle="upload-from-url">
                                            <span class="text-muted">or</span>
                                            <a href="javascript:void(0)" class="mt-1" data-bs-toggle="modal"
                                                data-bs-target="#image-picker-add-from-url"
                                                data-bb-target=".image-box-logo">
                                                Add from URL
                                            </a>
                                        </div>
                                    </div>
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


                               <div class="card-body">
                                    <div class="mb-3">
                                        <div class="input-icon">
                                            <input type="text" id="search-category-input" class="form-control" placeholder="Search..." onkeyup="filterCategories()" />
                                            <span class="input-icon-addon">
                                                <svg class="icon svg-icon-ti-ti-search" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                    <path d="M21 21l-6 -6" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div id="categories-tree">
                                        <ul class="list-unstyled">
                                            @foreach($categories->where('parent_id', 0) as $parent)
                                                <li>
                                                    <label class="form-check">
                                                        <input type="checkbox" name="categories[]" class="form-check-input" value="{{ $parent->id }}">
                                                        <span class="form-check-label">{{ $parent->name }}</span>
                                                    </label>

                                                    @php
                                                        $subcategories = $categories->where('parent_id', $parent->id);
                                                    @endphp

                                                    @if($subcategories->count())
                                                        <ul class="list-unstyled ms-3 mt-2">
                                                            @foreach($subcategories as $sub)
                                                                <li>
                                                                    <label class="form-check">
                                                                        <input type="checkbox" name="categories[]" class="form-check-input" value="{{ $sub->id }}">
                                                                        <span class="form-check-label">{{ $sub->name }}</span>
                                                                    </label>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                <script>
                                    function filterCategories() {
                                        const searchInput = document.getElementById('search-category-input').value.toLowerCase();
                                        const categories = document.querySelectorAll('#categories-tree label');

                                        categories.forEach(category => {
                                            const text = category.textContent.toLowerCase();
                                            category.style.display = text.includes(searchInput) ? '' : 'none';
                                        });
                                    }
                                    </script>

                            </div>

                            <div class="card meta-boxes">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <label class="form-label form-label required" for="status">
                                            Status
                                        </label>
                                    </h4>
                                </div>
                                <div class=" card-body">
                                    <select class="form-select" required id="status" name="status">
                                        <option value="Published">Published</option>
                                        <option value="Pending">Pending</option>
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
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>




                <script src="https://shofy-grocery.botble.com/vendor/core/core/base/js/core-ui.js?v=1.4.4"></script>
                <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/excanvas.min.js?v=1.4.4"></script>
                <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/ie8.fix.min.js?v=1.4.4"></script>
                <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/modernizr/modernizr.min.js?v=1.4.4">
                </script>
                <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/select2/js/select2.min.js?v=1.4.4">
                </script>
                <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/flatpickr/flatpickr.min.js?v=1.4.4">
                </script>
                <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/jquery-cookie/jquery.cookie.js?v=1.4.4">
                </script>
                <script src="https://shofy-grocery.botble.com/vendor/core/core/base/js/core.js?v=1.4.4"></script>
                <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/toastr/toastr.min.js?v=1.4.4"></script>
                <script
                    src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/mcustom-scrollbar/jquery.mCustomScrollbar.js?v=1.4.4">
                </script>
                <script
                    src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/stickytableheaders/jquery.stickytableheaders.js?v=1.4.4">
                </script>
                <script
                    src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/jquery-waypoints/jquery.waypoints.min.js?v=1.4.4">
                </script>
                <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/spectrum/spectrum.js?v=1.4.4"></script>
                <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/fancybox/jquery.fancybox.min.js?v=1.4.4">
                </script>
                <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/fslightbox.js?v=1.4.4"></script>
                <script src="https://shofy-grocery.botble.com/vendor/core/core/js-validation/js/js-validation.js?v=1.4.4"></script>
                <script
                    src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/jquery.are-you-sure/jquery.are-you-sure.js?v=1.4.4">
                </script>
                <script src="https://shofy-grocery.botble.com/vendor/core/plugins/language/js/language-global.js?v=1.4.4"></script>
                <script src="https://shofy-grocery.botble.com/vendor/core/packages/slug/js/slug.js?v=1.4.4"></script>
                <script src="https://shofy-grocery.botble.com/vendor/core/packages/seo-helper/js/seo-helper.js?v=1.4.4"></script>

                <div id="stack-footer">
                    <div class="modal fade modal-blur" id="global-search-modal" data-bb-toggle="gs-modal" tabindex="-1"
                        role="dialog" aria-hidden="true" data-select2-dropdown-parent="true">
                        <div class="modal-dialog " role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form method="POST" action="https://shofy-grocery.botble.com/admin/search"
                                        accept-charset="UTF-8" data-bb-toggle="gs-form"><input name="_token"
                                            type="hidden" value="Nn1kjY6XQlIqvxWPJFd9kS7lqpyos151fHJvvnVq">
                                        <div class="mb-3 position-relative input-icon input-icon">
                                            <label class="form-label sr-only" for="keyword">
                                                Search
                                            </label>
                                            <div class="input-icon">
                                                <span class="input-icon-addon">
                                                    <svg class="icon svg-icon-ti-ti-search"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                        <path d="M21 21l-6 -6" />
                                                    </svg>
                                                </span>
                                                <input class="form-control" type="text" name="keyword" id="keyword"
                                                    placeholder="Search" tabindex="0" data-bb-toggle="gs-input" />
                                            </div>
                                        </div>
                                    </form>

                                    <div data-bb-toggle="gs-result">
                                        <div class="text-center text-muted">
                                            No result found
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <span class="text-muted">
                                        <kbd>
                                            <svg class="icon svg-icon-ti-ti-arrow-back" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                                            </svg> </kbd>
                                        to select
                                    </span>

                                    <span class="text-muted">
                                        <kbd>
                                            <svg class="icon svg-icon-ti-ti-arrow-narrow-up"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 5l0 14" />
                                                <path d="M16 9l-4 -4" />
                                                <path d="M8 9l4 -4" />
                                            </svg> </kbd>
                                        <kbd>
                                            <svg class="icon svg-icon-ti-ti-arrow-narrow-down"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 5l0 14" />
                                                <path d="M16 15l-4 4" />
                                                <path d="M8 15l4 4" />
                                            </svg> </kbd>
                                        to navigate
                                    </span>

                                    <span class="text-muted">
                                        <kbd>esc</kbd>
                                        to close
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <script type="text/x-custom-template" id="gs-not-result-template">
    <div class="text-center text-muted">
        No result found
    </div>
</script>

                    <script src="https://shofy-grocery.botble.com/vendor/core/core/base/js/global-search.js"></script>
                    <div class="modal modal-blur fade media-modal rv-media-modal" id="rv_media_modal" tabindex="-1"
                        role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-full" role="document">
                            <div class="modal-content bb-loading">
                                <div class="modal-header">
                                    <h5 class="modal-title">Media gallery</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="p-0 modal-body media-modal-body media-modal-loading" id="rv_media_body">
                                    <div class="loading-spinner"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade modal-blur" id="image-picker-add-from-url" tabindex="-1" role="dialog"
                        aria-hidden="true" data-select2-dropdown-parent="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-has-form " role="document">
                            <div class="modal-content">
                                <form action="https://shofy-grocery.botble.com/admin/media/files/download-url"
                                    method="POST" id="image-picker-add-from-url-form">
                                    <input type="hidden" name="_token" value="Nn1kjY6XQlIqvxWPJFd9kS7lqpyos151fHJvvnVq"
                                        autocomplete="off">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add from URL</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="image-box-target">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label required" for="url">
                                                URL
                                            </label>
                                            <input class="form-control" type="url" name="url" id="url"
                                                required="required" placeholder="https://" />
                                        </div>

                                        <label class="form-check">
                                            <input type="checkbox" id="download_image_to_local_storage"
                                                name="download_image_to_local_storage" class="form-check-input"
                                                value="1" checked>
                                            <span class="form-check-label">
                                                Download image to local storage
                                            </span>
                                            <span class="form-check-description">If it is unchecked, the image will be
                                                displayed
                                                from the original URL</span>
                                        </label>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn" type="button" data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button class="btn btn-primary" type="submit"
                                            data-bb-toggle="image-picker-add-from-url"
                                            form="image-picker-add-from-url-form">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script>
                        "use strict";

                        var RV_MEDIA_URL = JSON.parse(
                            '{\u0022base_url\u0022:\u0022https:\\\/\\\/shofy-grocery.botble.com\u0022,\u0022base\u0022:\u0022https:\\\/\\\/shofy-grocery.botble.com\\\/admin\\\/media\u0022,\u0022get_media\u0022:\u0022https:\\\/\\\/shofy-grocery.botble.com\\\/admin\\\/media\\\/list\u0022,\u0022create_folder\u0022:\u0022https:\\\/\\\/shofy-grocery.botble.com\\\/admin\\\/media\\\/folders\\\/create\u0022,\u0022popup\u0022:\u0022https:\\\/\\\/shofy-grocery.botble.com\\\/admin\\\/media\\\/popup\u0022,\u0022download\u0022:\u0022https:\\\/\\\/shofy-grocery.botble.com\\\/admin\\\/media\\\/download\u0022,\u0022upload_file\u0022:\u0022https:\\\/\\\/shofy-grocery.botble.com\\\/admin\\\/media\\\/files\\\/upload\u0022,\u0022get_breadcrumbs\u0022:\u0022https:\\\/\\\/shofy-grocery.botble.com\\\/admin\\\/media\\\/breadcrumbs\u0022,\u0022folder_list\u0022:\u0022https:\\\/\\\/shofy-grocery.botble.com\\\/admin\\\/media\\\/folder-list\u0022,\u0022folder_tree\u0022:\u0022https:\\\/\\\/shofy-grocery.botble.com\\\/admin\\\/media\\\/folder-tree\u0022,\u0022global_actions\u0022:\u0022https:\\\/\\\/shofy-grocery.botble.com\\\/admin\\\/media\\\/global-actions\u0022,\u0022media_upload_from_editor\u0022:\u0022https:\\\/\\\/shofy-grocery.botble.com\\\/admin\\\/media\\\/files\\\/upload-from-editor\u0022,\u0022download_url\u0022:\u0022https:\\\/\\\/shofy-grocery.botble.com\\\/admin\\\/media\\\/files\\\/download-url\u0022}'
                        );

                        var RV_MEDIA_CONFIG =
                            JSON.parse(
                                '{\u0022permissions\u0022:[\u0022folders.create\u0022,\u0022folders.edit\u0022,\u0022folders.trash\u0022,\u0022folders.destroy\u0022,\u0022files.create\u0022,\u0022files.edit\u0022,\u0022files.trash\u0022,\u0022files.destroy\u0022,\u0022files.favorite\u0022,\u0022folders.favorite\u0022],\u0022translations\u0022:{\u0022name\u0022:\u0022Name\u0022,\u0022url\u0022:\u0022URL\u0022,\u0022full_url\u0022:\u0022Full URL\u0022,\u0022alt\u0022:\u0022Alt text\u0022,\u0022size\u0022:\u0022Size\u0022,\u0022mime_type\u0022:\u0022Type\u0022,\u0022created_at\u0022:\u0022Uploaded at\u0022,\u0022updated_at\u0022:\u0022Modified at\u0022,\u0022nothing_selected\u0022:\u0022Nothing is selected\u0022,\u0022visit_link\u0022:\u0022Open link\u0022,\u0022width\u0022:\u0022Width\u0022,\u0022height\u0022:\u0022Height\u0022,\u0022no_item\u0022:{\u0022all_media\u0022:{\u0022title\u0022:\u0022Drop files and folders here\u0022,\u0022message\u0022:\u0022Or use the upload button above\u0022},\u0022trash\u0022:{\u0022title\u0022:\u0022There is nothing in your trash currently\u0022,\u0022message\u0022:\u0022Delete files to move them to trash automatically. Delete files from trash to remove them permanently\u0022},\u0022favorites\u0022:{\u0022title\u0022:\u0022You have not added anything to your favorites yet\u0022,\u0022message\u0022:\u0022Add files to favorites to easily find them later\u0022},\u0022recent\u0022:{\u0022title\u0022:\u0022You did not opened anything yet\u0022,\u0022message\u0022:\u0022All recent files that you opened will be appeared here\u0022},\u0022default\u0022:{\u0022title\u0022:\u0022No items\u0022,\u0022message\u0022:\u0022This directory has no item\u0022}},\u0022clipboard\u0022:{\u0022success\u0022:\u0022These file links have been copied to clipboard\u0022},\u0022message\u0022:{\u0022error_header\u0022:\u0022Error\u0022,\u0022success_header\u0022:\u0022Success\u0022},\u0022download\u0022:{\u0022error\u0022:\u0022No files selected or cannot download these files\u0022},\u0022move\u0022:{\u0022select_destination\u0022:\u0022Please select a destination folder\u0022,\u0022same_location\u0022:\u0022Items are already in this location\u0022},\u0022actions_list\u0022:{\u0022basic\u0022:{\u0022preview\u0022:\u0022Preview\u0022,\u0022crop\u0022:\u0022Crop\u0022},\u0022file\u0022:{\u0022copy_link\u0022:\u0022Copy link\u0022,\u0022copy_indirect_link\u0022:\u0022Copy indirect link\u0022,\u0022rename\u0022:\u0022Rename\u0022,\u0022make_copy\u0022:\u0022Make a copy\u0022,\u0022move\u0022:\u0022Move\u0022,\u0022alt_text\u0022:\u0022ALT text\u0022,\u0022share\u0022:\u0022Share\u0022},\u0022user\u0022:{\u0022favorite\u0022:\u0022Add to favorite\u0022,\u0022remove_favorite\u0022:\u0022Remove favorite\u0022},\u0022other\u0022:{\u0022download\u0022:\u0022Download\u0022,\u0022trash\u0022:\u0022Move to trash\u0022,\u0022delete\u0022:\u0022Delete permanently\u0022,\u0022restore\u0022:\u0022Restore\u0022,\u0022properties\u0022:\u0022Properties\u0022}},\u0022change_image\u0022:\u0022Change image\u0022,\u0022delete_image\u0022:\u0022Delete image\u0022,\u0022choose_image\u0022:\u0022Choose image\u0022,\u0022preview_image\u0022:\u0022Preview image\u0022},\u0022pagination\u0022:{\u0022paged\u0022:null,\u0022posts_per_page\u0022:null,\u0022in_process_get_media\u0022:false,\u0022has_more\u0022:true},\u0022chunk\u0022:{\u0022enabled\u0022:false,\u0022chunk_size\u0022:1048576,\u0022max_file_size\u0022:1048576,\u0022storage\u0022:{\u0022chunks\u0022:\u0022chunks\u0022,\u0022disk\u0022:\u0022local\u0022},\u0022clear\u0022:{\u0022timestamp\u0022:\u0022-3 HOURS\u0022,\u0022schedule\u0022:{\u0022enabled\u0022:true,\u0022cron\u0022:\u002225 * * * *\u0022}},\u0022chunk\u0022:{\u0022name\u0022:{\u0022use\u0022:{\u0022session\u0022:true,\u0022browser\u0022:false}}}},\u0022random_hash\u0022:\u0022ddece901e1d6a4dee42183170b9f473f\u0022,\u0022default_image\u0022:\u0022https:\\\/\\\/shofy-grocery.botble.com\\\/vendor\\\/core\\\/core\\\/base\\\/images\\\/placeholder.png\u0022}'
                            );

                        RV_MEDIA_CONFIG.translations.actions_list.other.properties =
                            'Properties';
                    </script>

                    <script src="https://shofy-grocery.botble.com/vendor/core/core/media/js/integrate.js?v=1769596129"></script>


                @endsection
