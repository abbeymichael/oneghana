<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'business_id',
        'name',
        'slug',
        'description',
        'price',
        'currency_id',
        'unit',
        'type',
        'is_available',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_available' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_photos');
    }

    public function formattedPrice(): string
    {
        if ($this->price === null) {
            return 'Contact for pricing';
        }

        $currency = $this->currency;
        if ($currency) {
            return $currency->symbol . number_format($this->price, 2);
        }

        return 'GH₵' . number_format($this->price, 2);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    public function whatsappEnquiryText(string $directoryName = 'Ghana Business Directory'): string
    {
        return "Hi, I'm interested in {$this->name} listed on {$directoryName}";
    }
}
