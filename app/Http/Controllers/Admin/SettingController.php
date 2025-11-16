<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    protected $folderPath = 'uploads/settings';

    function index()
    {
        return view('setting.index');
    }

    function siteSetting()
    {
        $settings = Setting::whereNull('user_id')
            ->where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', '');
            })
            ->pluck('val', 'key')
            ->toArray();

        return view('setting.site-settting', [
            'settings'   => $settings,
            'folderPath' => $this->folderPath,
        ]);
    }

    function social_media_setting()
    {
        $settings = Setting::whereNull('user_id')
            ->where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', '');
            })
            ->pluck('val', 'key')
            ->toArray();

        return view('setting.social-media-settting', compact('settings'));
    }





    public function update(Request $request)
    {
$settings = $request->except(['_token', '_method', 'site_logo', 'site_favicon', 'site_general_setting', 'site_logo_desktop', 'site_logo_mobile', 'site_logo_icon']);

        if(isset($request->site_general_setting))
        {


if ($request->hasFile('site_logo_desktop')) {
    $site_logo_setting = Setting::where('key', 'site_logo_desktop')->first();

    if (!empty($site_logo_setting->val) && file_exists(public_path($this->folderPath . '/' . basename($site_logo_setting->val)))) {
        unlink(public_path($this->folderPath . '/' . basename($site_logo_setting->val)));
    }

    $image = $request->file('site_logo_desktop');
    $filename = time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
    $image->move(public_path($this->folderPath), $filename);

    Setting::updateOrCreate(
        ['user_id' => null, 'key' => 'site_logo_desktop'],
        ['val' => $this->folderPath . '/' . $filename]
    );
}

if ($request->hasFile('site_logo_mobile')) {
    $site_logo_setting = Setting::where('key', 'site_logo_mobile')->first();

    if (!empty($site_logo_setting->val) && file_exists(public_path($this->folderPath . '/' . basename($site_logo_setting->val)))) {
        unlink(public_path($this->folderPath . '/' . basename($site_logo_setting->val)));
    }

    $image = $request->file('site_logo_mobile');
    $filename = time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
    $image->move(public_path($this->folderPath), $filename);

    Setting::updateOrCreate(
        ['user_id' => null, 'key' => 'site_logo_mobile'],
        ['val' => $this->folderPath . '/' . $filename]
    );
}

if ($request->hasFile('site_logo_icon')) {
    $site_logo_icon_setting = Setting::where('key', 'site_logo_icon')->first();

    if (!empty($site_logo_icon_setting->val) && file_exists(public_path($this->folderPath . '/' . basename($site_logo_icon_setting->val)))) {
        unlink(public_path($this->folderPath . '/' . basename($site_logo_icon_setting->val)));
    }

    $image = $request->file('site_logo_icon');
    $filename = time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
    $image->move(public_path($this->folderPath), $filename);

    Setting::updateOrCreate(
        ['user_id' => null, 'key' => 'site_logo_icon'],
        ['val' => $this->folderPath . '/' . $filename]
    );
}

if ($request->hasFile('site_favicon')) {
    $site_favicon_setting = Setting::where('key', 'site_favicon')->first();

    if (!empty($site_favicon_setting->val) && file_exists(public_path($this->folderPath . '/' . basename($site_favicon_setting->val)))) {
        unlink(public_path($this->folderPath . '/' . basename($site_favicon_setting->val)));
    }

    $image = $request->file('site_favicon');
    $filename = time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
    $image->move(public_path($this->folderPath), $filename);

    Setting::updateOrCreate(
        ['user_id' => null, 'key' => 'site_favicon'],
        ['val' => $this->folderPath . '/' . $filename]
    );
}

            foreach ($settings as $key => $value) {
                    Setting::updateOrCreate(['key' => $key], ['val' => $value]);
                }



        }
        if(isset($request->google_map_setting))
        {
            $settings = $request->except(['_token', '_method', 'google_map_setting']);

            foreach ($settings as $key => $value) {
                Setting::updateOrCreate(['key' => $key], ['val' => $value]);
            }


        }
        if(isset($request->donation_setting))
        {
            $settings = $request->except(['_token', '_method', 'donation_setting']);

            foreach ($settings as $key => $value) {
                Setting::updateOrCreate(['key' => $key], ['val' => $value]);
            }
        }

        foreach ($settings as $key => $value) {
                Setting::updateOrCreate(['key' => $key], ['val' => $value]);
            }




        return redirect()->back()->with('success', 'Settings updated successfully.');
    }




}
