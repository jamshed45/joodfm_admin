<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $viewPath  = 'admin.jobs';
    protected $routePath = 'jobs';
    protected $title     = 'Job';

    public function index()
    {
        $records = Job::get();
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
            'title'               => 'required|max:255',
            'description'         => 'nullable',
            'location'            => 'nullable|max:255',
            'department'          => 'nullable|max:255',
            'type'                => 'required|in:full-time,part-time,contract,internship',
            'vacancies'           => 'required|integer|min:1',
            'application_deadline'=> 'nullable|date',
            'active'              => 'boolean',
        ]);

        Job::create($request->all());

        return redirect()->route("{$this->routePath}.index")
            ->with('success', "{$this->title} created successfully.");
    }

    public function edit(string $id)
    {
        $record = Job::findOrFail($id);

        return view("{$this->viewPath}.edit", [
            'record'    => $record,
            'title'     => "{$this->title}",
            'routePath' => $this->routePath,
        ]);
    }

    public function show(Job $job)
    {
        return view("{$this->viewPath}.show", [
            'record'    => $job,
            'title'     => "{$this->title}",
            'routePath' => $this->routePath,
        ]);
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title'               => 'required|max:255',
            'description'         => 'nullable',
            'location'            => 'nullable|max:255',
            'department'          => 'nullable|max:255',
            'type'                => 'required|in:full-time,part-time,contract,internship',
            'vacancies'           => 'required|integer|min:1',
            'application_deadline'=> 'nullable|date',
            'active'              => 'boolean',
        ]);

        $job->update($request->all());

        return redirect()->route("{$this->routePath}.index")
            ->with('success', "{$this->title} updated successfully.");
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route("{$this->routePath}.index")
            ->with('success', "{$this->title} deleted successfully.");
    }
}
