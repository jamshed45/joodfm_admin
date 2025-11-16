<?php

// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use App\Models\Organization;

class ProfileController extends Controller
{

    protected $folderPath = 'uploads/profiles';

    public function edit()
    {

        $user = Auth::user();
        $userRole = auth()->user()->getRoleNames()->first();

        if($userRole  == 'organization')
            {
                $record = Organization::findOrFail($user->organization->id);

                return view('profile-edit', compact('user','record'));
            }
            else
            {
                return view('profile-edit', compact('user'));
            }

    }

    public function update(Request $request)
    {

        $user = Auth::user();

        $validatedData = $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'profile_image' => ['nullable', 'image', 'max:2048'],
        ]);

        $user->name = $validatedData['user_name'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $profileImage = $user->profile_image;

if ($request->hasFile('profile_image')) {

    // Delete old image if exists
    if ($user->profile_image && file_exists(public_path($user->profile_image))) {
        unlink(public_path($user->profile_image));
    }

    $image    = $request->file('profile_image');
    $filename = Str::random(40) . '.' . $image->getClientOriginalExtension();

    // Move new image
    $image->move($this->folderPath, $filename);

    // Save new path
    $user->profile_image = $this->folderPath . '/' . $filename;
}



        $user->save();



        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
