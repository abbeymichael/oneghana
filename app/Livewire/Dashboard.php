<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return view('livewire.dashboard', [
                'isAdmin' => true,
                'stats' => [
                    'total_businesses' => \App\Models\Business::count(),
                    'pending_reviews' => \App\Models\Review::pending()->count(),
                    'total_businesses_published' => \App\Models\Business::where('status', 'published')->count(),
                ],
            ])->layout('layouts.app');
        }

        return view('livewire.dashboard', [
            'isAdmin' => false,
            'businesses' => $user->businesses()->withCount(['reviews', 'approvedReviews', 'products'])->get(),
        ])->layout('layouts.app');
    }
}
