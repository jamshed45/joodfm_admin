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
                    <div class="col-md-8 col-lg-6 col-xl-8">
                        <div class="card overflow-hidden">


                            <div class="card-body p-4">
                                <div>

                                    <h1>Thank You</h1>
                                    <hr>
                                    <p>
                                        You will have to go to any of the organizations for verification, please bring your
                                        ID with you as its required. Once Verified come back to this time and sign in, you
                                        will then be able to access our tools to assist you further. Thank you again.
                                    </p>

                                    <div id="map" class="map-container"></div>

                                </div>
                                <div class="container">
                                    @if ($filtered)
                                        <div class="bg-light mt-5 p-4 pt-0">
                                            <div class="row">
                                                @foreach ($filtered as $location)
                                                    <div class="col-md-6 mt-4">
                                                        <div class="card h-100 shadow-sm">
                                                            <div class="card-body d-flex flex-column">
                                                                <h5 class="card-title fw-bold">{{ $location['name'] }}</h5>
                                                                <p class="text-danger">{{ $location['distance_miles'] }}
                                                                    miles away
                                                                    from your location</p>
                                                                <hr>
                                                                <div class="mb-2">
                                                                    <span class="fw-semibold">Phone</span><br>
                                                                    {{ $location['phone'] }}
                                                                </div>
                                                                <div class="mb-2">
                                                                    <span class="fw-semibold">Address</span><br>
                                                                    {{ $location['address'] }}
                                                                </div>

                                                                <!-- Spacer pushes the button to the bottom -->
                                                                <div class="mt-auto">
                                                                    <a href="{{ $location['website'] }}" target="_blank"
                                                                        class="btn btn-primary w-100">
                                                                        View Location Website
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="row mt-3">
                                        <div class="col-md-12 p-3 text-center bg-light">
                                            No Organization NearBy
                                        </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script src="https://maps.googleapis.com/maps/api/js?key={{ $googleMapAPI }}"></script>

        <script>
            function initMap() {
                const pivot = {
                    lat: {{ $pivotLat }},
                    lng: {{ $pivotLng }}
                };

                const map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: pivot
                });

                // Pivot marker
                new google.maps.Marker({
                    position: pivot,
                    map: map,
                    label: 'P',
                    title: 'Verification Center'
                });

                const locations = @json(array_values($filtered));

                const infoWindow = new google.maps.InfoWindow();

                locations.forEach(loc => {
                    const marker = new google.maps.Marker({
                        position: {
                            lat: parseFloat(loc.latitude),
                            lng: parseFloat(loc.longitude)
                        },
                        map: map,
                        title: loc.name
                    });

                    marker.addListener('click', () => {
                        infoWindow.setContent(
                            `<strong>${loc.name}</strong><br>Lat: ${loc.latitude}<br>Lng: ${loc.longitude}`);
                        infoWindow.open(map, marker);
                    });
                });
            }

            window.onload = initMap;
        </script>


        <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    @endsection
