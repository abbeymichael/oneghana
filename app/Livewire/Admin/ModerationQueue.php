<?php

namespace App\Livewire\Admin;

use App\Models\Business;
use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class ModerationQueue extends Component
{
    use WithPagination;

    public string $tab = 'businesses';

    public function approveBusiness(Business $business) { $business->update(['status' => 'published']); session()->flash('message', 'Business approved.'); }
    public function flagBusiness(Business $business) { $business->update(['status' => 'flagged']); session()->flash('message', 'Business flagged.'); }
    public function approveReview(Review $review) { $review->update(['status' => 'approved']); session()->flash('message', 'Review approved.'); }
    public function flagReview(Review $review) { $review->update(['status' => 'flagged']); session()->flash('message', 'Review flagged.'); }

    public function render()
    {
        return view('livewire.admin.moderation-queue', [
            'pendingBusinesses' => Business::where('status', 'published')->whereNull('deleted_at')->with(['user', 'category', 'region'])->latest()->paginate(20, pageName: 'bPage'),
            'flaggedBusinesses' => Business::where('status', 'flagged')->whereNull('deleted_at')->with(['user', 'category'])->latest()->paginate(20, pageName: 'fPage'),
            'pendingReviews' => Review::pending()->with(['user', 'business'])->latest()->paginate(20, pageName: 'rPage'),
        ])->layout('layouts.app');
    }
}
