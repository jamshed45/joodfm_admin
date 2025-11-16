<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class DesktopLogo extends Component
{
    public ?string $desktopLogoUrl;

    public function __construct()
    {
        $this->desktopLogoUrl = $this->desktopLogoPath();
    }

    private function desktopLogoPath(): ?string
    {
        $imagePath = DB::table('settings')
            ->where('key', 'site_logo_desktop')
            ->value('val');

        return $imagePath ? asset( $imagePath) : null;
    }

    public function render(): View|string
    {
        return view('components.desktop-logo');
    }
}
