<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HeroSliderController extends Controller
{
    protected $viewPath   = 'admin.hero_slides';
    protected $routePath  = 'hero-slides';
    protected $title      = 'Hero Slide';
    protected $folderPath = 'uploads/hero_sliders';

    public function index()
    {
        $records = HeroSlider::latest()->get();

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
            'en_title'     => 'required|string|max:255',
            'en_sub_title' => 'required|string|max:255',
            'ar_title'     => 'required|string|max:255',
            'ar_sub_title' => 'required|string|max:255',
            'image'        => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link'         => 'nullable|url',
        ]);

        $filename = '';

        if ($request->hasFile('image')) {
            $image    = $request->file('image');
            $filename = time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
            $image->move($this->folderPath, $filename);
        }

        HeroSlider::create([
            'en_title'     => $request->en_title,
            'en_sub_title' => $request->en_sub_title,
            'ar_title'     => $request->ar_title,
            'ar_sub_title' => $request->ar_sub_title,
            'link'         => '',
            'image'        => $filename,
        ]);

        return redirect()->route("{$this->routePath}.index")->with('success', "{$this->title} created successfully.");
    }

    public function edit(string $id)
    {
        $record = HeroSlider::findOrFail($id);

        return view("{$this->viewPath}.edit", [
            'record' => $record,
            'title'  => "{$this->title}",
            'routePath'  => $this->routePath,
            'folderPath' => $this->folderPath,
        ]);
    }

    public function show(HeroSlider $heroSlider)
    {
        return $heroSlider;
    }

    public function update(Request $request, HeroSlider $hero_slide)
    {
        $request->validate([
            'en_title'     => 'required|string|max:255',
            'en_sub_title' => 'required|string|max:255',
            'ar_title'     => 'required|string|max:255',
            'ar_sub_title' => 'required|string|max:255',
            'image'        => $request->isMethod('post')
                ? 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
                : 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $filename = $hero_slide->image;

        if ($request->hasFile('image')) {

            if (! empty($hero_slide->image) && file_exists(public_path($this->folderPath . '/' . $hero_slide->image))) {
                unlink(public_path($this->folderPath . '/' . $hero_slide->image));
            }

            $image    = $request->file('image');
            $filename = time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($this->folderPath), $filename);

        }

        $hero_slide->update([
            'en_title'     => $request->en_title,
            'en_sub_title' => $request->en_sub_title,
            'ar_title'     => $request->ar_title,
            'ar_sub_title' => $request->ar_sub_title,
            'link'         => '',
            'image'        => $filename,
        ]);


        return redirect()->route("{$this->routePath}.index")->with('success', "{$this->title} updated successfully.");
    }

    // public function destroy(HeroSlider $heroSlider)
    // {
    //     dd($heroSlider->toArray());

    //     if ($heroSlider->image) {
    //         Storage::disk('public')->delete($heroSlider->image);
    //     }

    //     $heroSlider->delete();

    //     return redirect()
    //         ->route("{$this->routePath}.index")
    //         ->with('success', "{$this->title} deleted successfully.");
    // }
    public function destroy(HeroSlider $hero_slide)
    {

        if ($hero_slide->image) {
            Storage::disk('public')->delete($hero_slide->image);
        }

        $hero_slide->delete();

        return redirect()
            ->route("{$this->routePath}.index")
            ->with('success', "{$this->title} deleted successfully.");
    }

}
