<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\ModuleList;

class PermissionController extends Controller
{
    protected $permission = 'permission';

    protected $viewPath  = 'admin.permissions';
    protected $routePath = 'permissions';
    protected $title     = 'Permissions';
    protected $singular  = "Permission";
    protected $plural    = "Permissions";

    public function __construct()
    {
        $actions = [
            'access' => ['index'],
            'create' => ['create', 'store'],
            'edit'   => ['edit', 'update'],
            'view'   => ['show'],
            'delete' => ['destroy'],
        ];

        foreach ($actions as $action => $methods) {
            $this->middleware(['auth', 'permission:' . $action . ' ' . $this->permission])->only($methods);
        }
    }

    public function index()
    {
        $records = Permission::orderBy('created_at', 'desc')->get();

        $modulesList = ModuleList::get();

        return view("{$this->viewPath}.index", [
            'records'    => $records,
            'modulesList' => $modulesList,
            'title'      => "All {$this->title}",
            'routePath'  => $this->routePath,
            'singular'   => $this->singular,
            'plural'     => $this->plural,
            'permission' => $this->permission,

        ]);
    }

    // public function create()
    // {

    //     return view("{$this->viewPath}.create", [
    //         'title'     => "Create {$this->singular}",
    //         'routePath' => $this->routePath,
    //         'singular'  => $this->singular,
    //         'plural'    => $this->plural,
    //         'permission' => $this->permission,

    //     ]);
    // }

    // public function store(Request $request)
    // {
    //     $request->validate(['name' => 'required|unique:permissions,name']);
    //     Permission::create(['name' => $request->name]);
    //     return redirect()->route("{$this->routePath}.index")->with('success', "{$this->title} created successfully.");
    // }

    // public function edit(Permission $permission)
    // {

    //     return view("{$this->viewPath}.edit", [
    //         'record'    => $permission,
    //         'title'     => "Edit {$this->singular}",
    //         'routePath' => $this->routePath,
    //         'singular'  => $this->singular,
    //         'plural'    => $this->plural,
    //         'permission' => $this->permission,

    //     ]);
    // }

    // public function update(Request $request, Permission $permission)
    // {
    //     $request->validate(['name' => 'required|unique:permissions,name,' . $permission->id]);
    //     $permission->update(['name' => $request->name]);

    //     return redirect()->route("{$this->routePath}.index")->with('success', "{$this->title} updated successfully.");
    // }

    // public function destroy(Permission $permission)
    // {
    //     $permission->delete();

    //     return redirect()->route("{$this->routePath}.index")->with('success', "{$this->title} updated successfully.");
    // }
}
