<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClientLogoController extends Controller
{
    protected $viewPath   = 'admin.logos';
    protected $routePath  = 'client-logos';
    protected $title      = 'Logo';
    protected $folderPath = 'uploads/logos';

    public function index()
    {
        $records = ClientLogo::all();

        return view("{$this->viewPath}.index", [
            'records' => $records,
            'title'   => "{$this->title}",
            'routePath'  => $this->routePath,
            'folderPath' => $this->folderPath,

        ]);
    }

    public function create()
    {
        return view("{$this->viewPath}.create", [
            'title' => "{$this->title}",
            'routePath' => $this->routePath,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = '';

        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $filename  = time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
            $image->move($this->folderPath, $filename);
        }

        ClientLogo::create([
            'name'  => $request->name,
            'image' => $filename,
        ]);

        return redirect()->route("{$this->routePath}.index")->with('success', "{$this->title} created successfully.");
    }

    public function edit(string $id)
    {
        $record = ClientLogo::findOrFail($id);

        return view("{$this->viewPath}.edit", [
            'record' => $record,
            'title'  => "{$this->title}",
            'routePath'  => $this->routePath,
            'folderPath' => $this->folderPath,
        ]);
    }

    public function show(ClientLogo $clientLogo)
    {
        return $clientLogo;
    }

    public function update(Request $request, ClientLogo $clientLogo)
    {
        $filename = $clientLogo->image ?? '';

        if ($request->hasFile('image')) {

            if (! empty($clientLogo->image) && file_exists(public_path($this->folderPath . '/' . $clientLogo->image))) {
                unlink(public_path($this->folderPath . '/' . $clientLogo->image));
            }

            $image    = $request->file('image');
            $filename = time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($this->folderPath), $filename);
        }

        $clientLogo->update([
            'name'  => $request->name,
            'image' => $filename,
        ]);

        return redirect()->route("{$this->routePath}.index")->with('success', "{$this->title} updated successfully.");
    }

    public function destroy(ClientLogo $clientLogo)
    {

        if ($clientLogo->logo) {
            Storage::disk('public')->delete($clientLogo->logo);
        }

        $clientLogo->delete();

        return redirect()
            ->route("{$this->routePath}.index")
            ->with('success', "{$this->title} deleted successfully.");
    }
}
