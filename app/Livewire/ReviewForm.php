<?php

namespace App\Livewire;

use App\Models\Business;
use App\Models\Review;
use Livewire\Component;
use Livewire\WithFileUploads;

class ReviewForm extends Component
{
    use WithFileUploads;

    public Business $business;
    public int $rating = 5;
    public string $body = '';
    public $photos = [];

    protected function rules(): array
    {
        return [
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'body' => ['required', 'string', 'min:10', 'max:5000'],
            'photos' => ['nullable', 'array', 'max:5'],
            'photos.*' => ['image', 'max:10240'],
        ];
    }

    public function submit()
    {
        $this->validate();

        $review = Review::create([
            'business_id' => $this->business->id,
            'user_id' => auth()->id(),
            'rating' => $this->rating,
            'body' => $this->body,
            'status' => 'pending',
        ]);

        if ($this->photos) {
            foreach ($this->photos as $photo) {
                $review->addMedia($photo)->toMediaCollection('review_photos');
            }
        }

        session()->flash('message', 'Your review has been submitted and is pending approval.');
        $this->reset(['rating', 'body', 'photos']);
        $this->dispatch('review-submitted');
    }

    public function render()
    {
        return view('livewire.review-form');
    }
}
