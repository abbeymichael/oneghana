<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AdCampaign extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'ad_zone_id',
        'advertiser_name',
        'creative_path',
        'link_url',
        'starts_at',
        'ends_at',
        'is_active',
        'impressions_count',
        'clicks_count',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'is_active' => 'boolean',
            'impressions_count' => 'integer',
            'clicks_count' => 'integer',
        ];
    }

    public function zone()
    {
        return $this->belongsTo(AdZone::class, 'ad_zone_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('creative')->singleFile();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            });
    }

    public function incrementImpressions(): void
    {
        $this->increment('impressions_count');
    }

    public function incrementClicks(): void
    {
        $this->increment('clicks_count');
    }
}
