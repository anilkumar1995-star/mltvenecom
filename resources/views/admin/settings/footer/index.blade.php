@extends('admin-layouts.app')
@section('title', 'Footer Settings')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none text-uppercase">
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
                                    <span class="mb-0 d-inline-block fs-6 lh-1 text-muted">Settings</span>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Footer Settings</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content mt-0">
        <div class="container-xl">
            {{-- Shared Filter Panel --}}
            @include('admin-layouts.partials.table-filters', ['filterColumns' => []])

            <div class="card has-actions has-filter">
                {{-- Shared Header --}}
                @include('admin-layouts.partials.table-header', [
                    'bulkActions' => false,
                    'tableId'     => 'footerSettingsTable'
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover text-nowrap" id="footerSettingsTable">
                            <thead class="bg-light">
                                <tr>
                                    <th>Logo</th>
                                    <th>Description</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Office Address</th>
                                    <th width="100" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        @if(isset($settings->footer_logo))
                                            <div class="p-1 px-2 mb-0 d-inline-block bg-light rounded shadow-xs">
                                                <img src="{{ \App\Helpers\ImageHelper::getImageUrl() }}{{ $settings->footer_logo }}" height="30" alt="Footer Logo">
                                            </div>
                                        @else
                                            <span class="text-danger small">No Logo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-muted small text-truncate d-inline-block" style="max-width: 250px;" title="{{ $settings->footer_description ?? 'N/A' }}">
                                            {{ Str::limit($settings->footer_description ?? 'Not set', 50) }}
                                        </span>
                                    </td>
                                    <td class="fw-bold text-dark small">{{ $settings->footer_phone ?? 'N/A' }}</td>
                                    <td class="small">{{ $settings->footer_email ?? 'N/A' }}</td>
                                    <td>
                                        <span class="text-muted small text-truncate d-inline-block" style="max-width: 200px;" title="{{ $settings->footer_address ?? 'N/A' }}">
                                            {{ Str::limit($settings->footer_address ?? 'Not set', 40) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.footer-settings.edit') }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-light-subtle">
                    <div class="row text-center text-md-start small py-2">
                        <div class="col-md-2 mb-2 mb-md-0">
                            <strong>Facebook:</strong> <span class="text-muted small">{{ $settings->facebook_url ?? '#' }}</span>
                        </div>
                        <div class="col-md-2 mb-2 mb-md-0">
                            <strong>Twitter:</strong> <span class="text-muted small">{{ $settings->twitter_url ?? '#' }}</span>
                        </div>
                        <div class="col-md-3 mb-2 mb-md-0">
                            <strong>YouTube:</strong> <span class="text-muted small">{{ $settings->youtube_url ?? '#' }}</span>
                        </div>
                        <div class="col-md-2">
                            <strong>LinkedIn:</strong> <span class="text-muted small">{{ $settings->linkedin_url ?? '#' }}</span>
                        </div>
                         <div class="col-md-3">
                            <strong>Instagram:</strong> <span class="text-muted small">{{ $settings->instagram_url ?? '#' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId'       => 'footerSettingsTable',
        'bulkDeleteUrl' => null
    ])
@endpush
