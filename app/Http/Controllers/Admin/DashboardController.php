<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\{ User, Organization, OrganizationEmployee,Invitation, Inventory, Request  };

class DashboardController extends Controller
{
    public function index()
    {

        // $userRole = auth()->user()->getRoleNames()->first();
        // $user_id = auth()->id();
        // $user = User::findOrFail($user_id);

        // if($userRole == 'admin')
        // {
        //     $counts = [
        //         'organizations' => Organization::count(),
        //         'internals' => OrganizationEmployee::count(),
        //         'invitations' => Invitation::count(),
        //         'inventories' => Inventory::count(),
        //     ];
        // }
        // elseif($userRole == 'organization')
        // {
        //     $user->organization->id;
        //     $counts = [
        //         'internals' => OrganizationEmployee::where('organization_id', $user->organization->id)->count(),
        //         'invitations' => Invitation::where('organization_id', $user->organization->id)->count(),
        //         'inventories' => Inventory::where('organization_id', $user->organization->id)->count(),
        //     ];
        // }
        // elseif($userRole == 'subscriber')
        // {
        //     // $user->subcriber->id;
        //     // $counts = [
        //     //     'requests' => Organization::where('organization_id', $user->subcriber->id)->count(),
        //     //     'donation_history' => OrganizationEmployee::where('organization_id', $user->subcriber->id)->count(),
        //     // ];

        //     // $user->subcriber->id;
        //     $counts = [
        //         'requests' => 1,
        //         'donation_history' => 2,
        //     ];
        // }


        return view('admin.dashboard.index');
        //  return view('admin.dashboard.index', compact('counts', 'userRole'));

    }

}
