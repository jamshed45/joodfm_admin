<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function storageLink()
    {
        // Optional security check
        if (!auth()->check() && !app()->environment('local')) {
            abort(403, 'Unauthorized');
        }

        // Run the storage:link command
        Artisan::call('storage:link');

        // Get Artisan output (optional)
        $output = Artisan::output();

        return response()->json([
            'message' => 'Storage linked successfully!',
            'output' => $output
        ]);
    }
}
