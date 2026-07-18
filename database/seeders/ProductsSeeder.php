<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $ghs = Currency::where('code', 'GHS')->first();
        if (!$ghs) {
            return;
        }

        $catalogue = [
            'Kente & Kaba Ghana' => [
                ['name' => 'Bonwire Kente Cloth (6 yards)', 'description' => 'Authentic handwoven Kente from Bonwire, featuring traditional Asante patterns in bold red, gold, and green. Ideal for funerals, festivals, and graduation ceremonies.', 'price' => 650.00, 'unit' => 'piece', 'type' => 'physical'],
                ['name' => 'Kaba & Slit Set (Bespoke)', 'description' => 'Custom-tailored Kaba & Slit made from your chosen fabric. Measurements taken in-store. Delivery in 5 working days.', 'price' => 320.00, 'unit' => 'set', 'type' => 'service'],
                ['name' => 'Dashiki Short-Sleeve Shirt', 'description' => 'Contemporary dashiki in Ankara print. Available in S–3XL. Machine washable. Ready to ship.', 'price' => 95.00, 'unit' => 'piece', 'type' => 'physical'],
                ['name' => 'Koforidua Beads Necklace', 'description' => 'Handcrafted Krobo glass-bead necklace. Each piece is unique — colours vary. Perfect gift item.', 'price' => 55.00, 'unit' => 'piece', 'type' => 'physical'],
                ['name' => 'Wedding Kente Package (Couple)', 'description' => 'Full kente outfit for bride and groom including head wraps, sash, and accessories. Consultation required.', 'price' => 1850.00, 'unit' => 'package', 'type' => 'service'],
            ],
            'Ghana Spice Market' => [
                ['name' => 'Prekese (Aidan Fruit) — 500g', 'description' => 'Sun-dried Tetrapleura tetraptera pods used in palm soup and medicinal brews. Sold in sealed food-grade pouches.', 'price' => 18.00, 'unit' => 'bag', 'type' => 'physical'],
                ['name' => 'Grains of Selim — 200g', 'description' => 'Aromatic Ghanaian pepper (wisa) for soups, stews, and herbal teas. Freshly dried batch.', 'price' => 12.00, 'unit' => 'bag', 'type' => 'physical'],
                ['name' => 'Dawadawa (Locust Bean) — 300g', 'description' => 'Fermented locust bean for rich umami depth in light soups and groundnut soup. Strong aroma.', 'price' => 14.50, 'unit' => 'bag', 'type' => 'physical'],
                ['name' => 'Raw Shea Butter — 1kg', 'description' => 'Unrefined, cold-pressed shea butter sourced directly from the Upper West Region. Suitable for skin care and cooking.', 'price' => 45.00, 'unit' => 'kg', 'type' => 'physical'],
                ['name' => 'Mixed Spice Bundle (5-pack)', 'description' => 'Curated bundle: prekese, selim, dawadawa, uziza leaves, and African nutmeg. Great for gifting.', 'price' => 60.00, 'unit' => 'bundle', 'type' => 'physical'],
            ],
            'Accra Fresh Supermarket' => [
                ['name' => 'Fresh Tilapia (per kg)', 'description' => 'Live-weight tilapia from Volta Lake, cleaned and gutted on request. Ice-packed for freshness.', 'price' => 35.00, 'unit' => 'kg', 'type' => 'physical'],
                ['name' => 'Organic Plantain (bunch)', 'description' => 'Yellow ripe plantain from Brong Ahafo farms. Approximately 10–12 fingers per bunch.', 'price' => 22.00, 'unit' => 'bunch', 'type' => 'physical'],
                ['name' => 'FanMilk Ice Cream (500ml)', 'description' => 'Classic Ghana FanMilk vanilla ice cream in a resealable tub. Stored at -18°C.', 'price' => 28.00, 'unit' => 'tub', 'type' => 'physical'],
                ['name' => 'Cooking Gas Refill (12.5kg)', 'description' => 'LPG cylinder refill service available in-store. Bring your own cylinder or purchase from us.', 'price' => 195.00, 'unit' => 'cylinder', 'type' => 'service'],
            ],
            'DarkoTech Solutions' => [
                ['name' => 'Business Website (5-page)', 'description' => 'Responsive website design and development: up to 5 pages, contact form, Google Maps integration, 1 year hosting.', 'price' => 3500.00, 'unit' => 'project', 'type' => 'service'],
                ['name' => 'CCTV Installation (8 cameras)', 'description' => 'Supply and installation of 8-channel HD CCTV system with mobile app access. 3-year warranty on hardware.', 'price' => 4200.00, 'unit' => 'project', 'type' => 'service'],
                ['name' => 'Cloud Migration Consulting', 'description' => 'Assessment, planning, and execution of cloud migration from on-premise to AWS or Azure. Per-day rate.', 'price' => 1800.00, 'unit' => 'day', 'type' => 'service'],
                ['name' => 'IT Support Retainer (monthly)', 'description' => 'Monthly on-call IT support covering up to 20 endpoints. Includes remote assistance and 2 on-site visits.', 'price' => 2200.00, 'unit' => 'month', 'type' => 'service'],
            ],
            'Akara Sweets & Pastry' => [
                ['name' => 'Chin Chin (500g bag)', 'description' => 'Crunchy deep-fried chin chin in coconut and plain flavours. Baked fresh every morning.', 'price' => 15.00, 'unit' => 'bag', 'type' => 'physical'],
                ['name' => 'Bofrot (10 pieces)', 'description' => 'Soft, fluffy Ghanaian-style donuts lightly sweetened with sugar. Best enjoyed warm.', 'price' => 12.00, 'unit' => 'pack', 'type' => 'physical'],
                ['name' => 'Custom Celebration Cake (2-tier)', 'description' => '2-tier custom fondant cake with personalised message and decoration. Minimum 72-hour notice required.', 'price' => 380.00, 'unit' => 'cake', 'type' => 'service'],
                ['name' => 'Kelewele (spiced fried plantain)', 'description' => 'Traditional spiced and fried ripe plantain seasoned with ginger, clove, and anise. 300g portion.', 'price' => 18.00, 'unit' => 'portion', 'type' => 'physical'],
            ],
            'Kurofa Batik Studio' => [
                ['name' => 'Hand-dyed Batik Fabric (3 yards)', 'description' => 'Individually wax-resist dyed batik in earthy terracotta, indigo, and ochre tones. No two pieces identical.', 'price' => 180.00, 'unit' => 'piece', 'type' => 'physical'],
                ['name' => 'Tie-Dye T-Shirt (unisex)', 'description' => 'Pre-shrunk cotton jersey t-shirt in tie-dye swirl pattern. Sizes S–XXL. Eco-friendly reactive dyes.', 'price' => 65.00, 'unit' => 'piece', 'type' => 'physical'],
                ['name' => 'Studio Workshop (half-day)', 'description' => 'Hands-on batik/tie-dye workshop for individuals or groups (up to 10). All materials included.', 'price' => 120.00, 'unit' => 'person', 'type' => 'service'],
                ['name' => 'Batik Table Runner (2m)', 'description' => 'Decorative hand-dyed table runner for dining tables, events, and interior décor. Dry-clean only.', 'price' => 95.00, 'unit' => 'piece', 'type' => 'physical'],
            ],
            'Osei Logistics & Haulage' => [
                ['name' => 'Kumasi–Accra Dry Freight (per tonne)', 'description' => 'Door-to-door dry cargo freight. Minimum 1 tonne. Transit time 4–6 hours. Insurance available.', 'price' => 420.00, 'unit' => 'tonne', 'type' => 'service'],
                ['name' => 'Same-Day Local Delivery (Ashanti)', 'description' => 'Express pick-up and delivery anywhere within the Ashanti Region. Up to 200kg payload.', 'price' => 150.00, 'unit' => 'trip', 'type' => 'service'],
                ['name' => 'Refrigerated Transport (per day)', 'description' => 'Cold-chain vehicle rental with driver for perishable goods. Temperature-logged. Food-safety compliant.', 'price' => 1200.00, 'unit' => 'day', 'type' => 'service'],
            ],
            'Armah Organic Farms' => [
                ['name' => 'Organic Cocoa Beans (25kg bag)', 'description' => 'Certified organic, sun-dried Ashanti cocoa beans. Suitable for craft chocolate makers and export.', 'price' => 320.00, 'unit' => 'bag', 'type' => 'physical'],
                ['name' => 'Fresh Plantain — Farm Gate Price (bunch)', 'description' => 'Unripe green plantain direct from the farm. Best for chips, ampesi, and fufu. Sold in 10-finger bunches.', 'price' => 15.00, 'unit' => 'bunch', 'type' => 'physical'],
                ['name' => 'Weekly CSA Box (family size)', 'description' => 'Weekly subscription box: 5kg seasonal vegetables, 1 bunch plantain, 2kg cassava, and 1 bottle raw honey. Delivered to Kumasi.', 'price' => 95.00, 'unit' => 'week', 'type' => 'service'],
                ['name' => 'Agritourism Day Tour', 'description' => 'Half-day guided tour of cocoa and plantain farms. Includes farm-fresh lunch, harvest experience, and gift pack.', 'price' => 75.00, 'unit' => 'person', 'type' => 'service'],
            ],
            'Nyarko African Fashion House' => [
                ['name' => 'Kente-Trim Blazer', 'description' => 'Premium tailored blazer in neutral linen with Kente strip collar and cuff accents. Sizes 36–50.', 'price' => 480.00, 'unit' => 'piece', 'type' => 'physical'],
                ['name' => 'Ankara Maxi Dress', 'description' => 'Floor-length Ankara print dress with flared skirt and puff sleeves. Ready-to-wear. Sizes S–3XL.', 'price' => 220.00, 'unit' => 'piece', 'type' => 'physical'],
                ['name' => 'Bespoke Suit (African-inspired)', 'description' => 'Full bespoke suit with Kente details and your choice of base fabric. Takes 10 working days. Consultation required.', 'price' => 1400.00, 'unit' => 'suit', 'type' => 'service'],
                ['name' => 'Slit & Kaba (ready-to-wear)', 'description' => 'Classic Ghanaian Slit & Kaba in vibrant wax-print fabric. Available in sizes 8–24.', 'price' => 195.00, 'unit' => 'set', 'type' => 'physical'],
            ],
            'Antwi Realty & Properties' => [
                ['name' => '3-Bedroom House Listing (Cape Coast)', 'description' => 'Sale: fully detached 3-bedroom, 2-bathroom house in Pedu, Cape Coast. Tiled, fenced, with bore hole. GHS 420,000.', 'price' => 420000.00, 'unit' => 'property', 'type' => 'physical'],
                ['name' => 'Commercial Office Space Lease (per month)', 'description' => '80m² ground-floor office on Cape Coast–Accra Road. Ample parking, fibre internet, 24-hour security.', 'price' => 3500.00, 'unit' => 'month', 'type' => 'service'],
                ['name' => 'Property Valuation Report', 'description' => 'GHIS-certified property valuation report for mortgage, tax, and legal purposes. Turnaround: 5 working days.', 'price' => 800.00, 'unit' => 'report', 'type' => 'service'],
            ],
            'Golden Palm Beach Resort' => [
                ['name' => 'Deluxe Sea-View Room (per night)', 'description' => 'Air-conditioned double room with private balcony overlooking the Atlantic. Breakfast included.', 'price' => 680.00, 'unit' => 'night', 'type' => 'service'],
                ['name' => 'Water Ski Session (30 min)', 'description' => 'Guided water-skiing or wake-boarding session on the Volta Estuary. Instructor provided. Minimum age 14.', 'price' => 120.00, 'unit' => 'session', 'type' => 'service'],
                ['name' => 'Sunset Dinner for Two', 'description' => 'Three-course set menu on the beachfront terrace at sunset. Grilled seafood, local specialties, and dessert. Reservation required.', 'price' => 350.00, 'unit' => 'table', 'type' => 'service'],
            ],
            'Kumasi Rooftop Kitchen' => [
                ['name' => 'Fufu with Light Soup', 'description' => 'Classic Ghanaian fufu (pounded cassava & plantain) served with smoky chicken light soup and garden eggs.', 'price' => 55.00, 'unit' => 'portion', 'type' => 'physical'],
                ['name' => 'Grilled Tilapia with Banku', 'description' => 'Whole charcoal-grilled tilapia marinated in shito and ginger, served with Volta banku and hot pepper sauce.', 'price' => 85.00, 'unit' => 'portion', 'type' => 'physical'],
                ['name' => 'Kelewele & Groundnut Soup', 'description' => 'Spiced fried plantain paired with a rich roasted groundnut soup and kontomire.', 'price' => 45.00, 'unit' => 'portion', 'type' => 'physical'],
                ['name' => 'Rooftop VIP Table (Friday night)', 'description' => 'Reserved table for 4 with bottle service and priority service during Friday live music nights. Advance booking only.', 'price' => 500.00, 'unit' => 'table', 'type' => 'service'],
            ],
            'HealthFirst Medical Centre' => [
                ['name' => 'General Practice Consultation', 'description' => 'Standard GP appointment: history, examination, diagnosis, and prescription. Includes basic vitals check.', 'price' => 120.00, 'unit' => 'session', 'type' => 'service'],
                ['name' => 'Full Blood Count (FBC)', 'description' => 'Laboratory blood panel covering haemoglobin, white cell count, platelets, and differentials. Results in 2 hours.', 'price' => 85.00, 'unit' => 'test', 'type' => 'service'],
                ['name' => 'Malaria Rapid Test (RDT)', 'description' => 'Point-of-care malaria antigen rapid diagnostic test. Results in 15 minutes.', 'price' => 30.00, 'unit' => 'test', 'type' => 'service'],
                ['name' => 'Antenatal Package (full)', 'description' => 'Complete antenatal care: 8 visits, ultrasound scans, blood work, nutritional counselling, and delivery planning.', 'price' => 1800.00, 'unit' => 'package', 'type' => 'service'],
            ],
            'Volta River Canoe Tours' => [
                ['name' => 'Sunset River Cruise (2 hours)', 'description' => 'Motorised boat sunset cruise on the Volta River departing 17:00. Snacks and soft drinks included. Maximum 12 passengers.', 'price' => 95.00, 'unit' => 'person', 'type' => 'service'],
                ['name' => 'Full-Day Canoe Expedition', 'description' => 'Guided 8-hour canoe paddle through the Volta gorge. Packed lunch, life jackets, and certified guide included. Min. 4 people.', 'price' => 185.00, 'unit' => 'person', 'type' => 'service'],
                ['name' => 'Keta Lagoon Day Trip', 'description' => 'Group minibus + boat tour to Keta Lagoon and slave fort. Departs 06:00, returns 18:00. Lunch included.', 'price' => 230.00, 'unit' => 'person', 'type' => 'service'],
            ],
            'Savannah Honey Collective' => [
                ['name' => 'Raw Wildflower Honey — 500g', 'description' => 'Cold-extracted, unfiltered savannah wildflower honey. Naturally granulated. No additives.', 'price' => 38.00, 'unit' => 'jar', 'type' => 'physical'],
                ['name' => 'Beeswax Candle Set (3-pack)', 'description' => 'Hand-poured pure beeswax pillar candles in natural golden hue. Approximately 12-hour burn time each.', 'price' => 55.00, 'unit' => 'set', 'type' => 'physical'],
                ['name' => 'Raw Honey Gift Box (1kg)', 'description' => 'Premium gift box: two 500g jars of raw honey with beeswax lip balm and product information leaflet.', 'price' => 95.00, 'unit' => 'box', 'type' => 'physical'],
            ],
        ];

        foreach ($catalogue as $businessName => $products) {
            $business = Business::where('name', $businessName)->first();
            if (!$business) {
                continue;
            }

            foreach ($products as $i => $product) {
                Product::firstOrCreate(
                    [
                        'business_id' => $business->id,
                        'name'        => $product['name'],
                    ],
                    [
                        'description' => $product['description'],
                        'price'       => $product['price'],
                        'currency_id' => $ghs->id,
                        'unit'        => $product['unit'],
                        'type'        => $product['type'],
                        'is_available'=> true,
                        'sort_order'  => $i + 1,
                    ]
                );
            }
        }
    }
}
