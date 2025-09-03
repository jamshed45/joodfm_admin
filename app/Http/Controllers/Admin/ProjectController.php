<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    protected $viewPath  = 'admin.projects';
    protected $routePath = 'projects';
    protected $title     = 'Project';

    public function index()
    {
        $records = Project::get();

        return view("{$this->viewPath}.index", [
            'records'   => $records,
            'title'     => "{$this->title}",
            'routePath' => $this->routePath,
        ]);
    }

    public function create()
    {
        return view("{$this->viewPath}.create", [
            'title'     => "{$this->title}",
            'routePath' => $this->routePath,
        ]);
    }

public function store(Request $request)
{
    $request->validate([
        'en_name'       => 'required|max:255',
        'ar_name'       => 'required|max:255',
        'en_location'   => 'required|max:255',
        'ar_location'   => 'required|max:255',
        'en_scope'      => 'required|string',
        'ar_scope'      => 'required|string',
        'en_objective'  => 'required|string',
        'ar_objective'  => 'required|string',
        'image'         => ($request->isMethod('post') ? 'required' : 'nullable') . '|image|mimes:jpeg,png,jpg,gif|max:512',
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $image     = $request->file('image');
        $filename  = Str::random(40) . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('uploads/projects', $filename, 'public');
    }

    Project::create([
        'en_name'       => $request->en_name,
        'ar_name'       => $request->ar_name,
        'en_location'   => $request->en_location,
        'ar_location'   => $request->ar_location,
        'en_scope'      => $request->en_scope,
        'ar_scope'      => $request->ar_scope,
        'en_objective'  => $request->en_objective,
        'ar_objective'  => $request->ar_objective,
        'image'         => $imagePath,
    ]);

    return redirect()->route("{$this->routePath}.index")
        ->with('success', "{$this->title} created successfully.");
}


    public function edit(string $id)
    {
        $record = Project::findOrFail($id);

        return view("{$this->viewPath}.edit", [
            'record'    => $record,
            'title'     => "{$this->title}",
            'routePath' => $this->routePath,
        ]);
    }

    public function show(Project $project)
    {
        return view("{$this->viewPath}.show", [
            'record'    => $project,
            'title'     => "{$this->title}",
            'routePath' => $this->routePath,
        ]);
    }

public function update(Request $request, Project $project)
{
    $request->validate([
        'en_name'       => 'required|max:255',
        'ar_name'       => 'required|max:255',
        'en_location'   => 'nullable|max:255',
        'ar_location'   => 'nullable|max:255',
        'en_scope'      => 'nullable|string',
        'ar_scope'      => 'nullable|string',
        'en_objective'  => 'nullable|string',
        'ar_objective'  => 'nullable|string',
        'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:512',
    ]);

    $imagePath = $project->image; // keep old image if no new one uploaded

    if ($request->hasFile('image')) {
        // Delete old file if exists
        if ($project->image && Storage::exists('public/' . $project->image)) {
            Storage::delete('public/' . $project->image);
        }

        // Upload new file
        $image     = $request->file('image');
        $filename  = Str::random(40) . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('uploads/projects', $filename, 'public');
    }

    $project->update([
        'en_name'       => $request->en_name,
        'ar_name'       => $request->ar_name,
        'en_location'   => $request->en_location,
        'ar_location'   => $request->ar_location,
        'en_scope'      => $request->en_scope,
        'ar_scope'      => $request->ar_scope,
        'en_objective'  => $request->en_objective,
        'ar_objective'  => $request->ar_objective,
        'image'         => $imagePath,
    ]);

    return redirect()->route("{$this->routePath}.index")
        ->with('success', "{$this->title} updated successfully.");
}


    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route("{$this->routePath}.index")
            ->with('success', "{$this->title} deleted successfully.");
    }
}
