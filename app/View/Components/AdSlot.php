<?php

namespace App\View\Components;

use App\Models\AdZone;
use Illuminate\View\Component;

class AdSlot extends Component
{
    public string $zone;

    public function __construct(string $zone)
    {
        $this->zone = $zone;
    }

    public function render()
    {
        return view('components.ad-slot');
    }
}
