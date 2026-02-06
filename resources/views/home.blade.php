@extends('admin-layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Dashboard</h1>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <main class="page-body page-content">
            <div class="container-xl">
                <div class="row">
                    <div class="col-12"></div>
                    <div class="col-12">
                        <div id="shortcode-cache-suggestion" class="alert alert-info alert-dismissible"
                            style="margin: 20px 0px;">
                            <div class="d-flex">
                                <div class="me-3"><svg class="icon text-info svg-icon-ti-ti-bulb"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" style="font-size: 24px;">
                                        <path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7"></path>
                                        <path d="M9 16a5 5 0 1 1 6 0a3.5 3.5 0 0 0 -1 3a2 2 0 0 1 -4 0a3.5 3.5 0 0 0 -1 -3">
                                        </path>
                                        <path d="M9.7 17l4.6 0"></path>
                                    </svg></div>
                                <div class="flex-fill">
                                    <h5 class="mb-1">Performance Suggestion</h5>
                                    <p class="mb-1"> You can improve your site performance by enabling shortcode
                                        caching. This can significantly reduce page load times by caching rendered
                                        shortcodes. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row row-cards">
                            <div class="col dashboard-widget-item col-12 col-md-6 col-lg-3"><a
                                    class="text-white d-block rounded position-relative overflow-hidden text-decoration-none"
                                    href="http://127.0.0.1:8000/admin/ecommerce/orders"
                                    style="background-color: rgb(50, 197, 210);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="details px-4 py-3 d-flex flex-column justify-content-between">
                                            <div class="desc fw-medium">Orders</div>
                                            <div class="number fw-bolder"><span>0</span></div>
                                        </div>
                                        <div class="visual ps-1 position-absolute end-0"><i
                                                class="fas fa-users me-n2 me-n2"
                                                style="opacity: 0.1; --bb-icon-size: 80px;"></i></div>
                                    </div>
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
