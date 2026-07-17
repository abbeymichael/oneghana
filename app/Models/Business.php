<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;
use Illuminate\Support\Str;

class Business extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, HasTags;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'category_id',
        'region_id',
        'district_id',
        'address_text',
        'ghanapost_gps',
        'lat',
        'lng',
        'phone',
        'whatsapp_number',
        'email',
        'website',
        'momo_mtn',
        'momo_vodafone',
        'momo_airteltigo',
        'hours',
        'status',
        'tier',
        'is_featured',
        'views_count',
        'whatsapp_clicks_count',
    ];

    protected function casts(): array
    {
        return [
            'hours' => 'array',
            'lat' => 'decimal:7',
            'lng' => 'decimal:7',
            'is_featured' => 'boolean',
            'views_count' => 'integer',
            'whatsapp_clicks_count' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Business $business) {
            if (empty($business->slug)) {
                $business->slug = Str::slug($business->name) . '-' . Str::random(6);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('status', 'approved');
    }

    public function products()
    {
        return $this->hasMany(Product::class)->orderBy('sort_order');
    }

    public function customFieldValues()
    {
        return $this->hasMany(BusinessCustomFieldValue::class);
    }

    public function averageRating(): ?float
    {
        return $this->approvedReviews()->avg('rating');
    }

    public function reviewsCount(): int
    {
        return $this->approvedReviews()->count();
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile();
        $this->addMediaCollection('gallery');
        $this->addMediaCollection('photos');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function whatsappLink(string $text = ''): ?string
    {
        if (!$this->whatsapp_number) {
            return null;
        }

        $number = preg_replace('/[^0-9]/', '', $this->whatsapp_number);
        $url = "https://wa.me/{$number}";

        if ($text) {
            $url .= '?text=' . urlencode($text);
        }

        return $url;
    }
}
