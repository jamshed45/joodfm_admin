<?php
namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Organization;
use App\Models\OrganizationEmployee;
use App\Models\Setting;
use App\Models\XenUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegistrationController extends Controller
{
    public function showForm(Request $request)
    {
        $googleMapAPI = Setting::where('key', 'google_map_api')
            ->value('val');

        $token = $request->query('token');

        if (! $token) {
            return abort(403, 'Invalid URL.');
        }

        $tokenData = Invitation::where('token', $token)->first();

        // echo "<pre>";
        // print_r($tokenData);
        // echo "</pre>";
        // die();
        if ($tokenData->role === 'internal') {

            if (! $tokenData || $tokenData->is_used) {
                return abort(403, 'Invalid or already used token.');
            }

            if (Carbon::parse($tokenData->expires_at)->isPast()) {
                return abort(403, 'Token has expired.');
            }

        }

        return view('auth.register', ['token' => $token, 'tokenData' => $tokenData, 'googleMapAPI' => $googleMapAPI]);
    }

    public function submitForm(Request $request)
    {
        $tokenData = Invitation::where('token', $request->token)->where('is_used', false)->first();

        if (! $tokenData) {
            return redirect()->back()->withErrors(['token' => 'Token is invalid or already used.']);
        }

        // echo "<pre>";
        // print_r($request->all());
        // print_r($tokenData);
        // echo "</pre>";

        // echo $tokenData->organization_id;

        if ($tokenData->role == 'internal') {

            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'email'      => 'required|email|unique:users,email',
                'password'   => 'required|string|min:6|confirmed',
            ]);

            $user = User::create([
                'name'     => $request->first_name . ' ' . $request->last_name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole($tokenData->role);

            $tokenData->is_used = true;
            $tokenData->save();

            OrganizationEmployee::create([
                'user_id'         => $user->id,
                'organization_id' => $tokenData->organization_id,
                'first_name'      => $request->first_name,
                'middle_name'     => $request->middle_name,
                'last_name'       => $request->middle_name,
                'phone'           => $request->phone,
            ]);

            // Optionally log the user in



            Auth::login($user);

            return redirect()->route('index')->with('success', 'Registration successful!');

        } else {

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

            $stateIdImage_1 = '';
            $stateIdImage_2 = '';

            if ($request->hasFile('image_1')) {
                $image_1        = $request->file('image_1');
                $filename_1     = time() . '_' . $image_1->getClientOriginalName();
                $stateIdImage_1 = $image_1->storeAs('uploads/state_id', $filename_1, 'public');
            }

            if ($request->hasFile('image_2')) {
                $image_2        = $request->file('image_2');
                $filename_2     = time() . '_' . $image_2->getClientOriginalName();
                $stateIdImage_2 = $image_2->storeAs('uploads/state_id', $filename_2, 'public');
            }

            $user = User::create([
                'name'     => $request->first_name . ' ' . $request->last_name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole($tokenData->role);

            XenUser::firstOrCreate(
                ['user_id' => $user->id],
                [
                'organization_id'      => $tokenData->organization_id,
                'first_name'           => $request->first_name,
                'middle_name'          => $request->middle_name,
                'last_name'            => $request->last_name,
                'phone'                => $request->phone,
                'address'              => $request->address,
                'lat'                  => $request->lat,
                'long'                 => $request->long,
                'dob'                  => $request->dob,
                'state_id'             => $request->state_id,
                'state_id_image_1'     => $stateIdImage_1,
                'state_id_image_2'     => $stateIdImage_2,
                ]
            );

            $arr = array(
                'user_id' => $user->id,
                'organization_id'      => $tokenData->organization_id,
                'first_name'           => $request->first_name,
                'middle_name'          => $request->middle_name,
                'last_name'            => $request->last_name,
                'phone'                => $request->phone,
                'address'              => $request->address,
                'lat'                  => $request->lat,
                'long'                 => $request->long,
                'dob'                  => $request->dob,
                'state_id'             => $request->state_id,
                'state_id_image_1'     => $stateIdImage_1,
                'state_id_image_2'     => $stateIdImage_2,
            );

            session([
                'pivot_lat' => $request->lat,
                'pivot_lng' => $request->long,
            ]);

            return redirect()->route('registration.thankyou');

        }

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
