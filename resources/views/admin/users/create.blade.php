@extends('layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('css')
@endsection
@section('body')

    <body data-sidebar="dark">
    @endsection
    @section('content')
        @component('components.breadcrumb')
            @slot('page_title')
                {{ $title }}
            @endslot
            @slot('subtitle')
                <a href="{{ route($routePath . '.index') }}">{{ $plural }}</a>
            @endslot
        @endcomponent


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">{{ $singular }}</h4>
                        <p class="card-title-desc"></p>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route($routePath . '.store') }}" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label>Organization</label>
                                @if ($current_organization)
                                    <br>
                                    <b>{{ $current_organization->name }}</b>
                                    <input type="hidden" name="organization_id" value="{{ $current_organization->id }}" />
                                @else
                                    <select name="organization_id" class="form-control" required>
                                        <option value="">Select Organization</option>
                                        @foreach ($organizations as $org)
                                            <option value="{{ $org->id }}"
                                                {{ old('organization_id') == $org->id ? 'selected' : '' }}>
                                                {{ $org->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{ old('first_name', $recipient->first_name ?? '') }}" required>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label>Middle Name</label>
                                    <input type="text" name="middle_name" class="form-control"
                                        value="{{ old('name', $recipient->middle_name ?? '') }}">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control"
                                        value="{{ old('last_name', $recipient->last_name ?? '') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $recipient->email ?? '') }}" required>
                            </div>

                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $recipient->phone ?? '') }}" required>
                            </div>

                            <div class="mb-3">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" class="form-control"
                                    value="{{ old('dob', $recipient->dob ?? '') }}" required>
                            </div>

                            {{-- <div class="mb-3">
                                <label>Address</label>
                                <input type="hidden" name="lat" id="latitude"
                                    value="{{ old('lat', $recipient->lat ?? '') }}">
                                <input type="hidden" name="long" id="longitude"
                                    value="{{ old('long', $recipient->long ?? '') }}">

                                <input id="autocomplete" type="text" name="address" class="form-control"
                                    value="{{ old('address', $recipient->address ?? '') }}" onFocus="geolocate()" />
                            </div> --}}
                            <x-google-map-autocomplete :api-key="$googleMapAPI" :address="null" :lat="null"
                                :long="null" />


                            <hr>
                            <div class="mb-3">
                                <label>Select Role</label><br>
                                @foreach ($roles as $role)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="roles[]"
                                            value="{{ $role->name }}" id="role_{{ $role->id }}"
                                            {{ is_array(old('roles')) && in_array($role->name, old('roles')) ? 'checked' : '' }}>

                                        <label class="form-check-label"
                                            for="role_{{ $role->id }}">{{ ucfirst($role->name) }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input type="text" name="password_confirmation" class="form-control" required>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label>State ID</label>
                                <input type="text" name="state_id" class="form-control"
                                    value="{{ old('state_id', $recipient->state_id ?? '') }}" required>
                            </div>
                             <div class="mb-3">
                                <label>State ID Front Image</label>
                                <input type="file" name="image_1" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>State ID Back Image</label>
                                <input type="file" name="image_2" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    @endsection

    @section('scripts')
        <script src="https://maps.googleapis.com/maps/api/js?key={{ $googleMapAPI }}&libraries=places"></script>


        <script>
            let autocomplete;
            let placeSelected = false;

            function initAutocomplete() {
                const input = document.getElementById("autocomplete");

                autocomplete = new google.maps.places.Autocomplete(input, {
                    types: ["geocode"],
                    fields: ["formatted_address", "geometry"],
                    componentRestrictions: { country: "us" }
                });

                // When a place is selected from the dropdown
                autocomplete.addListener("place_changed", () => {
                    const place = autocomplete.getPlace();
                    if (!place.geometry) {
                        input.value = "";
                        document.getElementById("latitude").value = "";
                        document.getElementById("longitude").value = "";
                        placeSelected = false;
                        alert("Please select an address from the list.");
                    } else {
                        const lat = place.geometry.location.lat();
                        const lng = place.geometry.location.lng();
                        document.getElementById("latitude").value = lat;
                        document.getElementById("longitude").value = lng;
                        placeSelected = true;
                    }
                });

                // Detect Enter key press
                input.addEventListener("keydown", function(e) {
                    if (e.key === "Enter") {
                        e.preventDefault(); // prevent form submit
                        setTimeout(() => {
                            const place = autocomplete.getPlace();
                            if (!place || !place.geometry) {
                                alert("Please select an address from the dropdown.");
                                input.value = "";
                                document.getElementById("latitude").value = "";
                                document.getElementById("longitude").value = "";
                            }
                        }, 300);
                    }
                });

                // Detect focus out (blur)
                input.addEventListener("blur", function() {
                    setTimeout(() => {
                        const place = autocomplete.getPlace();
                        if (!place || !place.geometry) {
                            alert("Please select an address from the dropdown.");
                            input.value = "";
                            document.getElementById("latitude").value = "";
                            document.getElementById("longitude").value = "";
                        }
                    }, 300);
                });

                geolocate(); // Optional bias
            }

            function geolocate() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition((position) => {
                        const geolocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        const circle = new google.maps.Circle({
                            center: geolocation,
                            radius: position.coords.accuracy,
                        });
                        autocomplete.setBounds(circle.getBounds());
                    });
                }
            }

            document.addEventListener("DOMContentLoaded", function() {
                initAutocomplete();

                const form = document.querySelector("form");
                form.addEventListener("submit", function(e) {
                    if (!placeSelected) {
                        e.preventDefault();
                        alert("Please select an address from the dropdown.");
                    }
                });
            });
        </script>

        <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    @endsection
