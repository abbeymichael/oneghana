<?php

namespace App\Livewire;

use App\Models\Business;
use Livewire\Component;

class BusinessShow extends Component
{
    public Business $business;
    public bool $showReviewForm = false;

    public function mount(Business $business)
    {
        $this->business = $business->load([
            'category', 'region', 'district',
            'approvedReviews.user',
            'products' => fn($q) => $q->available()->with('currency'),
            'customFieldValues',
        ]);

        if ($this->business->status !== 'published') {
            abort(404);
        }

        $this->business->incrementViews();
    }

    public function render()
    {
        return view('livewire.business-show', [
            'averageRating' => $this->business->averageRating(),
            'reviewsCount' => $this->business->reviewsCount(),
        ])->layout('layouts.app');
    }
}
