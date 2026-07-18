<?php

namespace Database\Seeders;

use App\Models\AdZone;
use Illuminate\Database\Seeder;

class AdZonesSeeder extends Seeder
{
    public function run(): void
    {
        $zones = [
            [
                'key'         => 'homepage_hero',
                'name'        => 'Homepage Hero Banner',
                'width'       => 1200,
                'height'      => 250,
                'description' => 'Full-width banner displayed at the top of the homepage below the nav.',
            ],
            [
                'key'         => 'homepage_mid',
                'name'        => 'Homepage Mid-Page Banner',
                'width'       => 970,
                'height'      => 90,
                'description' => 'Leaderboard banner placed mid-way down the homepage between featured sections.',
            ],
            [
                'key'         => 'search_sidebar',
                'name'        => 'Search Results Sidebar',
                'width'       => 300,
                'height'      => 600,
                'description' => 'Half-page ad shown in the right sidebar of the business search/listing page.',
            ],
            [
                'key'         => 'listing_top',
                'name'        => 'Business Listing Top Banner',
                'width'       => 728,
                'height'      => 90,
                'description' => 'Leaderboard banner at the top of each business detail page.',
            ],
            [
                'key'         => 'listing_sidebar',
                'name'        => 'Business Listing Sidebar',
                'width'       => 300,
                'height'      => 250,
                'description' => 'Medium rectangle ad in the sidebar of business detail pages.',
            ],
            [
                'key'         => 'dashboard_sidebar',
                'name'        => 'Dashboard Sidebar',
                'width'       => 300,
                'height'      => 250,
                'description' => 'Medium rectangle shown in the business-owner and reviewer dashboards.',
            ],
            [
                'key'         => 'category_banner',
                'name'        => 'Category Page Banner',
                'width'       => 970,
                'height'      => 90,
                'description' => 'Leaderboard banner displayed at the top of category browse pages.',
            ],
        ];

        foreach ($zones as $zone) {
            AdZone::firstOrCreate(['key' => $zone['key']], $zone);
        }
    }
}
