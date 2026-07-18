<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    public function run(): void
    {
        $currencies = [
            ['code' => 'GHS', 'symbol' => '₵',  'name' => 'Ghanaian Cedi',   'is_active' => true,  'is_default' => true],
            ['code' => 'USD', 'symbol' => '$',   'name' => 'US Dollar',        'is_active' => true,  'is_default' => false],
            ['code' => 'EUR', 'symbol' => '€',   'name' => 'Euro',             'is_active' => true,  'is_default' => false],
            ['code' => 'GBP', 'symbol' => '£',   'name' => 'British Pound',    'is_active' => true,  'is_default' => false],
            ['code' => 'NGN', 'symbol' => '₦',   'name' => 'Nigerian Naira',   'is_active' => false, 'is_default' => false],
        ];

        foreach ($currencies as $currency) {
            Currency::firstOrCreate(['code' => $currency['code']], $currency);
        }
    }
}
