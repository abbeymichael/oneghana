<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\District;
use App\Models\Currency;
use App\Models\AdZone;
use Illuminate\Database\Seeder;

class GhanaRegionsDistrictsSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            'Greater Accra' => [
                'Accra Metropolitan', 'Tema Metropolitan', 'Ashaiman Municipal', 'Ledzokuku Municipal',
                'Krowor Municipal', 'La Nkwantanang Madina Municipal', 'La Dade Kotopon Municipal',
                'Adenta Municipal', 'Ga South Municipal', 'Ga Central Municipal', 'Ga West Municipal',
                'Ga East Municipal', 'Weija Gbawe Municipal', 'Tema West Municipal', 'Shai Osudoku',
                'Ningo Prampram', 'Ada East', 'Ada West', 'Kpone Katamanso Municipal',
            ],
            'Ashanti' => [
                'Kumasi Metropolitan', 'Obuasi Municipal', 'Oforikrom Municipal', 'Asokwa Municipal',
                'Suame Municipal', 'Tafo Municipal', 'Kwadaso Municipal', 'Subin Municipal',
                'Manhyia Municipal', 'Asokore Mampong Municipal', 'Ejisu Municipal', 'Bantama Municipal',
                'Nsuta Kwamang Beposo', 'Sekyere Central', 'Sekyere East', 'Sekyere South',
                'Mampong Municipal', 'Ejura Sekyedumase Municipal', 'Offinso Municipal', 'Offinso North',
                'Ahafo Ano South East', 'Ahafo Ano South West', 'Ahafo Ano North', 'Atwima Nwabiagya Municipal',
                'Atwima Nwabiagya North', 'Atwima Mponua', 'Atwima Kwanwoma', 'Amansie Central',
                'Amansie South', 'Amansie West', 'Adansi North', 'Adansi South', 'Adansi Asokwa',
                'Bekwai Municipal', 'Bosome Freho', 'Bosomtwe', 'Asante Akim North', 'Asante Akim South',
                'Asante Akim Central Municipal',
            ],
            'Western' => [
                'Sekondi Takoradi Metropolitan', 'Effia Kwesimintsim Municipal', 'Shama',
                'Ahanta West Municipal', 'Nzema East Municipal', 'Ellembelle', 'Jomoro Municipal',
                'Tarkwa Nsuaem Municipal', 'Prestea Huni Valley Municipal', 'Wassa Amenfi East',
                'Wassa Amenfi West Municipal', 'Wassa Amenfi Central', 'Mpohor', 'Wassa East',
            ],
            'Western North' => [
                'Sefwi Wiawso Municipal', 'Sefwi Akontombra', 'Sefwi Bibiani Ahwiaso Bekwai Municipal',
                'Bodi', 'Juaboso', 'Bia West', 'Bia East', 'Suaman',
            ],
            'Central' => [
                'Cape Coast Metropolitan', 'Komenda Edina Eguafo Abirem Municipal', 'Abura Asebu Kwamankese',
                'Mfantsiman Municipal', 'Ekumfi', 'Ajumako Enyan Essiam', 'Gomoa West', 'Gomoa East',
                'Gomoa Central', 'Effutu Municipal', 'Awutu Senya East Municipal', 'Awutu Senya',
                'Agona West Municipal', 'Agona East', 'Asikuma Odoben Brakwa', 'Assin South',
                'Assin North', 'Twifo Atti Morkwa', 'Twifo Hemang Lower Denkyira', 'Upper Denkyira East Municipal',
                'Upper Denkyira West',
            ],
            'Volta' => [
                'Ho Municipal', 'Ho West', 'Adaklu', 'Agotime Ziope', 'South Tongu', 'Central Tongu',
                'North Tongu', 'Keta Municipal', 'Ketu South Municipal', 'Ketu North', 'Anloga',
                'Kpando Municipal', 'Hohoe Municipal', 'Afadzato South', 'Nkwanta South', 'Nkwanta North',
                'Jasikan', 'Kadjebi', 'Biakoye', 'Akatsi South', 'Akatsi North',
            ],
            'Oti' => [
                'Dambai Municipal', 'Nkwanta South', 'Nkwanta North', 'Kadjebi',
                'Biakoye', 'Krachi East', 'Krachi West', 'Krachi Nchumuru',
            ],
            'Eastern' => [
                'Koforidua Municipal', 'New Juaben South Municipal', 'New Juaben North Municipal',
                'Akwapim North Municipal', 'Akropong', 'Okere', 'Manya Krobo', 'Yilo Krobo Municipal',
                'Lower Manya Krobo Municipal', 'Asuogyaman', 'Akuapim South', 'Nsawam Adoagyiri Municipal',
                'Suhum Municipal', 'Ayensuano', 'Akwapim South', 'Akwapim East', 'Denkyembour',
                'Atiwa East', 'Atiwa West', 'Fanteakwa North', 'Fanteakwa South', 'Kwabibirem',
                'Birim North', 'Birim Central Municipal', 'Birim South', 'West Akim Municipal',
                'Upper West Akim', 'East Akim Municipal',
            ],
            'Bono' => [
                'Sunyani Municipal', 'Sunyani West', 'Dormaa Central Municipal', 'Dormaa East',
                'Dormaa West', 'Berekum Municipal', 'Berekum West', 'Jaman South', 'Jaman North',
                'Tain', 'Wenchi Municipal', 'Banda',
            ],
            'Bono East' => [
                'Techiman Municipal', 'Techiman North', 'Nkoranza North', 'Nkoranza South Municipal',
                'Kintampo North Municipal', 'Kintampo South', 'Pru East', 'Pru West', 'Atebubu Amantin',
                'Sene East', 'Sene West',
            ],
            'Ahafo' => [
                'Goaso Municipal', 'Asunafo North Municipal', 'Asunafo South', 'Asutifi North',
                'Asutifi South', 'Tano North Municipal', 'Tano South Municipal',
            ],
            'Northern' => [
                'Tamale Metropolitan', 'Sagnarigu Municipal', 'Mion', 'Yendi Municipal', 'Gushegu Municipal',
                'Karaga', 'Nanton', 'Nanumba North Municipal', 'Nanumba South', 'Zabzugu',
                'Tatale Sanguli', 'Kpandai', 'Saboba',
            ],
            'Savannah' => [
                'Damango Municipal', 'Bole', 'Sawla Tuna Kalba', 'North Gonja', 'Central Gonja',
                'East Gonja Municipal', 'West Gonja',
            ],
            'North East' => [
                'Nalerigu Municipal', 'Bunkpurugu Nakpanduri', 'Mamprugu Moagduri',
                'Yunyoo', 'East Mamprusi Municipal', 'West Mamprusi',
            ],
            'Upper East' => [
                'Bolgatanga Municipal', 'Bolgatanga East', 'Bawku Municipal', 'Bawku West',
                'Pusiga', 'Binduri', 'Garu Tempane', 'Talensi', 'Nabdam', 'Builsa North Municipal',
                'Builsa South', 'Kassena Nankana Municipal', 'Kassena Nankana West',
            ],
            'Upper West' => [
                'Wa Municipal', 'Wa West', 'Wa East', 'Jirapa Municipal', 'Lambussie Karni',
                'Lawra Municipal', 'Nandom Municipal', 'Sissala East Municipal', 'Sissala West',
            ],
        ];

        if (!Currency::where('is_default', true)->exists()) {
            Currency::create(['code' => 'GHS', 'symbol' => '₵', 'name' => 'Ghana Cedi', 'is_active' => true, 'is_default' => true]);
            Currency::create(['code' => 'USD', 'symbol' => '$', 'name' => 'US Dollar', 'is_active' => true]);
            Currency::create(['code' => 'GBP', 'symbol' => '£', 'name' => 'British Pound', 'is_active' => true]);
            Currency::create(['code' => 'EUR', 'symbol' => '€', 'name' => 'Euro', 'is_active' => true]);
            Currency::create(['code' => 'NGN', 'symbol' => '₦', 'name' => 'Nigerian Naira', 'is_active' => true]);
        }

        if (AdZone::count() === 0) {
            AdZone::create(['key' => 'homepage_banner', 'name' => 'Homepage Banner', 'width' => 728, 'height' => 90, 'description' => 'Horizontal banner on homepage']);
            AdZone::create(['key' => 'search_sidebar', 'name' => 'Search Sidebar', 'width' => 300, 'height' => 250, 'description' => 'Medium rectangle on search page']);
            AdZone::create(['key' => 'listing_sidebar', 'name' => 'Listing Sidebar', 'width' => 300, 'height' => 600, 'description' => 'Skyscraper on business detail page']);
            AdZone::create(['key' => 'listing_native', 'name' => 'Listing Native', 'width' => 300, 'height' => 250, 'description' => 'Native ad in listings']);
        }

        foreach ($regions as $regionName => $districts) {
            $region = Region::firstOrCreate(['name' => $regionName]);
            foreach ($districts as $districtName) {
                District::firstOrCreate(['region_id' => $region->id, 'name' => $districtName]);
            }
        }
    }
}
