@extends('admin-layouts.app')
@section('title', 'Marketplace Messages')
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
                                                    href="{{ route('admin.dashboard') }}">Dashboard</a>
                                            </li>
                                            <li
                                                class="breadcrumb-item active"
                                                aria-current="page">
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">Messages</h1>
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
                            <div class="card mb-3 table-configuration-wrap" style="display: none;">
                                <div class="card-body">
                                    <button
                                        class="btn btn-icon  btn-sm btn-show-table-options rounded-pill" type="button">
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

                                    <div class="wrapper-filter">
                                        <p>Filters</p>

                                <input
                                    type="hidden"
                                    class="filter-data-url"
                                    value="{{ route('admin.marketplace.messages') }}" />

                                        <div class="sample-filter-item-wrap hidden">
                                            <div class="row filter-item form-filter">
                                                <div class="col-auto w-50 w-sm-auto">
                                                    <div class="mb-3 position-relative">
                                                        <select class="form-select filter-column-key" name="filter_columns[]" id="filter_columns[]">
                                                            <option
                                                                value="name">Name</option>
                                                            <option
                                                                value="email">Email</option>
                                                            <option
                                                                value="created_at">Created At</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-auto w-50 w-sm-auto">
                                                    <div class="mb-3 position-relative">
                                                        <select class="form-select filter-operator filter-column-operator" name="filter_operators[]" id="filter_operators[]">
                                                            <option
                                                                value="like">Contains</option>
                                                            <option
                                                                value="=">Is equal to</option>
                                                            <option
                                                                value="&gt;">Greater than</option>
                                                            <option
                                                                value="&lt;">Less than</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-auto w-100 w-sm-25">
                                                    <span class="filter-column-value-wrap">
                                                        <input
                                                            class="form-control filter-column-value"
                                                            type="text"
                                                            placeholder="Value"
                                                            name="filter_values[]">
                                                    </span>
                                                </div>

                                                <div class="col">
                                                    <button
                                                        class="btn btn-icon   btn-remove-filter-item mb-3 text-danger" type="button"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Delete">
                                                        <svg class="icon icon-left svg-icon-ti-ti-trash"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>

                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <form method="GET" action="{{ route('admin.marketplace.messages') }}" accept-charset="UTF-8" class="filter-form">
                                            <input
                                                type="hidden"
                                                name="filter_table_id"
                                                class="filter-data-table-id"
                                                value="botble-marketplace-tables-message-table">
                                            <input
                                                type="hidden"
                                                name="class"
                                                class="filter-data-class"
                                                value="Botble\Marketplace\Tables\MessageTable">
                                            <div class="filter_list inline-block filter-items-wrap">
                                                <div class="row filter-item form-filter filter-item-default">
                                                    <div class="col-auto w-50 w-sm-auto">
                                                        <div class="mb-3 position-relative">
                                                            <select class="form-select filter-column-key" name="filter_columns[]" id="filter_columns[]">
                                                                <option
                                                                    value=""
                                                                    selected>Select field</option>
                                                                <option
                                                                    value="name">Name</option>
                                                                <option
                                                                    value="email">Email</option>
                                                                <option
                                                                    value="created_at">Created At</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-auto w-50 w-sm-auto">
                                                        <div class="mb-3 position-relative">
                                                            <select class="form-select filter-operator filter-column-operator" name="filter_operators[]" id="filter_operators[]">
                                                                <option
                                                                    value="like">Contains</option>
                                                                <option
                                                                    value="="
                                                                    selected>Is equal to</option>
                                                                <option
                                                                    value="&gt;">Greater than</option>
                                                                <option
                                                                    value="&lt;">Less than</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-auto w-100 w-sm-25">
                                                        <div class="filter-column-value-wrap mb-3">
                                                            <input
                                                                class="form-control filter-column-value"
                                                                type="text"
                                                                placeholder="Value"
                                                                name="filter_values[]"
                                                                value="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-list">
                                                <button
                                                    class="btn   add-more-filter" type="button">

                                                    Add additional filter

                                                </button>
                                                <button
                                                    class="btn btn-primary  btn-apply" type="submit">

                                                    Apply

                                                </button>
                                                <a
                                                    class="btn btn-icon   w-6" style="display: none;" type="button" href="{{ route('admin.marketplace.messages') }}" data-bb-toggle="datatable-reset-filter">
                                                    <svg class="icon icon-left svg-icon-ti-ti-refresh"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                                    </svg>

                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card has-actions has-filter">
                                <div class="card-header">
                                    <div class="w-100 justify-content-between d-flex flex-wrap align-items-center gap-1">
                                        <div class="d-flex flex-wrap flex-md-nowrap align-items-center gap-1">
                                            <div class="dropdown d-inline-block">
                                                <button
                                                    class="btn   dropdown-toggle" type="button" data-bs-toggle="dropdown">

                                                    Bulk Actions

                                                </button>

                                                <div class="dropdown-menu">
                                                    <div class="dropdown-submenu">
                                                        <button class="dropdown-item">

                                                            Bulk changes

                                                            <svg class="icon dropdown-item-icon ms-auto me-0 svg-icon-ti-ti-chevron-right"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="24"
                                                                height="24"
                                                                viewBox="0 0 24 24"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                stroke-width="2"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path d="M9 6l6 6l-6 6" />
                                                            </svg> </button>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item bulk-change-item" data-key="name" data-class-item="Botble\Marketplace\Tables\MessageTable" data-save-url="#">

                                                                Name

                                                            </button>
                                                            <button class="dropdown-item bulk-change-item" data-key="email" data-class-item="Botble\Marketplace\Tables\MessageTable" data-save-url="#">

                                                                Email

                                                            </button>
                                                            <button class="dropdown-item bulk-change-item" data-key="created_at" data-class-item="Botble\Marketplace\Tables\MessageTable" data-save-url="#">

                                                                Created At

                                                            </button>
                                                        </div>
                                                    </div>

                                                    <a class="dropdown-item" href="#" data-trigger-bulk-action="data-trigger-bulk-action" data-method="POST" data-table-target="Botble\Marketplace\Tables\MessageTable" data-target="Botble\Table\BulkActions\DeleteBulkAction" data-confirmation-modal-title="Confirm to perform this action" data-confirmation-modal-message="Are you sure you want to do this action? This cannot be undone." data-confirmation-modal-button="Delete" data-confirmation-modal-cancel-button="Cancel">

                                                        Delete

                                                    </a>
                                                </div>
                                            </div>

                                            <button
                                                class="btn   btn-show-table-options" type="button">

                                                Filters

                                            </button>

                                            <div class="table-search-input">
                                                <label>
                                                    <input
                                                        type="search"
                                                        class="form-control input-sm"
                                                        placeholder="Search..."
                                                        style="min-width: 120px">
                                                    <button
                                                        type="button"
                                                        title="Search..."
                                                        class="search-icon"><svg class="icon svg-icon-ti-ti-search"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                            <path d="M21 21l-6 -6" />
                                                        </svg></button>
                                                    <button
                                                        type="button"
                                                        title="Clear"
                                                        class="search-reset-icon"><svg class="icon svg-icon-ti-ti-x"
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
                                                        </svg></button>
                                                </label>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">

                                            <button
                                                class="btn" type="button" data-bb-toggle="dt-buttons" data-bb-target=".buttons-reload" tabindex="0" aria-controls="botble-marketplace-tables-message-table">
                                                <svg class="icon icon-left svg-icon-ti-ti-refresh"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                                </svg>
                                                Reload

                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-table">
                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter table-striped table-hover" id="botble-marketplace-tables-message-table">
                                            <thead>
                                                <tr>
                                                    <th title="Checkbox"><input class="form-check-input m-0 align-middle table-check-all" data-set=".dataTable .checkboxes" name="" type="checkbox"></th>
                                                    <th title="ID" width="20" class="text-center no-column-visibility column-key-0">ID</th>
                                                    <th title="Name" class="text-start column-key-1">Name</th>
                                                    <th title="Email" class="text-start column-key-2">Email</th>
                                                    <th title="Details" class="text-start column-key-3">Details</th>
                                                    <th title="Created At" width="100" class="column-key-4">Created At</th>
                                                    <th title="Operations">Operations</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($messages as $message)
                                                    <tr>
                                                        <td><input class="form-check-input m-0 align-middle checkboxes" type="checkbox" value="{{ $message->id }}"></td>
                                                        <td class="text-center">{{ $message->id }}</td>
                                                        <td>
                                                             @if($message->customer)
                                                                <a href="{{ route('admin.marketplace.vendors.show', $message->customer->id) }}">{{ $message->name ?: $message->customer->name }}</a>
                                                            @else
                                                                {{ $message->name ?: 'Guest' }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $message->email }}</td>
                                                        <td>
                                                            <div><strong>Content:</strong> {{ \Illuminate\Support\Str::limit($message->content, 50) }}</div>
                                                            @if($message->store)
                                                                <div class="small text-muted">Store: <a href="{{ route('admin.marketplace.store.show', $message->store->id) }}">{{ $message->store->name }}</a></div>
                                                            @endif
                                                        </td>
                                                        <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                                                        <td class="text-center">
                                                           <div class="btn-list flex-nowrap justify-content-center">
                                                                <button type="button" class="btn btn-icon btn-sm btn-info btn-view-message"
                                                                    data-id="{{ $message->id }}"
                                                                    data-name="{{ $message->name }}"
                                                                    data-email="{{ $message->email }}"
                                                                    data-content="{{ $message->content }}"
                                                                    data-time="{{ $message->created_at->format('Y-m-d H:i') }}"
                                                                    data-bs-toggle="tooltip" data-bs-original-title="View">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                       <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                                       <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                                                    </svg>
                                                                </button>
                                                                <form action="{{ route('admin.marketplace.vendors.destroy-message', $message->id) }}" method="POST" class="delete-message-form" style="display:inline-block">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                                                        <svg class="icon svg-icon-ti-ti-trash" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center py-4">
                                                            <div class="text-muted">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mood-happy mb-2" width="48" height="48" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                   <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                                   <path d="M9 9l.01 0"></path>
                                                                   <path d="M15 9l.01 0"></path>
                                                                   <path d="M8 13a4 4 0 1 0 8 0h-8"></path>
                                                                </svg>
                                                                <p class="mb-0">No messages found</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    @if(is_object($messages) && method_exists($messages, 'hasPages') && $messages->hasPages())
                                        <div class="card-footer d-flex align-items-center">
                                            {{ $messages->withQueryString()->links('pagination::bootstrap-5') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>




                    </div>
                </main>




@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        // View Message
        $(document).on('click', '.btn-view-message', function() {
            let name = $(this).data('name') || 'Guest';
            let email = $(this).data('email');
            let content = $(this).data('content');
            let time = $(this).data('time');

            Swal.fire({
                title: 'Message details',
                html: `
                    <div class="text-start">
                        <p class="mb-1"><strong>From:</strong> ${name}</p>
                        <p class="mb-1"><strong>Email:</strong> ${email}</p>
                        <p class="mb-3"><strong>Sent at:</strong> ${time}</p>
                        <div class="p-3 bg-light rounded border">
                            <p class="mb-0" style="white-space: pre-wrap;">${content}</p>
                        </div>
                    </div>
                `,
                confirmButtonText: 'Close',
                customClass: {
                    container: 'message-view-modal'
                }
            });
        });

        // Delete Message
        $(document).on('submit', '.delete-message-form', function (e) {
            e.preventDefault();
            let $form = $(this);

            Swal.fire({
                title: "Are you sure?",
                text: "Do you really want to delete this message?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, Delete it !",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Please wait...",
                        text: "Deleting message...",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: $form.attr('action'),
                        type: 'POST',
                        data: $form.serialize(),
                        success: function (res) {
                            if (res.status) {
                                Swal.fire("Deleted!", res.message, "success");
                                $form.closest('tr').fadeOut(500, function() {
                                    $(this).remove();
                                    if ($('#botble-marketplace-tables-message-table tbody tr').length === 0) {
                                        location.reload();
                                    }
                                });
                            } else {
                                Swal.fire("Error!", res.message, "error");
                            }
                        },
                        error: function (xhr) {
                            Swal.fire("Error!", xhr?.responseJSON?.message || "Something went wrong", "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endpush