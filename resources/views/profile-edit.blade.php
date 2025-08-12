@extends('layouts.master')
@section('title') Profile @endsection
@section('css')
<link href="{{URL::asset('assets/libs/magnific-popup/magnific-popup.min.css')}}" rel="stylesheet">
@endsection
@section('body') <body data-sidebar="dark"> @endsection
    @section('content')
    @component('components.breadcrumb')
    @slot('page_title') Profile @endslot
    @slot('subtitle') Edit Profile @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-3">
            <div class="user-sidebar">
                <div class="card">
                    <div class="card-body pt-5">

                        @php

                            $roles = $user->roles->pluck('name');

                        @endphp

                        <div class="mt-n4 position-relative">
                            <div class="text-center">


                                @if(Auth::user()->profile_image)
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="" class="avatar-xl rounded-circle img-thumbnail">
                                @else
                                    <img src="{{URL::asset('assets/images/users/avatar-1.jpg')}}" alt="" class="avatar-xl rounded-circle img-thumbnail">
                                @endif


                                <div class="mt-3">
                                    <h5 class="">{{ $user->name }}</h5>
                                    <div>
                                        <a href="#" class="text-muted m-1">{{ $roles[0] }}</a>
                                    </div>


                                </div>

                            </div>
                        </div>



                    </div> <!-- end card body -->
                </div> <!-- end card -->


            </div>
        </div>

        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">


                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(auth()->user()->hasRole('organization'))

                        <form method="POST" action="{{ route('organizations.update', $record->id) }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @php
                            print_r($record->organization);
                        @endphp
                        <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" name="organization_name" class="form-control" value="{{ old('organization_name', $record->name ?? '') }}" required>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="organization_email" name="organization_email" class="form-control" value="{{ old('organization_email', $record->email ?? '') }}" required>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="organization_phone" class="form-control" value="{{ old('organization_phone', $record->phone ?? '') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Address <span class="text-danger">*</span></label>
                                <input type="hidden" name="lat" id="latitude" value="{{ old('lat', $record->lat ?? '') }}">
                                <input type="hidden" name="long" id="longitude"  value="{{ old('long', $record->long ?? '') }}">
                                <input id="autocomplete" type="text" name="organization_address" class="form-control" value="{{ old('address', $record->address ?? '') }}" onFocus="geolocate()" required />
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label>Zip Code</label>
                                    <input type="text" name="organization_zipcode" class="form-control" value="{{ old('organization_zipcode', $record->zipcode ?? '') }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label>Website (https://xen-software.com)  <span class="text-danger">*</span></label>
                                    <input type="url" name="organization_website" class="form-control" value="{{ old('organization_website', $record->website ?? '') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Logo</label>
                                <input type="file" name="organization_image" class="form-control">

                                @if ($record->logo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $record->logo) }}" alt="Logo" width="200">
                                    </div>
                                @endif
                            </div>

                            <hr>
                            <h4 class="card-title mb-4">Contact Information</h4>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label>Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $record->user->name ?? '') }}" required>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $record->user->email ?? '') }}" readonly required>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label>Personal Contact # <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $record->contact_phone ?? '') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Profile Image</label>
                                <input type="file" name="profile_image" class="form-control">
                                @if ($record->user->profile_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $record->user->profile_image) }}" alt="Logo" width="200">
                                    </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label>Password  <span class="text-danger">*</span></label>
                                    <input type="text" name="password" class="form-control" >
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label>Confirm Password  <span class="text-danger">*</span></label>
                                    <input type="text" name="password_confirmation" class="form-control" >
                                </div>
                            </div>
                            <hr>



                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                    @else


                    <form  action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                    <div class="row">
                        <div class="mb-3 col-md-6" bis_skin_checked="1">
                            <label class="form-label" for="user_name">Name</label>
                            <div bis_skin_checked="1">
                                <input type="text" class="form-control" name="user_name" id="user_name" value="{{ old('user_name', $user->name ?? '') }}" required>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6" bis_skin_checked="1">
                            <label class="form-label" for="admin_email">Email</label>
                            <div bis_skin_checked="1">
                                <input type="text" class="form-control" name="admin_email" id="admin_email" value="{{ old('admin_email', $user->email ?? '') }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6" bis_skin_checked="1">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="mb-3 col-md-6" bis_skin_checked="1">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>

                    <div class="mb-3" bis_skin_checked="1">
                        <label class="form-label" for="profile_image">Profile Image</label>
                        <input type="file" class="form-control" name="profile_image" id="profile_image" value="" >
                        {{-- {{ old('profile_image', $settings['profile_image'] ?? '') }} --}}
                    </div>


                    <div class="col-12" bis_skin_checked="1">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>

                    </form>

                    @endif

                </div>
            </div>






        </div>
    </div>
    <!--end row-->

    @endsection
    @section('scripts')

    <!-- Tour init js-->
    <script src="{{URL::asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/pages/profile.init.js')}}"></script>

    <script src="{{URL::asset('assets/js/app.js')}}"></script>

    @endsection
