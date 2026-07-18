<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewsSeeder extends Seeder
{
    public function run(): void
    {
        // Collect reviewer users
        $reviewerEmails = [
            'maame.baah@email.com',
            'elikem.tetteh@email.com',
            'patience.owusu@email.com',
            'godfred.agyei@email.com',
            'ama.dankwa@email.com',
            'bernard.asiedu@email.com',
            'abigail.quaye@email.com',
            'emmanuel.frimpong@email.com',
        ];

        $reviewers = User::whereIn('email', $reviewerEmails)->get();
        if ($reviewers->isEmpty()) {
            return;
        }

        $reviewData = [
            'Kente & Kaba Ghana' => [
                [
                    'rating' => 5,
                    'body'   => 'Outstanding Kente quality! I ordered a bespoke Kaba & Slit set for my sister\'s wedding and they delivered exactly on time with immaculate craftsmanship. The Bonwire weave is authentic and vibrant. Will definitely order again for our family\'s outdooring ceremony.',
                    'status' => 'approved',
                    'owner_response' => 'Thank you so much for this wonderful review! Congratulations to your sister. We take great pride in sourcing directly from the weavers at Bonwire, and reviews like yours inspire the whole team.',
                ],
                [
                    'rating' => 5,
                    'body'   => 'I am from the diaspora and purchased three Kente yards to take back to the UK. The packaging was excellent and they even included a card explaining the symbolism of the patterns I chose. Exceptional service.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 4,
                    'body'   => 'Very good selection of dashiki shirts in modern cuts. The sizing runs slightly large — I would recommend going one size down. Prices are fair for the quality.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 5,
                    'body'   => 'Bought two Krobo bead necklaces as gifts. Each piece is unique and beautifully handcrafted. The staff were very knowledgeable about the cultural meaning of each design.',
                    'status' => 'approved',
                ],
            ],
            'Ghana Spice Market' => [
                [
                    'rating' => 5,
                    'body'   => 'Best quality prekese I have found in Accra. The aroma is exactly right — deep and resinous. I use it in every batch of palm soup I make. Bought 2kg and very happy with the price.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 4,
                    'body'   => 'The shea butter is genuinely raw and unrefined — you can tell by the smell and texture. My skin has never been happier. Only minus is parking near Makola is chaotic.',
                    'status' => 'approved',
                    'owner_response' => 'We appreciate your kind words! Parking near Makola is indeed a challenge — we are looking into a click-and-collect option. Watch this space!',
                ],
                [
                    'rating' => 5,
                    'body'   => 'I run a restaurant in East Legon and this is my go-to spice supplier. Their mixed bundle saves me time and the quality is consistently good. Akosua and the team are very professional.',
                    'status' => 'approved',
                ],
            ],
            'Accra Fresh Supermarket' => [
                [
                    'rating' => 4,
                    'body'   => 'Clean, well-stocked supermarket in Tema. The fresh fish counter is the star — the tilapia is genuinely fresh and they clean it while you wait. Prices are a little higher than the market but the convenience is worth it.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 5,
                    'body'   => 'Excellent! The organic plantain section is a revelation. They source directly from Brong Ahafo farms and you can taste the difference. The cooking gas refill service is also super convenient.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 3,
                    'body'   => 'Generally good but the checkout queues on weekends are very long. Could do with more cashier desks. The produce quality is good though.',
                    'status' => 'approved',
                    'owner_response' => 'Thank you for this honest feedback. We are aware of weekend queuing and are in the process of installing two additional self-checkout kiosks. We hope to have these live by end of quarter.',
                ],
            ],
            'DarkoTech Solutions' => [
                [
                    'rating' => 5,
                    'body'   => 'DarkoTech built our company website and installed our office CCTV system. Both were delivered on time and within budget. Their after-sales support is excellent — I called with a question three months after delivery and they helped me immediately.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 5,
                    'body'   => 'We hired DarkoTech for a cloud migration project and were impressed from start to finish. Their engineers are certified and clearly know AWS very well. Our downtime during the migration was less than two hours.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 4,
                    'body'   => 'Good IT support retainer service. Response times are fast for remote issues. Occasionally the on-site visit scheduling takes longer than expected but overall very satisfied.',
                    'status' => 'approved',
                ],
            ],
            'Akara Sweets & Pastry' => [
                [
                    'rating' => 5,
                    'body'   => 'The chin chin here is the best in Accra — no exaggeration. Perfectly crunchy, not too sweet, and clearly made with good coconut oil. I order 2kg every month for my family.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 5,
                    'body'   => 'Ordered a 2-tier wedding cake with 72 hours notice and was absolutely amazed at the result. The fondant work was precise and the sponge inside was moist and flavourful. Cannot recommend highly enough.',
                    'status' => 'approved',
                    'owner_response' => 'Congratulations on your wedding! It was an honour to be part of your special day. Thank you for trusting us with such an important task!',
                ],
                [
                    'rating' => 4,
                    'body'   => 'The kelewele is fantastic — very well spiced and not greasy at all. The bofrot are also good though a bit inconsistent in size. Still one of my favourite spots near Barnes Road.',
                    'status' => 'approved',
                ],
            ],
            'Kurofa Batik Studio' => [
                [
                    'rating' => 5,
                    'body'   => 'I attended the half-day workshop with my daughter and we had an unforgettable experience. Abena is a gifted teacher — patient and passionate. We went home with our own batik pieces and a deep appreciation for the craft.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 5,
                    'body'   => 'The tie-dye t-shirts are of outstanding quality. I bought 6 as corporate gifts and every recipient loved theirs. The colours are vibrant and have not faded after multiple washes.',
                    'status' => 'approved',
                    'owner_response' => 'So glad your team loved the shirts! We use reactive dyes specifically for their colourfastness. Thank you for supporting the studio!',
                ],
                [
                    'rating' => 4,
                    'body'   => 'Lovely batik fabric in beautiful earthy tones. As advertised, no two pieces are the same. Took one star off only because the description on the listing didn\'t mention minimum order sizes. Otherwise perfect.',
                    'status' => 'approved',
                ],
            ],
            'Osei Logistics & Haulage' => [
                [
                    'rating' => 5,
                    'body'   => 'We use Osei Logistics for all our Kumasi–Accra freight and have never been disappointed. Their drivers are professional and the refrigerated vehicles keep our produce in perfect condition. Highly recommended for perishables.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 4,
                    'body'   => 'Reliable same-day delivery within Kumasi. The pricing is competitive and the dispatch team is responsive on WhatsApp. Occasionally tracking updates could be more frequent.',
                    'status' => 'approved',
                ],
            ],
            'Armah Organic Farms' => [
                [
                    'rating' => 5,
                    'body'   => 'The agritourism day tour was one of the highlights of our trip to Ghana. Kwesi is an incredibly knowledgeable guide and the farm lunch prepared from their own produce was outstanding. A must-do for food lovers.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 5,
                    'body'   => 'I subscribe to the weekly CSA box and it has transformed how my family eats. The plantain and cassava are always fresh and the honey is a revelation — nothing like the supermarket stuff. Highly recommended.',
                    'status' => 'approved',
                    'owner_response' => 'Thank you! Supporting healthy eating across Ghana is our mission. We are glad the weekly box is bringing good food to your table!',
                ],
                [
                    'rating' => 4,
                    'body'   => 'Excellent organic cocoa beans — our craft chocolate maker confirmed they have good flavour development. Delivery from the farm to Accra takes 2 days which is reasonable. Would be great if they could do express shipping.',
                    'status' => 'approved',
                ],
            ],
            'Nyarko African Fashion House' => [
                [
                    'rating' => 5,
                    'body'   => 'Adwoa\'s designs are extraordinary — a perfect blend of contemporary fashion and African heritage. I wore the Kente-trim blazer to a conference in London and received compliments all day. A truly world-class label based right here in Ghana.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 5,
                    'body'   => 'My bespoke suit is the finest piece of clothing I own. The craftsmanship is impeccable and the Kente collar detail is subtle but stunning. The 10-day wait was absolutely worth it.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 4,
                    'body'   => 'The Ankara maxi dress is beautiful and very well made. The only issue is that the sizing chart on the website runs small — I needed a larger size than expected. Customer service was helpful in arranging an exchange.',
                    'status' => 'approved',
                    'owner_response' => 'Thank you for this feedback! We have updated our sizing guide with additional measurements to help customers choose more accurately. Sorry for the inconvenience.',
                ],
            ],
            'Antwi Realty & Properties' => [
                [
                    'rating' => 5,
                    'body'   => 'Fiifi and the Antwi Realty team helped us find and purchase our home in Cape Coast within 6 weeks. They handled all the paperwork, legal checks, and negotiations efficiently. Professional, honest, and deeply knowledgeable about the Central Region property market.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 4,
                    'body'   => 'Good agency with a wide range of listings. The property valuation report was thorough and accepted by our bank without any issues. Communication was always timely.',
                    'status' => 'approved',
                ],
            ],
            'Golden Palm Beach Resort' => [
                [
                    'rating' => 5,
                    'body'   => 'We celebrated our honeymoon here and it was absolutely magical. The sea-view room is spacious, beautifully furnished, and the sound of the waves at night is unforgettable. The sunset dinner exceeded all expectations.',
                    'status' => 'approved',
                    'owner_response' => 'Congratulations on your wedding! We are so happy we could be part of such a special milestone. Do come back for your anniversary — we\'ll make it equally memorable!',
                ],
                [
                    'rating' => 5,
                    'body'   => 'Organised a 2-night corporate retreat for 18 staff here. The resort handled everything — rooms, catering, team activities, and water sports. The management was responsive and every detail was executed perfectly.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 4,
                    'body'   => 'Stunning location and very comfortable rooms. The water skiing was a highlight for the whole family. Only deducted one star because the Wi-Fi in the rooms is weak. Hopefully they upgrade it soon.',
                    'status' => 'approved',
                ],
            ],
            'Kumasi Rooftop Kitchen' => [
                [
                    'rating' => 5,
                    'body'   => 'The best fufu and light soup I have had in Kumasi. The soup has a deep, smoky flavour and the fufu is pounded to the perfect consistency — not too stiff, not too soft. The rooftop setting at sunset is magical.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 5,
                    'body'   => 'Came for the Friday night live music with friends and had a sensational time. The grilled tilapia with banku was spectacular — the charcoal flavour was incredible. The VIP table experience is worth every pesewa.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 4,
                    'body'   => 'Excellent food and atmosphere. The kelewele is perfectly spiced. Service can be slow when the restaurant is full but the staff are friendly and always apologetic. Overall a great Kumasi dining experience.',
                    'status' => 'approved',
                    'owner_response' => 'Thank you for the kind words and honest feedback! We are training additional wait staff to improve service speed on busy nights. We look forward to seeing you again!',
                ],
            ],
            'HealthFirst Medical Centre' => [
                [
                    'rating' => 5,
                    'body'   => 'I have been attending HealthFirst for two years and the quality of care is consistently excellent. My GP, Dr. Mensah, is thorough and takes time to explain diagnoses properly. The lab results are reliably fast.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 5,
                    'body'   => 'The antenatal package is outstanding value. I was seen by the same doctor throughout my pregnancy which gave me great confidence. The delivery planning sessions were especially helpful for first-time parents.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 4,
                    'body'   => 'Good clinic with professional staff. The malaria RDT was fast and accurate. The waiting area can get crowded on Monday mornings — an appointment booking app would help a lot.',
                    'status' => 'approved',
                ],
            ],
            'Volta River Canoe Tours' => [
                [
                    'rating' => 5,
                    'body'   => 'The full-day canoe expedition through the Volta gorge was one of the most memorable experiences of my life. Our guide, Emmanuel, was knowledgeable about the local ecology and history. Absolutely worth every cedi.',
                    'status' => 'approved',
                ],
                [
                    'rating' => 5,
                    'body'   => 'Brought my family on the sunset river cruise and the children are still talking about it weeks later. The scenery is breathtaking and the snacks were a nice touch. Safety equipment was provided and the crew were professional.',
                    'status' => 'approved',
                    'owner_response' => 'Wonderful to hear the whole family enjoyed it! Children\'s safety is our top priority on every trip. We hope to see you again on the Keta Lagoon day tour!',
                ],
            ],
        ];

        $reviewerIndex = 0;
        $reviewerCount = $reviewers->count();

        foreach ($reviewData as $businessName => $reviews) {
            $business = Business::where('name', $businessName)->first();
            if (!$business) {
                continue;
            }

            foreach ($reviews as $reviewItem) {
                $reviewer = $reviewers[$reviewerIndex % $reviewerCount];
                $reviewerIndex++;

                // Check if this reviewer already reviewed this business
                $existing = Review::where('business_id', $business->id)
                    ->where('user_id', $reviewer->id)
                    ->first();

                if (!$existing) {
                    $data = [
                        'business_id' => $business->id,
                        'user_id'     => $reviewer->id,
                        'rating'      => $reviewItem['rating'],
                        'body'        => $reviewItem['body'],
                        'status'      => $reviewItem['status'],
                    ];

                    if (!empty($reviewItem['owner_response'])) {
                        $data['owner_response']    = $reviewItem['owner_response'];
                        $data['owner_response_at'] = now()->subDays(rand(1, 7));
                    }

                    Review::create($data);
                }
            }
        }
    }
}
