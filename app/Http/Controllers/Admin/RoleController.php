<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\ModuleList;

class RoleController extends Controller
{
    protected $permission = 'role';

    protected $viewPath  = 'admin.roles';
    protected $routePath = 'roles';
    protected $title     = 'Roles';
    protected $singular  = "Role";
    protected $plural    = "Roles";

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
        $records = Role::with('permissions')->orderBy('created_at', 'desc')->get();


        return view("{$this->viewPath}.index", [
            'records'    => $records,
            'title'      => "All {$this->title}",
            'routePath'  => $this->routePath,
            'singular'   => $this->singular,
            'plural'     => $this->plural,
            'permission' => $this->permission,

        ]);
    }

    public function create()
    {
        $permissions = Permission::all();

        $modulesList = ModuleList::get();

        return view("{$this->viewPath}.create", [
            'permissions' => $permissions,
            'modulesList' => $modulesList,
            'title'       => "Create {$this->singular}",
            'routePath'   => $this->routePath,
            'singular'    => $this->singular,
            'plural'      => $this->plural,
            'permission' => $this->permission,

        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route("{$this->routePath}.index")->with('success', "{$this->title} created successfully.");
    }

    public function edit(Role $role)
    {
        $permissions     = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $modulesList = ModuleList::get();

        return view("{$this->viewPath}.edit", [
            'record'          => $role,
            'permissions'     => $permissions,
            'rolePermissions' => $rolePermissions,
            'modulesList' => $modulesList,
            'title'           => "Edit {$this->singular}",
            'routePath'       => $this->routePath,
            'singular'        => $this->singular,
            'plural'          => $this->plural,
            'permission' => $this->permission,

        ]);

    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'        => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array',
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route("{$this->routePath}.index")->with('success', "{$this->title} updated successfully.");
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route("{$this->routePath}.index")->with('success', "{$this->title} deleted successfully.");
    }
}
