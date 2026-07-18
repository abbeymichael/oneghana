<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Category;
use App\Models\District;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BusinessesSeeder extends Seeder
{
    public function run(): void
    {
        // Helpers
        $regionAccra   = Region::where('name', 'Greater Accra')->first();
        $regionAshanti = Region::where('name', 'Ashanti')->first();
        $regionWestern = Region::where('name', 'Western')->first();
        $regionCentral = Region::where('name', 'Central')->first();
        $regionVolta   = Region::where('name', 'Volta')->first();

        $districtAccra   = District::where('name', 'Accra Metropolitan')->first()
                         ?? District::where('region_id', $regionAccra?->id)->first();
        $districtTema    = District::where('name', 'Tema Metropolitan')->first()
                         ?? District::where('region_id', $regionAccra?->id)->skip(1)->first();
        $districtKumasi  = District::where('name', 'Kumasi Metropolitan')->first()
                         ?? District::where('region_id', $regionAshanti?->id)->first();
        $districtTakoradi= District::where('name', 'Sekondi-Takoradi Metropolitan')->first()
                         ?? District::where('region_id', $regionWestern?->id)->first();
        $districtCape    = District::where('name', 'Cape Coast Metropolitan')->first()
                         ?? District::where('region_id', $regionCentral?->id)->first();
        $districtHo      = District::where('name', 'Ho Municipal')->first()
                         ?? District::where('region_id', $regionVolta?->id)->first();

        $catRestaurant = Category::where('slug', 'restaurants-food')->first();
        $catRetail     = Category::where('slug', 'retail-shopping')->first();
        $catServices   = Category::where('slug', 'services')->first();
        $catRealEstate = Category::where('slug', 'real-estate-property')->first();
        $catTransport  = Category::where('slug', 'transport-logistics')->first();
        $catTech       = Category::where('slug', 'technology-it')->first();
        $catAgri       = Category::where('slug', 'agriculture-farming')->first();
        $catHospitality= Category::where('slug', 'hospitality-tourism')->first();

        $ownerKwame  = User::where('email', 'kwame@kentegh.com')->first();
        $ownerAkosua = User::where('email', 'akosua@ghanaspices.com')->first();
        $ownerKofi   = User::where('email', 'kofi@accrafresh.com')->first();
        $ownerAbena  = User::where('email', 'abena@kurofa.com')->first();
        $ownerYaw    = User::where('email', 'yaw@darkotech.com')->first();
        $ownerNana   = User::where('email', 'nana@oseilogistics.com')->first();
        $ownerEfua   = User::where('email', 'efua@akarasweets.com')->first();
        $ownerKwesi  = User::where('email', 'kwesi@armahfarms.com')->first();
        $ownerAdwoa  = User::where('email', 'adwoa@nyarkofashion.com')->first();
        $ownerFiifi  = User::where('email', 'fiifi@antwirealty.com')->first();
        $admin       = User::where('email', 'admin@ghanabiz.com')->first();

        $hours = [
            'monday'    => ['open' => '08:00', 'close' => '18:00', 'closed' => false],
            'tuesday'   => ['open' => '08:00', 'close' => '18:00', 'closed' => false],
            'wednesday' => ['open' => '08:00', 'close' => '18:00', 'closed' => false],
            'thursday'  => ['open' => '08:00', 'close' => '18:00', 'closed' => false],
            'friday'    => ['open' => '08:00', 'close' => '17:00', 'closed' => false],
            'saturday'  => ['open' => '09:00', 'close' => '15:00', 'closed' => false],
            'sunday'    => ['open' => null,     'close' => null,    'closed' => true],
        ];

        $businesses = [
            // --- GREATER ACCRA ---
            [
                'user_id'          => $ownerKwame?->id ?? $admin?->id,
                'name'             => 'Kente & Kaba Ghana',
                'description'      => 'Premium Kente cloth, traditional Ghanaian wear, and contemporary African fashion. We source directly from Bonwire weavers and carry over 400 in-stock designs. Custom tailoring available within 5 working days.',
                'category_id'      => $catRetail?->id,
                'region_id'        => $regionAccra?->id,
                'district_id'      => $districtAccra?->id,
                'address_text'     => '14 Oxford Street, Osu, Accra',
                'ghanapost_gps'    => 'GA-144-1234',
                'lat'              => '5.5600',
                'lng'              => '-0.1869',
                'phone'            => '+233302777001',
                'whatsapp_number'  => '+233244101001',
                'email'            => 'info@kentegh.com',
                'website'          => 'https://kentegh.com',
                'hours'            => $hours,
                'status'           => 'published',
                'tier'             => 'premium',
                'is_featured'      => true,
                'views_count'      => 1842,
            ],
            [
                'user_id'          => $ownerAkosua?->id ?? $admin?->id,
                'name'             => 'Ghana Spice Market',
                'description'      => 'Wholesale and retail dried spices, herbs, and traditional medicinal plants. Specialising in prekese, grains of selim, dawadawa, and shea butter. Serving restaurants, homes, and exporters since 2008.',
                'category_id'      => $catRestaurant?->id,
                'region_id'        => $regionAccra?->id,
                'district_id'      => $districtAccra?->id,
                'address_text'     => 'Stall 48, Makola Market, Accra Central',
                'ghanapost_gps'    => 'GA-023-5678',
                'lat'              => '5.5489',
                'lng'              => '-0.2000',
                'phone'            => '+233302217890',
                'whatsapp_number'  => '+233244202002',
                'email'            => 'sales@ghanaspices.com',
                'momo_mtn'         => '0244202002',
                'hours'            => $hours,
                'status'           => 'published',
                'tier'             => 'standard',
                'is_featured'      => true,
                'views_count'      => 2301,
            ],
            [
                'user_id'          => $ownerKofi?->id ?? $admin?->id,
                'name'             => 'Accra Fresh Supermarket',
                'description'      => 'Modern grocery supermarket stocking local and imported produce, fresh meats, dairy, and household essentials. Air-conditioned aisles, free parking, and mobile money payment available.',
                'category_id'      => $catRetail?->id,
                'region_id'        => $regionAccra?->id,
                'district_id'      => $districtTema?->id,
                'address_text'     => 'Plot 12, Community 8, Tema',
                'ghanapost_gps'    => 'GA-411-8901',
                'lat'              => '5.6698',
                'lng'              => '-0.0148',
                'phone'            => '+233303200100',
                'whatsapp_number'  => '+233244303003',
                'email'            => 'contact@accrafresh.com',
                'website'          => 'https://accrafresh.com',
                'momo_mtn'         => '0244303003',
                'momo_vodafone'    => '0205303003',
                'hours'            => array_merge($hours, ['sunday' => ['open' => '10:00', 'close' => '14:00', 'closed' => false]]),
                'status'           => 'published',
                'tier'             => 'premium',
                'is_featured'      => true,
                'views_count'      => 3105,
            ],
            [
                'user_id'          => $ownerYaw?->id ?? $admin?->id,
                'name'             => 'DarkoTech Solutions',
                'description'      => 'IT services, software development, cloud migration, and cybersecurity consulting for Ghanaian businesses. Our team of certified engineers has delivered 200+ projects across banking, retail, and government sectors.',
                'category_id'      => $catTech?->id,
                'region_id'        => $regionAccra?->id,
                'district_id'      => $districtAccra?->id,
                'address_text'     => '3rd Floor, Ridge Tower, Independence Avenue, Accra',
                'ghanapost_gps'    => 'GA-123-3456',
                'lat'              => '5.5732',
                'lng'              => '-0.1887',
                'phone'            => '+233302915000',
                'whatsapp_number'  => '+233244404004',
                'email'            => 'hello@darkotech.com',
                'website'          => 'https://darkotech.com',
                'hours'            => $hours,
                'status'           => 'published',
                'tier'             => 'premium',
                'is_featured'      => false,
                'views_count'      => 987,
            ],
            [
                'user_id'          => $ownerEfua?->id ?? $admin?->id,
                'name'             => 'Akara Sweets & Pastry',
                'description'      => 'Home-style Ghanaian pastry shop baking fresh chin chin, bofrot, sugar bread, and mandazi daily. Custom cakes for weddings, funerals, and corporate events. Orders via WhatsApp accepted.',
                'category_id'      => $catRestaurant?->id,
                'region_id'        => $regionAccra?->id,
                'district_id'      => $districtAccra?->id,
                'address_text'     => 'Near Accra Technical University, Barnes Road, Accra',
                'ghanapost_gps'    => 'GA-056-7890',
                'lat'              => '5.5540',
                'lng'              => '-0.2103',
                'phone'            => '+233302775050',
                'whatsapp_number'  => '+233244505005',
                'email'            => 'orders@akarasweets.com',
                'momo_mtn'         => '0244505005',
                'hours'            => array_merge($hours, [
                    'saturday' => ['open' => '07:00', 'close' => '18:00', 'closed' => false],
                    'sunday'   => ['open' => '08:00', 'close' => '13:00', 'closed' => false],
                ]),
                'status'           => 'published',
                'tier'             => 'standard',
                'is_featured'      => false,
                'views_count'      => 654,
            ],
            // --- ASHANTI ---
            [
                'user_id'          => $ownerAbena?->id ?? $admin?->id,
                'name'             => 'Kurofa Batik Studio',
                'description'      => 'Artisan tie-dye and batik fabric studio in Kumasi\'s Kejetia precinct. We produce yardage, ready-to-wear, and bespoke garments for local and international buyers. Workshop tours available Saturdays.',
                'category_id'      => $catRetail?->id,
                'region_id'        => $regionAshanti?->id,
                'district_id'      => $districtKumasi?->id,
                'address_text'     => 'Kejetia Market Row 7, Booth 22, Kumasi',
                'ghanapost_gps'    => 'AK-032-4321',
                'lat'              => '6.6884',
                'lng'              => '-1.6244',
                'phone'            => '+233322024000',
                'whatsapp_number'  => '+233244606006',
                'email'            => 'studio@kurofa.com',
                'website'          => 'https://kurofa.com',
                'momo_mtn'         => '0244606006',
                'hours'            => $hours,
                'status'           => 'published',
                'tier'             => 'standard',
                'is_featured'      => true,
                'views_count'      => 1123,
            ],
            [
                'user_id'          => $ownerNana?->id ?? $admin?->id,
                'name'             => 'Osei Logistics & Haulage',
                'description'      => 'Road freight, last-mile delivery, and warehouse services connecting Kumasi to all major regions. Fleet of 30 refrigerated and dry-cargo trucks. Same-day delivery within the Ashanti Region.',
                'category_id'      => $catTransport?->id,
                'region_id'        => $regionAshanti?->id,
                'district_id'      => $districtKumasi?->id,
                'address_text'     => 'Adum-Kumasi Road, Near Santasi Roundabout, Kumasi',
                'ghanapost_gps'    => 'AK-076-8765',
                'lat'              => '6.6831',
                'lng'              => '-1.6256',
                'phone'            => '+233322058800',
                'whatsapp_number'  => '+233244707007',
                'email'            => 'dispatch@oseilogistics.com',
                'website'          => 'https://oseilogistics.com',
                'hours'            => array_merge($hours, ['sunday' => ['open' => '08:00', 'close' => '16:00', 'closed' => false]]),
                'status'           => 'published',
                'tier'             => 'premium',
                'is_featured'      => false,
                'views_count'      => 778,
            ],
            [
                'user_id'          => $ownerKwesi?->id ?? $admin?->id,
                'name'             => 'Armah Organic Farms',
                'description'      => 'Certified organic cocoa, plantain, cassava, and yam farm delivering fresh produce direct to Kumasi and Accra markets. Farm tours and agritourism packages available. CSA subscription boxes delivered weekly.',
                'category_id'      => $catAgri?->id,
                'region_id'        => $regionAshanti?->id,
                'district_id'      => $districtKumasi?->id,
                'address_text'     => 'Ejisu-Juaben Road, 12km from Kumasi',
                'ghanapost_gps'    => 'AK-201-5050',
                'lat'              => '6.7320',
                'lng'              => '-1.4750',
                'phone'            => '+233322090909',
                'whatsapp_number'  => '+233244808008',
                'email'            => 'farm@armahfarms.com',
                'momo_mtn'         => '0244808008',
                'hours'            => array_merge($hours, [
                    'saturday' => ['open' => '07:00', 'close' => '13:00', 'closed' => false],
                    'sunday'   => ['open' => '07:00', 'close' => '12:00', 'closed' => false],
                ]),
                'status'           => 'published',
                'tier'             => 'standard',
                'is_featured'      => false,
                'views_count'      => 489,
            ],
            // --- WESTERN ---
            [
                'user_id'          => $ownerAdwoa?->id ?? $admin?->id,
                'name'             => 'Nyarko African Fashion House',
                'description'      => 'Contemporary African fashion label based in Takoradi. Ready-to-wear and bespoke collections blending Kente, Kaba & Slit, and Batik into modern silhouettes. Stockists in London and Amsterdam.',
                'category_id'      => $catRetail?->id,
                'region_id'        => $regionWestern?->id,
                'district_id'      => $districtTakoradi?->id,
                'address_text'     => '7 Market Circle, Takoradi',
                'ghanapost_gps'    => 'WR-011-2233',
                'lat'              => '4.8982',
                'lng'              => '-1.7550',
                'phone'            => '+233312023000',
                'whatsapp_number'  => '+233244909009',
                'email'            => 'collections@nyarkofashion.com',
                'website'          => 'https://nyarkofashion.com',
                'hours'            => $hours,
                'status'           => 'published',
                'tier'             => 'premium',
                'is_featured'      => true,
                'views_count'      => 934,
            ],
            // --- CENTRAL ---
            [
                'user_id'          => $ownerFiifi?->id ?? $admin?->id,
                'name'             => 'Antwi Realty & Properties',
                'description'      => 'Licensed estate agency covering Greater Cape Coast, Elmina, and the Central Region coast. Residential sales, commercial leases, and holiday rental management. 150+ active listings.',
                'category_id'      => $catRealEstate?->id,
                'region_id'        => $regionCentral?->id,
                'district_id'      => $districtCape?->id,
                'address_text'     => 'Cape Coast Castle Road, Cape Coast',
                'ghanapost_gps'    => 'CR-088-4455',
                'lat'              => '5.1054',
                'lng'              => '-1.2467',
                'phone'            => '+233332095000',
                'whatsapp_number'  => '+233244010010',
                'email'            => 'info@antwirealty.com',
                'website'          => 'https://antwirealty.com',
                'hours'            => $hours,
                'status'           => 'published',
                'tier'             => 'standard',
                'is_featured'      => false,
                'views_count'      => 567,
            ],
            // --- Extra businesses seeded by admin for variety ---
            [
                'user_id'          => $admin?->id,
                'name'             => 'Golden Palm Beach Resort',
                'description'      => 'Boutique beachfront resort in Ada Foah with 24 en-suite rooms, infinity pool, water sports, and a restaurant serving fresh seafood. Perfect for corporate retreats and family holidays.',
                'category_id'      => $catHospitality?->id,
                'region_id'        => $regionAccra?->id,
                'district_id'      => $districtAccra?->id,
                'address_text'     => 'Ada Foah Beach, Ada Foah',
                'ghanapost_gps'    => 'GA-500-9999',
                'lat'              => '5.7841',
                'lng'              => '0.6333',
                'phone'            => '+233302999111',
                'whatsapp_number'  => '+233244111111',
                'email'            => 'reservations@goldenpalm.com.gh',
                'website'          => 'https://goldenpalm.com.gh',
                'hours'            => array_merge($hours, ['sunday' => ['open' => '08:00', 'close' => '20:00', 'closed' => false]]),
                'status'           => 'published',
                'tier'             => 'premium',
                'is_featured'      => true,
                'views_count'      => 2750,
            ],
            [
                'user_id'          => $admin?->id,
                'name'             => 'Tema Steel & Fabrication',
                'description'      => 'Industrial steel fabrication, structural welding, and construction materials supply. ISO 9001 certified. Supplying infrastructure projects across Ghana and West Africa since 1995.',
                'category_id'      => $catServices?->id,
                'region_id'        => $regionAccra?->id,
                'district_id'      => $districtTema?->id,
                'address_text'     => 'Free Zone Enclave, Community 11, Tema',
                'ghanapost_gps'    => 'GA-430-1122',
                'lat'              => '5.6720',
                'lng'              => '-0.0082',
                'phone'            => '+233303400200',
                'whatsapp_number'  => '+233244222222',
                'email'            => 'sales@temasteel.com',
                'website'          => 'https://temasteel.com',
                'hours'            => $hours,
                'status'           => 'published',
                'tier'             => 'standard',
                'is_featured'      => false,
                'views_count'      => 431,
            ],
            [
                'user_id'          => $admin?->id,
                'name'             => 'Volta River Canoe Tours',
                'description'      => 'Guided canoe and motorboat tours on the Volta River and Lake Volta, departing from Ho. Day trips, sunset cruises, and multi-day expeditions to Kpando and Keta. Experienced guides, life jackets provided.',
                'category_id'      => $catHospitality?->id,
                'region_id'        => $regionVolta?->id,
                'district_id'      => $districtHo?->id,
                'address_text'     => 'Adaklu Waterway Jetty, Ho',
                'ghanapost_gps'    => 'VR-034-6677',
                'lat'              => '6.6006',
                'lng'              => '0.4697',
                'phone'            => '+233362026000',
                'whatsapp_number'  => '+233244333333',
                'email'            => 'book@voltacanoe.com',
                'hours'            => array_merge($hours, ['sunday' => ['open' => '07:00', 'close' => '17:00', 'closed' => false]]),
                'status'           => 'published',
                'tier'             => 'standard',
                'is_featured'      => true,
                'views_count'      => 1210,
            ],
            [
                'user_id'          => $admin?->id,
                'name'             => 'Kumasi Rooftop Kitchen',
                'description'      => 'Rooftop restaurant in Adum serving elevated versions of Ghanaian classics — fufu with light soup, red-red, grilled tilapia, and kelewele — alongside cocktails and live music on Friday nights.',
                'category_id'      => $catRestaurant?->id,
                'region_id'        => $regionAshanti?->id,
                'district_id'      => $districtKumasi?->id,
                'address_text'     => '5th Floor, Adum Commercial Complex, Kumasi',
                'ghanapost_gps'    => 'AK-055-1199',
                'lat'              => '6.6885',
                'lng'              => '-1.6233',
                'phone'            => '+233322044444',
                'whatsapp_number'  => '+233244444444',
                'email'            => 'dine@kumasirooftop.com',
                'hours'            => array_merge($hours, ['sunday' => ['open' => '12:00', 'close' => '22:00', 'closed' => false]]),
                'status'           => 'published',
                'tier'             => 'premium',
                'is_featured'      => true,
                'views_count'      => 1876,
            ],
            [
                'user_id'          => $admin?->id,
                'name'             => 'HealthFirst Medical Centre',
                'description'      => 'Private clinic offering general practice, specialist consultations (cardiology, dermatology, gynecology), laboratory, pharmacy, and 24-hour emergency care. All HMO and NHIS plans accepted.',
                'category_id'      => $catServices?->id,
                'region_id'        => $regionAccra?->id,
                'district_id'      => $districtAccra?->id,
                'address_text'     => '22 Liberation Road, North Ridge, Accra',
                'ghanapost_gps'    => 'GA-188-2244',
                'lat'              => '5.5790',
                'lng'              => '-0.1945',
                'phone'            => '+233302766000',
                'whatsapp_number'  => '+233244555555',
                'email'            => 'appointments@healthfirst.com.gh',
                'website'          => 'https://healthfirst.com.gh',
                'hours'            => array_merge($hours, ['sunday' => ['open' => '08:00', 'close' => '20:00', 'closed' => false]]),
                'status'           => 'published',
                'tier'             => 'premium',
                'is_featured'      => false,
                'views_count'      => 2100,
            ],
            [
                'user_id'          => $admin?->id,
                'name'             => 'Takoradi Oil & Gas Services',
                'description'      => 'Oilfield support services, equipment rental, and HSE training in the Jubilee and TEN oil fields corridor. Approved vendor for GNPC, Tullow Oil, and ENI Ghana.',
                'category_id'      => $catServices?->id,
                'region_id'        => $regionWestern?->id,
                'district_id'      => $districtTakoradi?->id,
                'address_text'     => 'Harbour Road Industrial Area, Takoradi',
                'ghanapost_gps'    => 'WR-022-3344',
                'lat'              => '4.9016',
                'lng'              => '-1.7540',
                'phone'            => '+233312025500',
                'whatsapp_number'  => '+233244666666',
                'email'            => 'contracts@takoradioilgas.com',
                'website'          => 'https://takoradioilgas.com',
                'hours'            => $hours,
                'status'           => 'published',
                'tier'             => 'standard',
                'is_featured'      => false,
                'views_count'      => 310,
            ],
            // Pending review business
            [
                'user_id'          => $admin?->id,
                'name'             => 'Savannah Honey Collective',
                'description'      => 'Artisanal bee-keeping cooperative from the Northern Region producing raw, unfiltered honey, beeswax candles, and propolis tinctures. Fair-trade certified. Supplying premium hotels nationwide.',
                'category_id'      => $catAgri?->id,
                'region_id'        => Region::where('name', 'Northern')->first()?->id ?? $regionAccra?->id,
                'district_id'      => District::where('name', 'Tamale Metropolitan')->first()?->id ?? $districtAccra?->id,
                'address_text'     => 'Savelugu Road, Tamale',
                'ghanapost_gps'    => 'NR-099-8888',
                'lat'              => '9.4008',
                'lng'              => '-0.8393',
                'phone'            => '+233372022999',
                'whatsapp_number'  => '+233244777777',
                'email'            => 'honey@savannah-collective.com',
                'momo_airteltigo'  => '0577777777',
                'hours'            => $hours,
                'status'           => 'pending',
                'tier'             => 'free',
                'is_featured'      => false,
                'views_count'      => 45,
            ],
        ];

        foreach ($businesses as $data) {
            // Skip if user_id is null
            if (empty($data['user_id'])) {
                continue;
            }
            Business::firstOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}
