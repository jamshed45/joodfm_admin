@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('css')
@endsection
@section('body')

    <body data-sidebar="dark">
    @endsection
    @section('content')
        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Dashboard</h6>
                    <ol class="breadcrumb m-0">
                        {{-- <li class="breadcrumb-item active">Welcome to {{ get_site_name() }} Dashboard </li> --}}
                    </ol>
                </div>

            </div>

            <div class="row">

                <div class="col-xl-6 col-md-6 py-4">
                    <div class="card mini-stat bg-primary xen-bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-start mini-stat-img me-4">
                                    <img src="{{ asset('assets/images/services-icon/internals.png') }}" alt="">
                                </div>
                                <h5 class="font-size-16 text-uppercase text-white-50">Client Logos</h5>
                                <h4 class="fw-medium font-size-24">{{ $client_logos }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-6 py-4">
                    <div class="card mini-stat bg-primary xen-bg-primary text-white">
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="float-start mini-stat-img me-4">
                                    <img src="{{ asset('assets/images/services-icon/internals.png') }}" alt="">
                                </div>
                                <h5 class="font-size-16 text-uppercase text-white-50">Projects</h5>
                                <h4 class="fw-medium font-size-24">{{ $projects }}</h4>
                            </div>
                        </div>
                    </div>
                </div>


            </div>






        </div>
        <!-- end page title -->

        <style>
            .mini-stat {
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .card-body {
                flex: 1;
            }
        </style>













        <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    @endsection
