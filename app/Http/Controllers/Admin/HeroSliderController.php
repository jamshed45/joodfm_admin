<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HeroSliderController extends Controller
{
    protected $viewPath  = 'admin.hero_slides';
    protected $routePath = 'hero-slides';
    protected $title     = 'Hero Slide';

    public function index()
    {
        $records = HeroSlider::latest()->get();

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
            'title'     => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = '';

        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $filename  = time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('uploads/hero_sliders', $filename, 'public');
        }

        HeroSlider::create([
            'title'     => $request->title,
            'sub_title' => $request->sub_title,
            'image'     => $imagePath,
        ]);

        return redirect()->route("{$this->routePath}.index")->with('success', "{$this->title} created successfully.");
    }

    public function edit(string $id)
    {
        $record = HeroSlider::findOrFail($id);

        return view("{$this->viewPath}.edit", [
            'record'    => $record,
            'title'     => "{$this->title}",
            'routePath' => $this->routePath,
        ]);
    }

    public function show(HeroSlider $heroSlider)
    {
        return $heroSlider;
    }

    public function update(Request $request, HeroSlider $heroSlider)
    {

        $request->validate([
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $heroSlider->image ?? '';

        if ($request->hasFile('image')) {
            // Delete old file
            if ($imagePath && Storage::exists('public/' . $imagePath)) {
                Storage::delete('public/' . $imagePath);
            }

            $image     = $request->file('image');
            $filename  = Str::random(40) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('uploads/hero_sliders', $filename, 'public');
        }

        $heroSlider->title = $request->title;
        $heroSlider->sub_title = $request->sub_title;
        $heroSlider->image = $imagePath;
        $heroSlider->save();

        return redirect()->route("{$this->routePath}.index")->with('success', "{$this->title} updated successfully.");
    }

    public function destroy(HeroSlider $heroSlider)
    {

        if ($heroSlider->image) {
            Storage::disk('public')->delete($heroSlider->image);
        }

        $heroSlider->delete();

        return redirect()
            ->route("{$this->routePath}.index")
            ->with('success', "{$this->title} deleted successfully.");
    }

}
