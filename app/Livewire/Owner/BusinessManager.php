<?php

namespace App\Livewire\Owner;

use App\Models\Business;
use App\Models\Category;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithFileUploads;

class BusinessManager extends Component
{
    use WithFileUploads;

    public Business $business;
    public string $name = '';
    public string $description = '';
    public ?string $category_id = null;
    public ?string $region_id = null;
    public ?string $district_id = null;
    public ?string $address_text = null;
    public ?string $ghanapost_gps = null;
    public string $phone = '';
    public ?string $whatsapp_number = null;
    public ?string $email = null;
    public ?string $website = null;
    public ?string $momo_mtn = null;
    public ?string $momo_vodafone = null;
    public ?string $momo_airteltigo = null;
    public $logo = null;
    public bool $removeLogo = false;

    public function mount(Business $business)
    {
        if ($business->user_id !== auth()->id() && !auth()->user()->isAdmin()) abort(403);
        $this->business = $business;
        $this->fill($business->only([
            'name', 'description', 'category_id', 'region_id', 'district_id',
            'address_text', 'ghanapost_gps', 'phone', 'whatsapp_number',
            'email', 'website', 'momo_mtn', 'momo_vodafone', 'momo_airteltigo',
        ]));
    }

    public function updatedRegionId() { $this->district_id = null; }

    public function save()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:20', 'max:10000'],
            'category_id' => ['required', 'exists:categories,id'],
            'region_id' => ['nullable', 'exists:regions,id'],
            'district_id' => ['nullable', 'exists:districts,id'],
            'address_text' => ['nullable', 'string', 'max:500'],
            'ghanapost_gps' => ['nullable', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:20'],
            'whatsapp_number' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        $this->business->update($this->only([
            'name', 'description', 'category_id', 'region_id', 'district_id',
            'address_text', 'ghanapost_gps', 'phone', 'whatsapp_number',
            'email', 'website', 'momo_mtn', 'momo_vodafone', 'momo_airteltigo',
        ]));

        if ($this->logo) { $this->business->clearMediaCollection('logo'); $this->business->addMedia($this->logo)->toMediaCollection('logo'); }
        if ($this->removeLogo) $this->business->clearMediaCollection('logo');

        session()->flash('message', 'Business updated!');
    }

    public function render()
    {
        return view('livewire.owner.business-manager', [
            'categories' => Category::root()->with('children')->get(),
            'regions' => Region::with('districts')->get(),
            'selectedRegion' => $this->region_id ? Region::find($this->region_id) : null,
        ])->layout('layouts.app');
    }
}
