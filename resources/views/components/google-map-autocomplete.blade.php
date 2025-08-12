<div class="mb-3">
    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
    <input type="hidden" name="lat" id="latitude" value="{{ old('lat', $lat ?? '') }}">
    <input type="hidden" name="long" id="longitude" value="{{ old('long', $long ?? '') }}">
    <input
    id="autocomplete"
    type="text"
    name="address"
    class="form-control"
    value="{{ old('address', $address ?? '') }}"
    onFocus="geolocate()"
    required
/>
    @error('address')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<script src="https://maps.googleapis.com/maps/api/js?key={{ $apiKey }}&libraries=places&callback=initAutocomplete"
    async defer></script>

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

        autocomplete.addListener("place_changed", () => {
            const place = autocomplete.getPlace();
            if (!place.geometry) {
                clearAddress();
                alert("Please select an address from the list.");
            } else {
                const lat = place.geometry.location.lat();
                const lng = place.geometry.location.lng();
                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lng;
                placeSelected = true;
            }
        });

        input.addEventListener("keydown", function (e) {
            if (e.key === "Enter") {
                e.preventDefault();
                setTimeout(() => {
                    const place = autocomplete.getPlace();
                    if (!place || !place.geometry) {
                        alert("Please select an address from the dropdown.");
                        clearAddress();
                    }
                }, 300);
            }
        });

        // input.addEventListener("blur", function () {
        //     setTimeout(() => {
        //         const place = autocomplete.getPlace();
        //         if (!place || !place.geometry) {
        //             alert("Please select an address from the dropdown.");
        //             clearAddress();
        //         }
        //     }, 300);
        // });

        geolocate(); // Bias the autocomplete
        getCurrentLocationAndFill(); // Pre-fill address
    }

    function clearAddress() {
        document.getElementById("autocomplete").value = "";
        document.getElementById("latitude").value = "";
        document.getElementById("longitude").value = "";
        placeSelected = false;
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

    function getCurrentLocationAndFill() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(async (position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                // Set lat/lng fields
                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lng;

                // Use reverse geocoding to get address
                const geocodeUrl = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key={{ $apiKey }}`;

                const response = await fetch(geocodeUrl);
                const data = await response.json();
                if (data.status === "OK" && data.results.length > 0) {
                    const formattedAddress = data.results[0].formatted_address;
                    document.getElementById("autocomplete").value = formattedAddress;
                    placeSelected = true;
                }
            }, (error) => {
                console.error("Geolocation error:", error);
            });
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        initAutocomplete();

        const form = document.querySelector("form");
        form.addEventListener("submit", function (e) {
            if (!placeSelected) {
                e.preventDefault();
                alert("Please select an address from the dropdown.");
            }
        });
    });
</script>

