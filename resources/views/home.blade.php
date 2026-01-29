{{--  @extends('website-layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  --}}

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
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list"><button class="btn btn-outline-primary manage-widget" type="button"
                                data-bs-toggle="modal" data-bs-target="#widgets-management-modal"><svg
                                    class="icon icon-left svg-icon-ti-ti-layout-dashboard"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1">
                                    </path>
                                    <path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1">
                                    </path>
                                    <path d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1">
                                    </path>
                                    <path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1">
                                    </path>
                                </svg> Manage Widgets </button></div>
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
                                    <div class="mt-2"><a
                                            href="http://127.0.0.1:8000/admin/settings/cache#shortcode-cache-settings"
                                            class="btn btn-info btn-sm"><svg class="icon me-1 svg-icon-ti-ti-settings"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                                </path>
                                                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                            </svg> Enable shortcode caching </a><button type="button"
                                            class="btn btn-outline-secondary btn-sm ms-2 dismiss-shortcode-suggestion"><svg
                                                class="icon me-1 svg-icon-ti-ti-eye-off" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"></path>
                                                <path
                                                    d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87">
                                                </path>
                                                <path d="M3 3l18 18"></path>
                                            </svg> Dismiss for a week </button></div>
                                </div>
                            </div>
                        </div>
                        <div id="widget-cache-suggestion" class="alert alert-info alert-dismissible"
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
                                    <p class="mb-1"> You can improve your site performance by enabling widget
                                        caching. This can significantly reduce page load times by caching rendered
                                        widgets. </p>
                                    <div class="mt-2"><a
                                            href="http://127.0.0.1:8000/admin/settings/cache#widget-cache-settings"
                                            class="btn btn-info btn-sm"><svg class="icon me-1 svg-icon-ti-ti-settings"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                                </path>
                                                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                            </svg> Enable widget caching </a><button type="button"
                                            class="btn btn-outline-secondary btn-sm ms-2 dismiss-widget-suggestion"><svg
                                                class="icon me-1 svg-icon-ti-ti-eye-off"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"></path>
                                                <path
                                                    d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87">
                                                </path>
                                                <path d="M3 3l18 18"></path>
                                            </svg> Dismiss for a week </button></div>
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
                            <div class="col dashboard-widget-item col-12 col-md-6 col-lg-3"><a
                                    class="text-white d-block rounded position-relative overflow-hidden text-decoration-none"
                                    href="http://127.0.0.1:8000/admin/ecommerce/products"
                                    style="background-color: rgb(18, 128, 245);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="details px-4 py-3 d-flex flex-column justify-content-between">
                                            <div class="desc fw-medium">Products</div>
                                            <div class="number fw-bolder"><span>30</span></div>
                                        </div>
                                        <div class="visual ps-1 position-absolute end-0"><svg
                                                class="icon me-n2 svg-icon-ti-ti-shopping-cart"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                style="opacity: 0.1; --bb-icon-size: 80px;">
                                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M17 17h-11v-14h-2"></path>
                                                <path d="M6 5l14 1l-1 7h-13"></path>
                                            </svg></div>
                                    </div>
                                </a></div>
                            <div class="col dashboard-widget-item col-12 col-md-6 col-lg-3"><a
                                    class="text-white d-block rounded position-relative overflow-hidden text-decoration-none"
                                    href="http://127.0.0.1:8000/admin/customers"
                                    style="background-color: rgb(117, 182, 249);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="details px-4 py-3 d-flex flex-column justify-content-between">
                                            <div class="desc fw-medium">Customers</div>
                                            <div class="number fw-bolder"><span>10</span></div>
                                        </div>
                                        <div class="visual ps-1 position-absolute end-0"><svg
                                                class="icon me-n2 svg-icon-ti-ti-user" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" style="opacity: 0.1; --bb-icon-size: 80px;">
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            </svg></div>
                                    </div>
                                </a></div>
                            <div class="col dashboard-widget-item col-12 col-md-6 col-lg-3"><a
                                    class="text-white d-block rounded position-relative overflow-hidden text-decoration-none"
                                    href="http://127.0.0.1:8000/admin/ecommerce/reviews"
                                    style="background-color: rgb(7, 79, 157);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="details px-4 py-3 d-flex flex-column justify-content-between">
                                            <div class="desc fw-medium">Reviews</div>
                                            <div class="number fw-bolder"><span>300</span></div>
                                        </div>
                                        <div class="visual ps-1 position-absolute end-0"><svg
                                                class="icon me-n2 svg-icon-ti-ti-messages"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                style="opacity: 0.1; --bb-icon-size: 80px;">
                                                <path
                                                    d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10">
                                                </path>
                                                <path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2">
                                                </path>
                                            </svg></div>
                                    </div>
                                </a></div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 col-12"></div>
                <div class="col-12">
                    <div id="list_widgets" class="row row-cards" data-bb-toggle="widgets-list"
                        data-url="http://127.0.0.1:8000/admin/widgets/order">
                        <div class="widget-item col-12 d-flex col-md-6 col-sm-6" id="widget_posts_recent"
                            data-url="http://127.0.0.1:8000/admin/blog/posts/widgets/recent-posts">
                            <div class="card card-sm flex-fill">
                                <div class="card-header">
                                    <h4 class="card-title"> Recent Posts </h4>
                                    <div class="card-actions btn-actions"></div>
                                </div>
                                <div class="d-flex flex-column justify-content-between h-100 widget-content"
                                    style="min-height: 10rem;">
                                    <div class="table-responsive">


                                        <table class="table table-vcenter card-table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        #
                                                    </th>
                                                    <th>
                                                        Name
                                                    </th>
                                                    <th class="text-end">
                                                        Created At
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        1
                                                    </td>
                                                    <td>
                                                        <a href="http://127.0.0.1:8000/blog/quality-foods-requirments-for-every-human-bodys"
                                                            target="_blank">Quality Foods Requirments For Every
                                                            Human Body’s</a>
                                                    </td>
                                                    <td class="text-end text-nowrap">
                                                        2025-12-27
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2
                                                    </td>
                                                    <td>
                                                        <a href="http://127.0.0.1:8000/blog/freelancer-days-2024-whats-new"
                                                            target="_blank">Freelancer Days 2024, What’s new?</a>
                                                    </td>
                                                    <td class="text-end text-nowrap">
                                                        2025-12-27
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        3
                                                    </td>
                                                    <td>
                                                        <a href="http://127.0.0.1:8000/blog/follow-your-own-design-process-whatever-gets"
                                                            target="_blank">Follow Your own Design process,
                                                            whatever gets</a>
                                                    </td>
                                                    <td class="text-end text-nowrap">
                                                        2025-12-27
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        4
                                                    </td>
                                                    <td>
                                                        <a href="http://127.0.0.1:8000/blog/heres-the-first-valentinos-new-makeup-collection"
                                                            target="_blank">Here’s the First Valentino’s New
                                                            Makeup Collection</a>
                                                    </td>
                                                    <td class="text-end text-nowrap">
                                                        2025-12-27
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        5
                                                    </td>
                                                    <td>
                                                        <a href="http://127.0.0.1:8000/blog/exploring-the-english-countryside"
                                                            target="_blank">Exploring the English Countryside</a>
                                                    </td>
                                                    <td class="text-end text-nowrap">
                                                        2025-12-27
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        6
                                                    </td>
                                                    <td>
                                                        <a href="http://127.0.0.1:8000/blog/fully-embrace-the-return-of-90s-fashion"
                                                            target="_blank">Fully Embrace the Return of 90s
                                                            fashion</a>
                                                    </td>
                                                    <td class="text-end text-nowrap">
                                                        2025-12-27
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        7
                                                    </td>
                                                    <td>
                                                        <a href="http://127.0.0.1:8000/blog/hiring-the-right-sales-team-at-the-right-time"
                                                            target="_blank">Hiring the Right Sales Team at the
                                                            Right Time</a>
                                                    </td>
                                                    <td class="text-end text-nowrap">
                                                        2025-12-27
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        8
                                                    </td>
                                                    <td>
                                                        <a href="http://127.0.0.1:8000/blog/the-litigants-on-the-screen-are-not-actors"
                                                            target="_blank">The litigants on the screen are not
                                                            actors</a>
                                                    </td>
                                                    <td class="text-end text-nowrap">
                                                        2025-12-27
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        9
                                                    </td>
                                                    <td>
                                                        <a href="http://127.0.0.1:8000/blog/the-world-caters-to-average-people"
                                                            target="_blank">The World Caters to Average People</a>
                                                    </td>
                                                    <td class="text-end text-nowrap">
                                                        2025-12-27
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        10
                                                    </td>
                                                    <td>
                                                        <a href="http://127.0.0.1:8000/blog/why-teamwork-really-makes-the-dream-work"
                                                            target="_blank">Why Teamwork Really Makes The Dream
                                                            Work</a>
                                                    </td>
                                                    <td class="text-end text-nowrap">
                                                        2025-12-27
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget-item col-12 d-flex col-md-6 col-sm-6" id="widget_ecommerce_report_general"
                            data-url="http://127.0.0.1:8000/admin/ecommerce/reports/dashboard-general-report">
                            <div class="card card-sm flex-fill">
                                <div class="card-header">
                                    <h4 class="card-title"> Ecommerce </h4>
                                    <div class="card-actions btn-actions"></div>
                                </div>
                                <div class="d-flex flex-column justify-content-between h-100 widget-content scroll-table"
                                    style="min-height: 10rem;">
                                    <link type="text/css" rel="stylesheet" href="{{ asset('/') }}js/widget.css">

                                    <ul class="ecommerce-status-list list-unstyled">
                                        <li class="sales-this-month">
                                            <svg class="icon svg-icon-ti-ti-chart-line" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M4 19l16 0"></path>
                                                <path d="M4 15l4 -6l4 2l4 -5l4 4"></path>
                                            </svg> <a class="ms-2" href="http://127.0.0.1:8000/admin/ecommerce/reports">
                                                <strong>
                                                    $0.00
                                                </strong> Revenue this month
                                            </a>
                                        </li>
                                        <li class="processing-orders">
                                            <svg class="icon svg-icon-ti-ti-truck" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5">
                                                </path>
                                            </svg> <a class="ms-2" href="http://127.0.0.1:8000/admin/ecommerce/orders">
                                                <strong>0</strong>
                                                order(s) processing in this month
                                            </a>
                                        </li>
                                        <li class="completed-orders">
                                            <svg class="icon svg-icon-ti-ti-truck" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5">
                                                </path>
                                            </svg> <a class="ms-2" href="http://127.0.0.1:8000/admin/ecommerce/orders">
                                                <strong>0</strong> order(s) completed in this month
                                            </a>
                                        </li>
                                        <li class="low-in-stock">
                                            <svg class="icon svg-icon-ti-ti-exclamation-circle"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                <path d="M12 9v4"></path>
                                                <path d="M12 16v.01"></path>
                                            </svg> <a class="ms-2"
                                                href="http://127.0.0.1:8000/admin/ecommerce/products">
                                                <strong>0</strong>
                                                product(s) will be out of stock soon
                                            </a>
                                        </li>
                                        <li class="out-of-stock">
                                            <svg class="icon svg-icon-ti-ti-circle-x" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                <path d="M10 10l4 4m0 -4l-4 4"></path>
                                            </svg> <a class="ms-2"
                                                href="http://127.0.0.1:8000/admin/ecommerce/products?filter_table_id=botble-ecommerce-tables-product-table&amp;class=Botble%5CEcommerce%5CTables%5CProductTable&amp;filter_columns%5B%5D=stock_status&amp;filter_operators%5B%5D=%3D&amp;filter_values%5B%5D=out_of_stock">
                                                <strong>0</strong> product(s) out of stock
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="widget-item col-12 d-flex col-md-6 col-sm-6" id="widget_audit_logs"
                            data-url="http://127.0.0.1:8000/admin/audit-logs/widgets/activities">
                            <div class="card card-sm flex-fill">
                                <div class="card-header">
                                    <h4 class="card-title"> Activity Logs </h4>
                                    <div class="card-actions btn-actions"></div>
                                </div>
                                <div class="d-flex flex-column justify-content-between h-100 widget-content"
                                    style="min-height: 10rem;">
                                    <div class="table-responsive">
                                        <table class="table table-vcenter card-table table-hover table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <img src="data:image/jpeg;base64,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"
                                                                    class="avatar" alt="Sunil Kumar">
                                                            </div>
                                                            <div class="col">
                                                                <div class="text-truncate">
                                                                    <strong>
                                                                        <a
                                                                            href="http://127.0.0.1:8000/admin/system/users/profile/1">Sunil
                                                                            Kumar</a>
                                                                        <span
                                                                            class="badge bg-primary text-white">admin</span>
                                                                    </strong>

                                                                    logged in

                                                                    to the customer portal

                                                                </div>
                                                                <div class="text-muted">
                                                                    18 seconds ago
                                                                    (<a href="https://ipinfo.io/127.0.0.1" target="_blank"
                                                                        title="127.0.0.1" rel="nofollow">127.0.0.1</a>)
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD//gA7Q1JFQVRPUjogZ2QtanBlZyB2MS4wICh1c2luZyBJSkcgSlBFRyB2ODApLCBxdWFsaXR5ID0gNzUK/9sAQwAIBgYHBgUIBwcHCQkICgwUDQwLCwwZEhMPFB0aHx4dGhwcICQuJyAiLCMcHCg3KSwwMTQ0NB8nOT04MjwuMzQy/9sAQwEJCQkMCwwYDQ0YMiEcITIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIy/8AAEQgA+gD6AwEiAAIRAQMRAf/EAB8AAAEFAQEBAQEBAAAAAAAAAAABAgMEBQYHCAkKC//EALUQAAIBAwMCBAMFBQQEAAABfQECAwAEEQUSITFBBhNRYQcicRQygZGhCCNCscEVUtHwJDNicoIJChYXGBkaJSYnKCkqNDU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6g4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2drh4uPk5ebn6Onq8fLz9PX29/j5+v/EAB8BAAMBAQEBAQEBAQEAAAAAAAABAgMEBQYHCAkKC//EALURAAIBAgQEAwQHBQQEAAECdwABAgMRBAUhMQYSQVEHYXETIjKBCBRCkaGxwQkjM1LwFWJy0QoWJDThJfEXGBkaJicoKSo1Njc4OTpDREVGR0hJSlNUVVZXWFlaY2RlZmdoaWpzdHV2d3h5eoKDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uLj5OXm5+jp6vLz9PX29/j5+v/aAAwDAQACEQMRAD8Anooor6c/KgooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigEm9gopu9B1YfnR5if31/Op5o9zojhMRLam38mOopvmJ/fX86UMp6MD+NPmXcUsLXhrKDXyYtFFFMwCiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKAEZtqkntULXC+hpJJGKkcUyONZAS2eK46tWUpckD7fK8mw+Gw7xmPV4p20fdK34sQqXJI70n2dj3FWViUAdaftFCwqfxFVOL6uHfLg3aPmv66FPyGHORxTkYR5J7+lWSgNMaFfeh4bl+AdPiiOMfJj3eL7K39agsykDg1LVNjsfaOgqxG5ZsH0q6NW/uy3RwZ3kkaUI4rDr3JJy1etnZr8ySikqJpWA7VtKajueBhcDVxLtTt/w5NSZqo9zIDgY/Ko/tcv+z+Vc88XBH0eF4LzGslL3bev/AAC/mlqgt1J7flVtHLKpPcVdKuqhxZvw5icu96paz7O5JRRRXQfOhRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUx2APJp9Vbl9sgGO1ZVp8kbnrZLgljMUqMuz2GRgmYZ5HNW1GO1Vk+Vg1TeeP7v61hQcYRfMfScSwxWPxMFQjdKKWmmqb7slpCwHU1Abkcjb+tMabP8P61csVTWzPPwvCGZ1XedJpesf8AMs+Yg/ipjTR/3hVYvnPFNIzXPLGvofU4PgKk7SrSkn6x/wAiV3UsSCKjTdnqaZ3qVF5rBSlUlc+hr4fD5ThHSUr3XXXbTohjlg3U/nUbE46mpJeHqI9KyqXUmj18uUJ4aE+VapdBuTRRRWZ3pJbBU0DfvUGT1qGnwnEyn3rSk7TR5ub4aNfB1E/5ZfkzUzRTEOc0+vcTurn8+V6TpVHB9AooopmQUUUUAFFFFABRRRQAUUUHgZoBK+iCio3mRAMn9KrPOhckH9KxnXjDqe5l+QYzGaqElHvytou5ppPPWs53DLgVHXNLG22X4n1uG4AclzTrW9Yf/bF/zX9ailO9gW5OKiQgNk1Oh3DIrH2jqqzPXeWUcnre1jFPTeyW/nqRb29aAxPehu9IK53KW1z66hhsNUXP7KN/Rf5C0UUVB3xioq0VYKKKQ0FAetG9h0NJSHpTUmtjmrYelW/ixUvVJgzFjk9aaelLSEjFJu+rLhCMIqMFZLoNooopDCnR8SCm0DrTTs7mdaHPTlHumaMBJ3Zqaqlmfv8A4Vbr2sPLmppn4JxHh/q+ZVKa6W/9JQUUUVseIFFFFABRRRQAUUUUAFNc4jY+gNOpkv8AqX/3TSl8LN8JFSrwi+rX5lCWQuAMYqKjmivBlJyd2f0ThMLSw1JU6SsgoooqTqH09JCgxjNMoqoycdjDEYSjiY8tWN0PJzSA4puaUUr3N4RjBWiOzRmkpCQOpFBdx2aQnNJuX+8Pzo3L/eH50CuLSE5pCw9RUTlsfLnPtUuSQmyWmVHmX0b8qcsc7NgRyH/gJqHVilcTY6ozIQelWFtblhkQSn6IavW2mSNMm+zkIPXMZ9KzWIg03e1jhxWPhh1dpv0MxDvB7VYjtw5X5jzXR2+kxbW3WffuhrTh0u0GzNqgOB2rlnnGHor3lf0t/mfP4nM8TiW44VuHql/wTlYbcQ7sMTmpK6a8sLdNnlwKM5zgVz1yoS5kUDAB6V7OU5nSxitTTWnX1PzbiDCYmnVdXEzUpNq7+XouhFRRRXtHzgUUUUAFFFFABRRRQAU2TmJx7GnUjfcP0pS2ZrQly1Yy7NfmZjqVAzTKnuAAo+tQV4dSPLKx/QGU4lVsHGr6/mFFSKgY4OakW3QjOWojSlLYK+c4Wh8bf3FenL0q0LSMnq3508Wcfq351ssJUZ41bjXLKa3d/QrCNj6UvlkelWhCucZNK0KjuawrTpUNJ7lYPN8ZjpXw9uXzXzKLHAOe1QSHfjHatH7KjnBLc0v9nQ/3n/Mf4V5tXGwv7ux9JRlV5f3u5nLbO4BBXn3qT7BL6p+dbMOnxbU+Z/zH+FXodMgkJBaTj0I/wrzquaqnv+RUqyjuc4mnzEDlPzq3b6RceYfmj6ep/wAK6aLRLbYp3y/mP8KtR6bCrZDSdPUf4V5dfO4u/K/wMJYqPQ52PQbuRdytFj3Y/wCFakGh3UcoZmixjsx/wrXjgWNdoJx71aryK2b15aK1vQ5KmJlJW6FG3s5IoyrFc5zwavqpGKSpO1ebXxE6vxHGopNtdQqFvvH61NULfeP1ow27KRHIhbGO1cjqIxqE4P8Aersa5XUolN9cNk53E19xwnWUMTNP+X9UfJcXUOfDQa/m/RmfRRRX6MfmgUUUUAFFFFABRRRQAUUUUAtBjIp6qD+FAjTH3F/Kn0VPItzp+t1+XkjJr5sbsT+6v5UuFHYflQDmpVtzIu4MBXHiMdh6HxySPWwWT5jjHdRbXqv8yIj0FORHI4Umri2DM2N4/KrMViyqRvHX0r5XG8QKa5Y2/E/Qsr4Xw2F9+Um352/yM8QSdoz+VOFrM3SFj+FaywEEfMKnjTYDzXztTM5vz+8+ohKMFaMUjNhtHBTdB9crV+C2T5t0K/ioqyOlOXvXm1sVOoTOo2NWGIAfu0H/AAEVIiIM4VR+FFKtcjk3uzFtki8ClpoPanViyBw6VNUI6VKGyaiRmxaVSc0lKv3qh7Ej84qE/eP1qRutRHrW2GWrBBWNqEJP2h/L/hJzj2rVlmEWMgnNZ15chrecbTyjD9K9/KZTjiFyLt+aPLzmEJYZ877/AJM5qiiiv14/GwooooAKKKKACiiigAooooAUVZigR0UkHn3qrWrZkfZUz7/zrwOIMTVw2HU6berS09GfVcKYOhi8VKnWSdot6q/Vf5iCxgH8J/OpFt40GADj61LRX57Uxdep8c2/Vn61RoUqCtSio+g4IFORUi9KZkGlrkd3uXYkX71PqOnL0rNkslHSnL3qMdakUgVlJEsdSrSUoOKhkMd3p9QmaNWwWwR7UG6hA5f9DUuEnshWLA6U9PvVRNzExyH4+hqMxyOMKCT9afsb76EuJq1E8jIpI6isprO6Y5CH/voVCN0LbpMhR171rSwfP8Du+yIm6cI805JepoTXkykYYflVR9QuBnDD8qhe+t1IzJ/46azJ7iN2k2vnJOODX0eWZBVrNc8XFecX3PAx/EWGwqahab8pL/gly61K5OzLL3/hqm97O4ZWYYIweKq5B707acZr7vBZRhsNFLlTa628z8/zHOcVjJtpyjF9LtrawlFGMUV6x4lrBRRRQAUUUUAFFFFABRRRQAVftpcQouP85qhVqA4VBnv/AFryc5oKvh1F9Hf8Ge5w/i3hcW5rqrfijToopMj1Fflp+23HL1p9MUgt1p+KiSaZPMmPpy9Ki+b3oy49fyqOW5m5onzjmmtNj+H9aFIOASPep40gbO/b7ZNQ4tboydaC6kAucD7n605bjd/D+tTmO2z/AAf99VFOIUUFCoPfBralhnUkoqO5x1cwpU4tvp6DTF5rbt2M+1SHTQ/Hm4/4DVCS4dWIWTAHSq8mo3arlZznPoK9ijw7ja1vZzivW/8AkePW4nw9LeL/AA/zNb+zwnHm5/4DSiXyzuxmsM6nek8zt+QqM31yesp/IV6dLhHEf8vpRfzf+R5Vfi2En+7Ul8l/mb7akYzjys9/vVhzakZi8flYyeu6oTczMclyaiCjfnHNe5l/DeGwz5pRTemzfQ8PG5/iMQuWMnb0Qrr5hB6YqMw8/e/Spjx0ptfRRiorlR4clzPmZGIsd6eBgYpaKYJWI5PlApoORT5Ogpg6Uzmqr3haKKKDMKKKKACiiigAooooAKVeHU+4pKM4OamceaLRdObhJSRrm4Qjv+VMI8w7l6VnNcMB0FOS/kRcBFr5H/V5U1ektfU+6/1qq1dKlren/BNOKF4X3vjHtU/2mNeDn8qyW1aV1wY0/WomvnY5KrR/YMq/+8L7mYLiD2DvQf3o201m0VwDv4/2aWTWbRiMb/8AvmubBy+fWn11UuF8DB3XN9//AADkrcS42rpK33f8E1HvImdmG7BOelRSXCNjGfyqoOgpwGa9enl1GDTV9Dy546rO6diQnccjvSgYpo4xT674qyscjdwoooqiRrdaiqVutMK4FSMbTgOaQDIp9A0xCM0Z4xQTim0DCiimM5XPA4pDCRSwGKYBgYNCyluwpc5oTMKysFFFFMwCiiigAooooAKKKKACg9KKKAIjnvSU9hxTKhnTB3QUUUUFEgA9KWmhs8U6mIkHQUtNDAClBzVASDoKcD60wNgUoOaBklFNBwKQuMdDTuFhT1pqg55Bx71Vn1COCTYyMTjPFQPrsAX/AFUn6f41PMupShJ7GizIpxkD8ajNzAOs0Y/4EKyJdZhkcERyDjHaqLyh84B55qHU7GqovqdE15bD/l4i/wC+xVKe8Qq+y4XPba9YjRl+hHFW4tLlOx96YIB71PPKWyK5YQWrHNPdP9ySU464JqWL7WWTd5xBIznNWLa0eLdllOcdKuqMKBTUH1OapXWyRHECCcg/jUtFFapHK22FFFFAgooooAKKKKACiiigAooooAQjIqNhg1IaYwOalmtOXQbRS4PpSYpGwq/eFSVGv3hTzk9KaE2hw5NPAAqLBxQM+9NEuaRMehqMyMvTFHaigh1RRKxHakZziio5fuD60E88m9zK1GRvtZ6dBVMIHOD0q7dczn6VCi72woyawkrs9GnK0ERfZ09/zqaCBJJlRs4Pv7VILaZhkRmtGKIqVJXGBTjC5FSvZaMgGnwD+9+dXEjVUVRnAGKfiitlFI4ZVJS3YgGKWiimQFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFIRS0UAIRmm7Pen0UWK55DQuD1pwGKKKCW2wooooAKKKKACmuu5cZ706igEUZrMySbt+PwohsDFJu8wH8Ku7R6UtTyq9zV1pWsNRdoxmnUUVRkFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAFFFFAH//Z"
                                                                    class="avatar" alt="Sunil Kumar">
                                                            </div>
                                                            <div class="col">
                                                                <div class="text-truncate">
                                                                    <strong>
                                                                        <a
                                                                            href="http://127.0.0.1:8000/admin/system/users/profile/1">Sunil
                                                                            Kumar</a>
                                                                        <span
                                                                            class="badge bg-primary text-white">admin</span>
                                                                    </strong>

                                                                    logged in

                                                                    to the system

                                                                </div>
                                                                <div class="text-muted">
                                                                    18 seconds ago
                                                                    (<a href="https://ipinfo.io/127.0.0.1" target="_blank"
                                                                        title="127.0.0.1" rel="nofollow">127.0.0.1</a>)
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <img src="data:image/jpeg;base64,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"
                                                                    class="avatar" alt="Sunil Kumar">
                                                            </div>
                                                            <div class="col">
                                                                <div class="text-truncate">
                                                                    <strong>
                                                                        <a
                                                                            href="http://127.0.0.1:8000/admin/system/users/profile/1">Sunil
                                                                            Kumar</a>
                                                                        <span
                                                                            class="badge bg-primary text-white">admin</span>
                                                                    </strong>

                                                                    logged in

                                                                    to the customer portal

                                                                </div>
                                                                <div class="text-muted">
                                                                    55 minutes ago
                                                                    (<a href="https://ipinfo.io/::1" target="_blank"
                                                                        title="::1" rel="nofollow">::1</a>)
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <img src="data:image/jpeg;base64,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"
                                                                    class="avatar" alt="Sunil Kumar">
                                                            </div>
                                                            <div class="col">
                                                                <div class="text-truncate">
                                                                    <strong>
                                                                        <a
                                                                            href="http://127.0.0.1:8000/admin/system/users/profile/1">Sunil
                                                                            Kumar</a>
                                                                        <span
                                                                            class="badge bg-primary text-white">admin</span>
                                                                    </strong>

                                                                    logged in

                                                                    to the system

                                                                </div>
                                                                <div class="text-muted">
                                                                    55 minutes ago
                                                                    (<a href="https://ipinfo.io/::1" target="_blank"
                                                                        title="::1" rel="nofollow">::1</a>)
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <img src="data:image/jpeg;base64,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"
                                                                    class="avatar" alt="Sunil Kumar">
                                                            </div>
                                                            <div class="col">
                                                                <div class="text-truncate">
                                                                    <strong>
                                                                        <a
                                                                            href="http://127.0.0.1:8000/admin/system/users/profile/1">Sunil
                                                                            Kumar</a>
                                                                        <span
                                                                            class="badge bg-primary text-white">admin</span>
                                                                    </strong>

                                                                    logged in

                                                                    to the customer portal

                                                                </div>
                                                                <div class="text-muted">
                                                                    1 hour ago
                                                                    (<a href="https://ipinfo.io/::1" target="_blank"
                                                                        title="::1" rel="nofollow">::1</a>)
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <img src="data:image/jpeg;base64,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"
                                                                    class="avatar" alt="Sunil Kumar">
                                                            </div>
                                                            <div class="col">
                                                                <div class="text-truncate">
                                                                    <strong>
                                                                        <a
                                                                            href="http://127.0.0.1:8000/admin/system/users/profile/1">Sunil
                                                                            Kumar</a>
                                                                        <span
                                                                            class="badge bg-primary text-white">admin</span>
                                                                    </strong>

                                                                    logged in

                                                                    to the system

                                                                </div>
                                                                <div class="text-muted">
                                                                    1 hour ago
                                                                    (<a href="https://ipinfo.io/::1" target="_blank"
                                                                        title="::1" rel="nofollow">::1</a>)
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <img src="data:image/jpeg;base64,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"
                                                                    class="avatar" alt="Sunil Kumar">
                                                            </div>
                                                            <div class="col">
                                                                <div class="text-truncate">
                                                                    <strong>
                                                                        <a
                                                                            href="http://127.0.0.1:8000/admin/system/users/profile/1">Sunil
                                                                            Kumar</a>
                                                                        <span
                                                                            class="badge bg-primary text-white">admin</span>
                                                                    </strong>

                                                                    logged in

                                                                    to the customer portal

                                                                </div>
                                                                <div class="text-muted">
                                                                    1 hour ago
                                                                    (<a href="https://ipinfo.io/::1" target="_blank"
                                                                        title="::1" rel="nofollow">::1</a>)
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <img src="data:image/jpeg;base64,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"
                                                                    class="avatar" alt="Sunil Kumar">
                                                            </div>
                                                            <div class="col">
                                                                <div class="text-truncate">
                                                                    <strong>
                                                                        <a
                                                                            href="http://127.0.0.1:8000/admin/system/users/profile/1">Sunil
                                                                            Kumar</a>
                                                                        <span
                                                                            class="badge bg-primary text-white">admin</span>
                                                                    </strong>

                                                                    logged in

                                                                    to the system

                                                                </div>
                                                                <div class="text-muted">
                                                                    1 hour ago
                                                                    (<a href="https://ipinfo.io/::1" target="_blank"
                                                                        title="::1" rel="nofollow">::1</a>)
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <img src="data:image/jpeg;base64,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"
                                                                    class="avatar" alt="Sunil Kumar">
                                                            </div>
                                                            <div class="col">
                                                                <div class="text-truncate">
                                                                    <strong>
                                                                        <a
                                                                            href="http://127.0.0.1:8000/admin/system/users/profile/1">Sunil
                                                                            Kumar</a>
                                                                        <span
                                                                            class="badge bg-primary text-white">admin</span>
                                                                    </strong>

                                                                    logged in

                                                                    to the system

                                                                </div>
                                                                <div class="text-muted">
                                                                    16 hours ago
                                                                    (<a href="https://ipinfo.io/::1" target="_blank"
                                                                        title="::1" rel="nofollow">::1</a>)
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <img src="data:image/jpeg;base64,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"
                                                                    class="avatar" alt="Sunil Kumar">
                                                            </div>
                                                            <div class="col">
                                                                <div class="text-truncate">
                                                                    <strong>
                                                                        <a
                                                                            href="http://127.0.0.1:8000/admin/system/users/profile/1">Sunil
                                                                            Kumar</a>
                                                                        <span
                                                                            class="badge bg-primary text-white">admin</span>
                                                                    </strong>

                                                                    logged in

                                                                    to the customer portal

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection
