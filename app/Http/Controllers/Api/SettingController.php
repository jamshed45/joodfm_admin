<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Resources\SettingResource;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();

        $keyed = $settings->pluck(null, 'key')->map(function ($setting) {
            if ($setting['url'] == 1 && !empty($setting['val'])) {
                return asset('storage/' . $setting['val']);
            }

            return $setting['val'];
        });

        return response()->json($keyed);
    }
}





