<?php

namespace App\Livewire;

use App\Models\Business;
use App\Models\Category;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $featuredCategories = Category::root()->with('children')->get();
        $recentListings = Business::published()
            ->with(['category', 'region', 'district'])
            ->latest()
            ->take(12)
            ->get();

        return view('livewire.home', [
            'featuredCategories' => $featuredCategories,
            'recentListings' => $recentListings,
        ])->layout('layouts.app');
    }
}
