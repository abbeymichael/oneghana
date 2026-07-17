<?php

namespace App\Livewire;

use App\Models\Business;
use App\Models\Category;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class BusinessRegister extends Component
{
    use WithFileUploads;

    public int $step = 1;

    public string $name = '';
    public string $description = '';
    public ?string $category_id = null;
    public ?string $region_id = null;
    public ?string $district_id = null;
    public string $address_text = '';
    public string $ghanapost_gps = '';
    public string $phone = '';
    public string $whatsapp_number = '';
    public string $email = '';
    public string $website = '';
    public string $momo_mtn = '';
    public string $momo_vodafone = '';
    public string $momo_airteltigo = '';
    public $logo = null;
    public $gallery = [];

    public function updatedRegionId() { $this->district_id = null; }

    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'min:20', 'max:10000'],
                'category_id' => ['required', 'exists:categories,id'],
            ]);
        } elseif ($this->step === 2) {
            $this->validate([
                'region_id' => ['required', 'exists:regions,id'],
                'district_id' => ['required', 'exists:districts,id'],
                'address_text' => ['required', 'string', 'max:500'],
                'ghanapost_gps' => ['nullable', 'string', 'max:50'],
            ]);
        } elseif ($this->step === 3) {
            $this->validate([
                'phone' => ['required', 'string', 'max:20'],
                'whatsapp_number' => ['nullable', 'string', 'max:20'],
                'email' => ['nullable', 'email', 'max:255'],
                'website' => ['nullable', 'url', 'max:255'],
                'momo_mtn' => ['nullable', 'string', 'max:20'],
                'momo_vodafone' => ['nullable', 'string', 'max:20'],
                'momo_airteltigo' => ['nullable', 'string', 'max:20'],
            ]);
        }

        $this->step++;
    }

    public function previousStep() { $this->step--; }

    public function submit()
    {
        $this->validate([
            'logo' => ['nullable', 'image', 'max:2048'],
            'gallery' => ['nullable', 'array', 'max:10'],
            'gallery.*' => ['image', 'max:5120'],
        ]);

        $business = Business::create([
            'user_id' => auth()->id(),
            'name' => $this->name,
            'slug' => Str::slug($this->name) . '-' . Str::random(6),
            'description' => $this->description,
            'category_id' => $this->category_id,
            'region_id' => $this->region_id,
            'district_id' => $this->district_id,
            'address_text' => $this->address_text,
            'ghanapost_gps' => $this->ghanapost_gps,
            'phone' => $this->phone,
            'whatsapp_number' => $this->whatsapp_number,
            'email' => $this->email,
            'website' => $this->website,
            'momo_mtn' => $this->momo_mtn,
            'momo_vodafone' => $this->momo_vodafone,
            'momo_airteltigo' => $this->momo_airteltigo,
            'status' => 'published',
        ]);

        if ($this->logo) $business->addMedia($this->logo)->toMediaCollection('logo');
        if ($this->gallery) {
            foreach ($this->gallery as $image) $business->addMedia($image)->toMediaCollection('gallery');
        }

        session()->flash('message', 'Your business has been registered!');
        return redirect()->route('business.show', $business);
    }

    public function render()
    {
        $categories = Category::root()->with('children')->get();
        $regions = Region::with('districts')->get();
        $selectedCategory = $this->category_id ? Category::find($this->category_id) : null;
        $selectedRegion = $this->region_id ? Region::find($this->region_id) : null;

        return view('livewire.business-register', compact('categories', 'regions', 'selectedCategory', 'selectedRegion'))->layout('layouts.app');
    }
}
