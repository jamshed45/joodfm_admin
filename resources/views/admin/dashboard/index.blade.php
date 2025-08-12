@extends('layouts.master')
@section('title') Dashboard @endsection
@section('css')

@endsection
@section('body') <body data-sidebar="dark"> @endsection
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
            <div class="col-md-4">

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










    <script src="{{URL::asset('assets/js/app.js')}}"></script>

    @endsection
