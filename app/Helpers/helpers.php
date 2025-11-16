<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

if (!function_exists('get_site_title')) {

    function get_site_name()
    {
        $user = Auth::user();

        if ($user) {
            $roles = $user->getRoleNames();
            $get_user_role = $roles->first();


            if ($get_user_role == 'Client') {
                $siteTitle = DB::table('settings')
                    ->where('user_id', $user->id)
                    ->where('key', 'site_title')
                    ->value('val');
            }
        }


        if (empty($siteTitle)) {
            $siteTitle = DB::table('settings')
                ->where(function ($query) {
                    $query->whereNull('user_id')->orWhere('user_id', '');
                })
                ->where('key', 'site_title')
                ->value('val');
        }


        return $siteTitle;
    }

}


if (!function_exists('get_login_site_title')) {

    function get_login_site_title()
    {
        $client = request()->route('client');

        if ($client) {

            $user = DB::table('users')->where('unique_login_url_name', $client)->first();
            $user = User::find($user->id);
            $roles = $user->getRoleNames();
            $get_user_role = $roles->first();


            if ($get_user_role == 'Client') {
                $siteTitle = DB::table('settings')
                    ->where('user_id', $user->id)
                    ->where('key', 'site_title')
                    ->value('val');
            }
        }


        if (empty($siteTitle)) {
            $siteTitle = DB::table('settings')
                ->where(function ($query) {
                    $query->whereNull('user_id')->orWhere('user_id', '');
                })
                ->where('key', 'site_title')
                ->value('val');
        }


        return $siteTitle;
    }

}


if (!function_exists('get_desktop_logo')) {

    function get_desktop_logo()
    {
        $user = Auth::user();
        $get_user_role = $user->getRoleNames()->first();

        $logoUrl = DB::table('settings')
            ->where(function ($query) use ($user, $get_user_role) {
                if ($get_user_role == 'Client') {
                    $query->where('user_id', $user->id);
                } else {

                    $query->whereNull('user_id')->orWhere('user_id', '');
                }
            })
            ->where('key', 'site_logo_desktop')
            ->value('val');

        if (!$logoUrl && $get_user_role == 'Client') {
            $logoUrl = DB::table('settings')
                ->whereNull('user_id')
                ->where('key', 'site_logo_desktop')
                ->value('val');
        }

        $getLogoUrl = asset('uploads/' . $logoUrl);
        $site_logo_desktop = $logoUrl
            ? '<img src="' . $getLogoUrl . '" alt="Site Logo" height="40">1'
            : '<img src="' . asset('default_logo.png') . '" alt="Default Site Logo" height="40">1'; // Fallback to a hardcoded default logo

        return $site_logo_desktop;
    }

}

if (!function_exists('get_mobile_logo')) {

    function get_mobile_logo()
    {
        $user = Auth::user();
        $roles = $user->getRoleNames();
        $get_user_role = $roles->first();

        if($get_user_role == 'Client')
        {
            $logoUrl = DB::table('settings')
            ->where('user_id', $user->id )
            ->where('key', 'site_logo_mobile')
            ->value('val');
        }
        else
        {
            $logoUrl = DB::table('settings')
            ->where(function ($query) {
                $query->whereNull('user_id')
                      ->orWhere('user_id', '');
            })
            ->where('key', 'site_logo_mobile')
            ->value('val');
        }


        if ($logoUrl) {
            $getLogoUrl = asset('storage/' . $logoUrl);

            $site_logo_mobile = '<img src="' . htmlspecialchars(asset('public/storage/' . $getLogoUrl), ENT_QUOTES, 'UTF-8') . '" alt="Site Logo" height="40">';
        } else {
            $site_logo_mobile = '';
        }

        return $site_logo_mobile;
    }

}


if (!function_exists('site_logo_icon')) {

    function site_logo_icon()
    {
        $client = request()->route('client');
        $logoUrl = '';
        if ($client) {

            $user = DB::table('users')->where('unique_login_url_name', $client)->first();

            if ($user) {
                $logoUrl = DB::table('settings')
                    ->where('user_id', $user->id)
                    ->where('key', 'site_logo_icon')
                    ->value('val');
            }
        }


        if (!$logoUrl) {
            $logoUrl = DB::table('settings')
                ->where(function ($query) {
                    $query->whereNull('user_id')->orWhere('user_id', '');
                })
                ->where('key', 'site_logo_icon')
                ->value('val');
        }


        $site_logo_icon = $logoUrl
            ? '<img src="' . $logoUrl . '" alt="Site Logo" height="35">'
            : '<img src="' . asset('default_logo_icon.png') . '" alt="Default Site Logo" height="35">'; // Fallback logo


        return  asset('storage/' . $logoUrl);

    }

}


if (!function_exists('favicon_face_logo')) {

    function favicon_face_logo()
    {
        $client = request()->route('client');
        $logoUrl = '';
        if ($client) {

            $user = DB::table('users')->where('unique_login_url_name', $client)->first();

            if ($user) {
                $logoUrl = DB::table('settings')
                    ->where('user_id', $user->id)
                    ->where('key', 'site_favicon')
                    ->value('val');
            }
        }


        if (!$logoUrl) {
            $logoUrl = DB::table('settings')
                ->where(function ($query) {
                    $query->whereNull('user_id')->orWhere('user_id', '');
                })
                ->where('key', 'site_favicon')
                ->value('val');
        }


        $site_logo_icon = $logoUrl
            ? '<img src="' . $logoUrl . '" alt="Site Logo" height="35">'
            : '<img src="' . asset('default_logo_icon.png') . '" alt="Default Site Logo" height="35">'; // Fallback logo


        return  asset('storage/' . $logoUrl);

    }

}


if (!function_exists('get_favicon_logo')) {

    function get_favicon_logo()
    {
        $user = Auth::user();
        $roles = $user->getRoleNames();
        $get_user_role = $roles->first();

        if($get_user_role == 'Client')
        {
            $logoUrl = DB::table('settings')
            ->where('user_id', $user->id )
            ->where('key', 'site_favicon')
            ->value('val');
        }
        else
        {
            $logoUrl = DB::table('settings')
            ->where(function ($query) {
                $query->whereNull('user_id')
                      ->orWhere('user_id', '');
            })
            ->where('key', 'site_favicon')
            ->value('val');
        }



        if ($logoUrl) {
            $site_favicon = '<link rel="shortcut icon" href="' . htmlspecialchars('public/storage/' . $logoUrl, ENT_QUOTES, 'UTF-8') . '" />';
        } else {
            $site_favicon = '';
        }

        return $site_favicon;
    }

}


if (!function_exists('get_user_profile_image')) {

    function get_user_profile_image($userId)
    {

        $profileImagePath = DB::table('users')
            ->where('id', $userId)
            ->value('profile_image');

        if ($profileImagePath) {

            $profileImageUrl = asset('storage/' . $profileImagePath);
            $userProfileImage = '<img class="rounded-circle header-profile-user" src="' . htmlspecialchars($profileImageUrl, ENT_QUOTES, 'UTF-8') . '" alt="User Profile" height="40">';
        } else {

            $userProfileImage = '<img class="rounded-circle header-profile-user" src="' . asset('assets/images/users/avatar-1.jpg') . '" alt="Default Profile" height="40">';
        }

        return $userProfileImage;
    }
}


if (!function_exists('get_records_per_page')) {

    function get_records_per_page()
    {

        $recordsPerPage = DB::table('settings')
            ->where('key', 'record_per_page')
            ->value('val'); // Ensure the column name is 'value'

        return is_numeric($recordsPerPage) ? (int) $recordsPerPage : 10;
    }
}


// Clients function starts


if (!function_exists('get_client_api_setting')) {

    function get_client_api_setting($userId)
    {
        $select = ['live_client_id', 'live_api_key', 'live_secret_key', 'sandbox_client_id', 'sandbox_api_key', 'sandbox_secret_key'];

        $result = DB::table('settings')
            ->where('user_id', $userId)
            ->whereIn('key', $select)
            ->pluck('val', 'key')
            ->toArray();

        return $result;
    }
}
// $settings = DB::table('settings')
// ->where('user_id', $userId)
// ->where(function ($query) {
//     $query->where('key', 'live_client_id')
//           ->where('val', 1)
//           ->orWhere('key', 'sandbox_client_id')
//           ->where('val', 1);
// })
// ->exists();

if (!function_exists('isApiTriggerEnabled')) {
    function isApiTriggerEnabled($userId)
    {

        // Fetch the settings for either live_client_id or sandbox_client_id where val is 1
        $isEnabled = DB::table('settings')
            ->where('user_id', $userId)
            ->where(function ($query) {
                $query->where(function($subQuery) {
                    $subQuery->where('key', 'live_client_id')
                             ->whereNotNull('val');
                })->orWhere(function($subQuery) {
                    $subQuery->where('key', 'sandbox_client_id')
                             ->whereNotNull('val');
                });
            })
            ->exists();


        return $isEnabled;
    }
}

if (!function_exists('isAPIModeEnabled')) {
    function isAPIModeEnabled($userId)
    {

        $liveClientIdEnabled = DB::table('settings')
        ->where('user_id', $userId)
        ->where('key', 'live_client_id')
        ->whereNotNull('val')
        ->exists();

        $sandboxClientIdEnabled = DB::table('settings')
            ->where('user_id', $userId)
            ->where('key', 'sandbox_client_id')
            ->whereNotNull('val')
            ->exists();


        return $liveClientIdEnabled && $sandboxClientIdEnabled;
    }
}


if (!function_exists('APIModeToggleStatus')) {
    function APIModeToggleStatus($userId)
    {
        // Check if 'live_client_id' has val = 1 and not null
        $liveClientIdEnabled = DB::table('settings')
            ->where('user_id', $userId)
            ->where('key', 'live_client_id')
            ->whereNotNull('val')
            ->exists();

        // Check if 'sandbox_client_id' has val = 1 and not null
        $sandboxClientIdEnabled = DB::table('settings')
            ->where('user_id', $userId)
            ->where('key', 'sandbox_client_id')
            ->whereNotNull('val')
            ->exists();

        // Determine the status based on the conditions
        if ($liveClientIdEnabled) {
            return 'live';
        } elseif ($sandboxClientIdEnabled) {
            return 'sandbox';
        }
    }
}


if (!function_exists('get_clients_filter')) {

    function get_clients_filter()
    {
        return \App\Models\User::whereHas('roles', function($query) {
                $query->where('name', 'Client');
            })
            ->whereDoesntHave('roles', function($query) {
                $query->where('name', 'Admin');
            })
            ->get(['id', 'name']);
    }
}


if (!function_exists('processAttributeItems')) {

    function processAttributeItems(array $attributes, array $files = [], array $existingItems = []): array
    {
        $items = [];

        foreach ($attributes as $index => $attributeData) {
            $name = $attributeData['attribute_name'] ?? null;
            if (! $name) {
                continue;
            }

            $code = $attributeData['code'] ?? Str::uuid()->toString();

            $existingItem = collect($existingItems)->firstWhere('code', $code);
            $oldImage = $existingItem['image'] ?? null;

            $item = [
                'code'   => $code,
                'name'   => $name,
                'qty'    => $attributeData['quantity'] ?? null,
                'amount' => $attributeData['amount'] ?? null,
                'image'  => $oldImage,
            ];

            if (isset($files[$index]['image']) && $files[$index]['image']->isValid()) {

                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }

                $filePath      = $files[$index]['image']->store('uploads/attributes', 'public');
                $item['image'] = $filePath;
            }

            $items[] = $item;
        }

        return $items;
    }
}


