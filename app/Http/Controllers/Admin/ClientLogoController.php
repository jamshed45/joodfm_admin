<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClientLogoController extends Controller
{
    protected $viewPath  = 'admin.logos';
    protected $routePath = 'client-logos';
    protected $title     = 'Logo';

    public function index()
    {
        $records = ClientLogo::all();

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
            'name'  => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = '';

        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $filename  = time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('uploads/logos', $filename, 'public');
        }

        ClientLogo::create([
            'name'  => $request->name,
            'image' => $imagePath,
        ]);

        return redirect()->route("{$this->routePath}.index")->with('success', "{$this->title} created successfully.");
    }

    public function edit(string $id)
    {
        $record = ClientLogo::findOrFail($id);

        return view("{$this->viewPath}.edit", [
            'record'    => $record,
            'title'     => "{$this->title}",
            'routePath' => $this->routePath,
        ]);
    }

    public function show(ClientLogo $clientLogo)
    {
        return $clientLogo;
    }

    public function update(Request $request, ClientLogo $clientLogo)
    {
        $imagePath = $clientLogo->image ?? '';

        if ($request->hasFile('image')) {
            if ($request->image && Storage::exists('public/' . $request->image)) {
                Storage::delete('public/' . $request->image);
            }

            $image     = $request->file('image');
            $filename  = Str::random(40) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('uploads/logos', $filename, 'public');
        }

        $clientLogo->name  = $request->name;
        $clientLogo->image = $imagePath;
        $clientLogo->save();

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
