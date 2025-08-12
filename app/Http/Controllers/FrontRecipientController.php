<?php
namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Setting;
use App\Models\User;
use App\Models\XenUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FrontRecipientController extends Controller
{
    public function showForm(Request $request)
    {

        $googleMapAPI = Setting::where('key', 'google_map_api')
            ->value('val');

        return view('auth.recipient-register', compact('googleMapAPI'));
    }

    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'required|string|max:20',
            'address'    => 'required|string',
            'password'   => 'required|string|min:6|confirmed',
            'dob'        => 'required|date|before:today',
        ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $stateIdFrontImage = '';
        $stateIdBackImage  = '';

        if ($request->hasFile('image_front')) {
            $image             = $request->file('image_front');
            $filename          = time() . '_' . $image->getClientOriginalName();
            $stateIdFrontImage = $image->storeAs('uploads/state_id', $filename, 'public');
        }

        if ($request->hasFile('image_back')) {
            $image            = $request->file('image_back');
            $filename         = time() . '_' . $image->getClientOriginalName();
            $stateIdBackImage = $image->storeAs('uploads/state_id', $filename, 'public');
        }

        $user = User::create([
            'name'     => $request->first_name . ' ' . $request->last_name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('recipient');

        XenUser::create([
            'user_id'              => $user->id,
            'first_name'           => $request->first_name,
            'middle_name'          => $request->middle_name,
            'last_name'            => $request->last_name,
            'phone'                => $request->phone,
            'address'              => $request->address,
            'lat'                  => $request->lat,
            'long'                 => $request->long,
            'dob'                  => $request->dob,
            'state_id'             => $request->state_id,
            'state_id_image_1' => $stateIdFrontImage,
            'state_id_image_2'  => $stateIdBackImage,
        ]);

        session([
            'pivot_lat' => $request->lat,
            'pivot_lng' => $request->long,
        ]);

        return redirect()->route('recipient-registration.thankyou');

    }

    public function thankYou()
    {
        $googleMapAPI    = Setting::where('key', 'google_map_api')->value('val');
        $googleMapRadius = Setting::where('key', 'google_map_radius')->value('val');

        $pivotLat = session('pivot_lat', 33.6844);
        $pivotLng = session('pivot_lng', 73.0479);

        $radius = $googleMapRadius;

        $allLocations = Organization::select('name', 'address', 'lat as latitude', 'long as longitude', 'phone', 'website')->get()->toArray();

        // First filter based on distance
        $filtered = array_filter($allLocations, function ($loc) use ($pivotLat, $pivotLng, $radius) {
            $earthRadiusKm = 6371;

            $distanceKm = $earthRadiusKm * acos(
                cos(deg2rad($pivotLat)) *
                cos(deg2rad($loc['latitude'])) *
                cos(deg2rad($loc['longitude']) - deg2rad($pivotLng)) +
                sin(deg2rad($pivotLat)) *
                sin(deg2rad($loc['latitude']))
            );

            return $distanceKm <= $radius;
        });

        // Then map over filtered to add distance_km and distance_miles
        $filtered = array_map(function ($loc) use ($pivotLat, $pivotLng) {
            $earthRadiusKm = 6371;

            $distanceKm = $earthRadiusKm * acos(
                cos(deg2rad($pivotLat)) *
                cos(deg2rad($loc['latitude'])) *
                cos(deg2rad($loc['longitude']) - deg2rad($pivotLng)) +
                sin(deg2rad($pivotLat)) *
                sin(deg2rad($loc['latitude']))
            );

            $loc['distance_km']    = round($distanceKm, 2);
            $loc['distance_miles'] = round($distanceKm * 0.621371, 2);

            return $loc;
        }, array_values($filtered)); // array_values to reset keys

        return view('auth.thank-you', compact('pivotLat', 'pivotLng', 'filtered', 'googleMapAPI', 'allLocations'));
    }

}
