<?php

namespace App\Http\Controllers;

use App\Models\AdCampaign;
use Illuminate\Http\RedirectResponse;

class AdClickController extends Controller
{
    public function click(AdCampaign $campaign): RedirectResponse
    {
        $campaign->incrementClicks();
        return redirect()->away($campaign->link_url);
    }
}
