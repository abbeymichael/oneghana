<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'symbol',
        'name',
        'is_active',
        'is_default',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_default' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Currency $currency) {
            if ($currency->is_default) {
                static::where('id', '!=', $currency->id)
                    ->where('is_default', true)
                    ->update(['is_default' => false]);
            }
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function format(float $amount): string
    {
        return $this->symbol . number_format($amount, 2);
    }

    public static function default(): ?self
    {
        return static::where('is_default', true)->first();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
