<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class MobileLogo extends Component
{
    public ?string $mobileLogoUrl;

    public function __construct()
    {
        $this->mobileLogoUrl = $this->mobileLogoPath();
    }

    private function mobileLogoPath(): ?string
    {
        $imagePath = DB::table('settings')
            ->where('key', 'site_logo_mobile')
            ->value('val');

        return $imagePath ? asset('storage/' . $imagePath) : null;
    }

    public function render(): View|Closure|string
    {
        return view('components.mobileLogo');
    }
}
