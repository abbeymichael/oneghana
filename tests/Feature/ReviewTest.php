<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\Category;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    private User $businessOwner;
    private User $reviewer;
    private Business $business;

    protected function setUp(): void
    {
        parent::setUp();

        $this->businessOwner = User::factory()->create([
            'email_verified_at' => now(),
            'role' => 'business_owner',
        ]);

        $this->reviewer = User::factory()->create([
            'email_verified_at' => now(),
            'role' => 'business_owner',
        ]);

        $category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
        ]);

        $this->business = Business::create([
            'user_id' => $this->businessOwner->id,
            'name' => 'Reviewable Business',
            'slug' => 'reviewable-business-abc123',
            'description' => 'A business that can be reviewed with enough characters for validation.',
            'category_id' => $category->id,
            'phone' => '+233 20 123 4567',
            'status' => 'published',
        ]);
    }

    public function test_review_can_be_created(): void
    {
        $review = Review::create([
            'business_id' => $this->business->id,
            'user_id' => $this->reviewer->id,
            'rating' => 5,
            'body' => 'This is an excellent business. I highly recommend their services to everyone.',
        ]);

        $this->assertDatabaseHas('reviews', [
            'business_id' => $this->business->id,
            'user_id' => $this->reviewer->id,
            'rating' => 5,
        ]);
    }

    public function test_review_defaults_to_pending(): void
    {
        $review = Review::create([
            'business_id' => $this->business->id,
            'user_id' => $this->reviewer->id,
            'rating' => 4,
            'body' => 'Good service overall. Would recommend to friends and family.',
        ]);

        $this->assertEquals('pending', $review->status);
    }

    public function test_review_can_be_approved(): void
    {
        $review = Review::create([
            'business_id' => $this->business->id,
            'user_id' => $this->reviewer->id,
            'rating' => 3,
            'body' => 'Average experience but decent value for money.',
        ]);

        $review->update(['status' => 'approved']);

        $this->assertEquals('approved', $review->fresh()->status);
    }

    public function test_review_can_be_flagged(): void
    {
        $review = Review::create([
            'business_id' => $this->business->id,
            'user_id' => $this->reviewer->id,
            'rating' => 1,
            'body' => 'Very poor experience with this business.',
        ]);

        $review->update(['status' => 'flagged']);

        $this->assertEquals('flagged', $review->fresh()->status);
    }

    public function test_approved_reviews_scope(): void
    {
        Review::create([
            'business_id' => $this->business->id,
            'user_id' => $this->reviewer->id,
            'rating' => 5,
            'body' => 'Excellent business! Five stars all the way.',
            'status' => 'approved',
        ]);

        Review::create([
            'business_id' => $this->business->id,
            'user_id' => $this->reviewer->id,
            'rating' => 4,
            'body' => 'Great business with good customer service.',
            'status' => 'pending',
        ]);

        $this->assertEquals(1, Review::approved()->count());
        $this->assertEquals(1, Review::pending()->count());
    }

    public function test_business_has_approved_reviews_relationship(): void
    {
        Review::create([
            'business_id' => $this->business->id,
            'user_id' => $this->reviewer->id,
            'rating' => 5,
            'body' => 'Five star review that should be approved.',
            'status' => 'approved',
        ]);

        Review::create([
            'business_id' => $this->business->id,
            'user_id' => $this->reviewer->id,
            'rating' => 3,
            'body' => 'Pending review that should not show up in approved.',
            'status' => 'pending',
        ]);

        $this->assertEquals(1, $this->business->approvedReviews()->count());
        $this->assertEquals(2, $this->business->reviews()->count());
    }

    public function test_business_average_rating(): void
    {
        Review::create([
            'business_id' => $this->business->id,
            'user_id' => $this->reviewer->id,
            'rating' => 5,
            'body' => 'Great! Five stars for this wonderful business.',
            'status' => 'approved',
        ]);

        Review::create([
            'business_id' => $this->business->id,
            'user_id' => $this->reviewer->id,
            'rating' => 3,
            'body' => 'Okay. Three stars for average service.',
            'status' => 'approved',
        ]);

        $average = $this->business->averageRating();
        $this->assertEquals(4.0, $average);
    }

    public function test_owner_can_respond_to_review(): void
    {
        $review = Review::create([
            'business_id' => $this->business->id,
            'user_id' => $this->reviewer->id,
            'rating' => 4,
            'body' => 'Good service with room for improvement.',
            'status' => 'approved',
        ]);

        $review->update([
            'owner_response' => 'Thank you for your feedback! We appreciate it.',
            'owner_response_at' => now(),
        ]);

        $this->assertNotNull($review->owner_response);
        $this->assertNotNull($review->owner_response_at);
    }

    public function test_review_belongs_to_user_and_business(): void
    {
        $review = Review::create([
            'business_id' => $this->business->id,
            'user_id' => $this->reviewer->id,
            'rating' => 5,
            'body' => 'Testing relationships for this review feature.',
        ]);

        $this->assertInstanceOf(User::class, $review->user);
        $this->assertInstanceOf(Business::class, $review->business);
        $this->assertEquals($this->reviewer->id, $review->user->id);
        $this->assertEquals($this->business->id, $review->business->id);
    }

    public function test_reviews_count_method(): void
    {
        Review::create([
            'business_id' => $this->business->id,
            'user_id' => $this->reviewer->id,
            'rating' => 5,
            'body' => 'First approved review for counting.',
            'status' => 'approved',
        ]);

        Review::create([
            'business_id' => $this->business->id,
            'user_id' => $this->reviewer->id,
            'rating' => 4,
            'body' => 'Second approved review for counting.',
            'status' => 'approved',
        ]);

        $this->assertEquals(2, $this->business->reviewsCount());
    }
}
