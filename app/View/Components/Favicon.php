<?php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Favicon extends Component
{
    public ?string $faviconUrl;

    public function __construct()
    {
        $this->faviconUrl = $this->FaviconPath();
    }

    private function FaviconPath(): ?string
    {
        $imagePath = DB::table('settings')
            ->where('key', 'site_favicon')
            ->value('val');

        return $imagePath ? asset('storage/' . $imagePath) : null;
    }

    public function render(): View|Closure|string
    {
        return view('components.favicon');
    }
}
