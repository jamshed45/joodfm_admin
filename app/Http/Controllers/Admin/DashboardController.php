<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\{ClientLogo, User, Organization, OrganizationEmployee,Invitation, Inventory, Project, Request  };

class DashboardController extends Controller
{
    public function index()
    {
        $client_logos = ClientLogo::count();
        $projects = Project::count();
        return view('admin.dashboard.index', compact('client_logos', 'projects'));
    }

}
