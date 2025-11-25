<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    protected $viewPath   = 'admin.certificates';
    protected $routePath  = 'certificates';
    protected $title      = 'Certificate';
    protected $folderPath = 'uploads/certificates';

    public function index()
    {
        $records = Certificate::all();

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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:512',
        ]);

        $imagePath = '';

        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $filename  = time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
            $image->move($this->folderPath, $filename);
        }

        Certificate::create([
            'name'  => $request->name,
            'image' => $filename,
        ]);

        return redirect()->route("{$this->routePath}.index")->with('success', "{$this->title} created successfully.");
    }

    public function edit(string $id)
    {
        $record = Certificate::findOrFail($id);

        return view("{$this->viewPath}.edit", [
            'record' => $record,
            'title'  => "{$this->title}",
            'routePath'  => $this->routePath,
            'folderPath' => $this->folderPath,
        ]);
    }

    public function show(Certificate $certificate)
    {
        return $certificate;
    }

    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:512',
        ]);

        $filename = $certificate->image ?? '';

        if ($request->hasFile('image')) {

            if (! empty($certificate->image) && file_exists(public_path($this->folderPath . '/' . $certificate->image))) {
                unlink(public_path($this->folderPath . '/' . $certificate->image));
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

    public function destroy(Certificate $certificate)
    {

        if ($certificate->image) {
            Storage::disk('public')->delete($certificate->image);
        }

        $certificate->delete();

        return redirect()
            ->route("{$this->routePath}.index")
            ->with('success', "{$this->title} deleted successfully.");
    }
}
