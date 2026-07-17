<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdZone extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'name',
        'width',
        'height',
        'description',
        'network_fallback_code',
    ];

    public function campaigns()
    {
        return $this->hasMany(AdCampaign::class);
    }

    public function activeCampaign()
    {
        return $this->hasOne(AdCampaign::class)
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            })
            ->latest();
    }
}
