<?php

namespace App\Livewire\Admin;

use App\Models\AdCampaign;
use App\Models\AdZone;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdCampaignManager extends Component
{
    use WithFileUploads;

    public bool $showForm = false;
    public ?int $editingCampaignId = null;
    public ?string $ad_zone_id = null;
    public string $advertiser_name = '';
    public string $link_url = '';
    public $creative = null;
    public ?string $starts_at = null;
    public ?string $ends_at = null;
    public bool $is_active = true;

    public function create() { $this->resetForm(); $this->showForm = true; $this->editingCampaignId = null; }

    public function edit(AdCampaign $campaign)
    {
        $this->resetForm(); $this->showForm = true; $this->editingCampaignId = $campaign->id;
        $this->ad_zone_id = (string) $campaign->ad_zone_id;
        $this->advertiser_name = $campaign->advertiser_name; $this->link_url = $campaign->link_url;
        $this->starts_at = $campaign->starts_at?->toDateString(); $this->ends_at = $campaign->ends_at?->toDateString();
        $this->is_active = $campaign->is_active;
    }

    public function save()
    {
        $this->validate([
            'ad_zone_id' => ['required', 'exists:ad_zones,id'],
            'advertiser_name' => ['required', 'string', 'max:255'],
            'link_url' => ['required', 'url', 'max:2048'],
            'creative' => ['nullable', 'image', 'max:5120'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after:starts_at'],
            'is_active' => ['boolean'],
        ]);

        $data = ['ad_zone_id' => $this->ad_zone_id, 'advertiser_name' => $this->advertiser_name, 'link_url' => $this->link_url,
                 'starts_at' => $this->starts_at, 'ends_at' => $this->ends_at, 'is_active' => $this->is_active];

        $campaign = $this->editingCampaignId ? tap(AdCampaign::findOrFail($this->editingCampaignId))->update($data) : AdCampaign::create($data);
        if ($this->creative) { $campaign->addMedia($this->creative)->toMediaCollection('creative'); }

        session()->flash('message', 'Campaign saved!'); $this->showForm = false; $this->resetForm();
    }

    public function toggleActive(AdCampaign $campaign) { $campaign->update(['is_active' => !$campaign->is_active]); }
    public function delete(AdCampaign $campaign) { $campaign->delete(); session()->flash('message', 'Campaign deleted.'); }

    private function resetForm(): void { $this->ad_zone_id = null; $this->advertiser_name = ''; $this->link_url = ''; $this->creative = null; $this->starts_at = null; $this->ends_at = null; $this->is_active = true; }

    public function render()
    {
        return view('livewire.admin.ad-campaign-manager', [
            'zones' => AdZone::all(),
            'campaigns' => AdCampaign::with('zone')->latest()->get(),
        ])->layout('layouts.app');
    }
}
