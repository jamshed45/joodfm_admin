@extends('layouts.master-without-nav')
@section('title')
    Register
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="account-pages my-5 pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-6">
                        <div class="card overflow-hidden">


                            <div class="card-body p-4">
                                <div class="p-3">

                                    <h2>Recipient Registration</h2>
                                    <hr>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" class="mt-4" action="{{ route('recipient-registration.submit') }}" enctype="multipart/form-data">
                                        @csrf

                                        @include('partials.register-form')

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                    componentRestrictions: {
                        country: "us"
                    },
                    fields: ["formatted_address", "geometry"]
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
                        // Delay to wait for place_changed
                        setTimeout(() => {
                            if (!placeSelected) {
                                alert("Please select an address from the dropdown.");
                                input.value = "";
                            }
                        }, 200);
                    }
                });

                // Detect focus out (blur)
                input.addEventListener("blur", function() {
                    setTimeout(() => {
                        if (!placeSelected && input.value.trim() !== "") {
                            alert("Please select an address from the dropdown.");
                            input.value = "";
                        }
                    }, 200);
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
