<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@ghanabiz.com'],
            ['name' => 'Admin', 'password' => bcrypt('password'), 'role' => 'admin', 'email_verified_at' => now()]
        );

        $restaurant = Category::create(['name' => 'Restaurants & Food', 'slug' => 'restaurants-food', 'icon' => '🍽️',
            'custom_fields_schema' => json_encode([
                ['key' => 'cuisine_type', 'label' => 'Cuisine Type', 'type' => 'select', 'options' => ['Local Ghanaian', 'Continental', 'Fast Food', 'Chinese', 'Italian', 'Indian', 'Other']],
                ['key' => 'delivery_available', 'label' => 'Delivery Available', 'type' => 'boolean'],
                ['key' => 'price_range', 'label' => 'Price Range', 'type' => 'select', 'options' => ['Budget', 'Moderate', 'Expensive']],
            ]),
        ]);
        Category::create(['parent_id' => $restaurant->id, 'name' => 'Local Ghanaian Cuisine', 'slug' => 'local-ghanaian-cuisine']);
        Category::create(['parent_id' => $restaurant->id, 'name' => 'Fast Food', 'slug' => 'fast-food']);
        Category::create(['parent_id' => $restaurant->id, 'name' => 'Bakeries', 'slug' => 'bakeries']);

        $retail = Category::create(['name' => 'Retail & Shopping', 'slug' => 'retail-shopping', 'icon' => '🛍️']);
        Category::create(['parent_id' => $retail->id, 'name' => 'Clothing & Fashion', 'slug' => 'clothing-fashion']);
        Category::create(['parent_id' => $retail->id, 'name' => 'Electronics', 'slug' => 'electronics']);
        Category::create(['parent_id' => $retail->id, 'name' => 'Supermarkets', 'slug' => 'supermarkets']);

        $services = Category::create(['name' => 'Services', 'slug' => 'services', 'icon' => '🔧']);
        Category::create(['parent_id' => $services->id, 'name' => 'Health & Beauty', 'slug' => 'health-beauty']);
        Category::create(['parent_id' => $services->id, 'name' => 'Legal & Financial', 'slug' => 'legal-financial']);
        Category::create(['parent_id' => $services->id, 'name' => 'Education & Training', 'slug' => 'education-training']);

        $realEstate = Category::create(['name' => 'Real Estate & Property', 'slug' => 'real-estate-property', 'icon' => '🏠']);
        Category::create(['parent_id' => $realEstate->id, 'name' => 'Property Sales', 'slug' => 'property-sales']);
        Category::create(['parent_id' => $realEstate->id, 'name' => 'Rentals', 'slug' => 'rentals']);
        Category::create(['parent_id' => $realEstate->id, 'name' => 'Construction', 'slug' => 'construction']);

        $transport = Category::create(['name' => 'Transport & Logistics', 'slug' => 'transport-logistics', 'icon' => '🚗']);
        Category::create(['parent_id' => $transport->id, 'name' => 'Ride Hailing & Taxis', 'slug' => 'ride-hailing-taxis']);
        Category::create(['parent_id' => $transport->id, 'name' => 'Delivery Services', 'slug' => 'delivery-services']);
        Category::create(['parent_id' => $transport->id, 'name' => 'Vehicle Sales', 'slug' => 'vehicle-sales']);

        Category::create(['name' => 'Technology & IT', 'slug' => 'technology-it', 'icon' => '💻']);
        Category::create(['name' => 'Agriculture & Farming', 'slug' => 'agriculture-farming', 'icon' => '🌿']);
        Category::create(['name' => 'Hospitality & Tourism', 'slug' => 'hospitality-tourism', 'icon' => '🏨']);

        $this->call([
            GhanaRegionsDistrictsSeeder::class,
            CurrenciesSeeder::class,
            AdZonesSeeder::class,
            UsersSeeder::class,
            BusinessesSeeder::class,
            ProductsSeeder::class,
            ReviewsSeeder::class,
        ]);
    }
}
