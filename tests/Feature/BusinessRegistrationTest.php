<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\Category;
use App\Models\District;
use App\Models\Region;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BusinessRegistrationTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Category $category;
    private Region $region;
    private District $district;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
        ]);

        $this->region = Region::create(['name' => 'Greater Accra']);

        $this->district = District::create([
            'region_id' => $this->region->id,
            'name' => 'Accra Metropolitan',
        ]);
    }

    public function test_business_registration_page_loads(): void
    {
        $response = $this->actingAs($this->user)->get('/register-business');
        $response->assertStatus(200);
    }

    public function test_guest_cannot_access_business_registration(): void
    {
        $response = $this->get('/register-business');
        $response->assertStatus(302);
    }

    public function test_business_can_be_created_via_direct_model(): void
    {
        $business = Business::create([
            'user_id' => $this->user->id,
            'name' => 'Test Business',
            'slug' => 'test-business-abc123',
            'description' => 'This is a test business description with enough characters to pass validation.',
            'category_id' => $this->category->id,
            'region_id' => $this->region->id,
            'district_id' => $this->district->id,
            'address_text' => '123 Test Street, Accra',
            'ghanapost_gps' => 'GA-123-4567',
            'phone' => '+233 20 123 4567',
            'whatsapp_number' => '+233 20 123 4567',
            'email' => 'business@example.com',
            'website' => 'https://example.com',
            'status' => 'published',
        ]);

        $this->assertDatabaseHas('businesses', [
            'name' => 'Test Business',
            'slug' => 'test-business-abc123',
        ]);

        $this->assertEquals($this->user->id, $business->user_id);
        $this->assertEquals('published', $business->status);
    }

    public function test_business_has_required_fields(): void
    {
        $business = Business::create([
            'user_id' => $this->user->id,
            'name' => 'Minimal Business',
            'slug' => 'minimal-business-def456',
            'description' => 'A minimal business with just enough detail to be valid.',
            'category_id' => $this->category->id,
            'phone' => '+233 20 111 1111',
            'status' => 'published',
        ]);

        $this->assertDatabaseHas('businesses', ['name' => 'Minimal Business']);
        $this->assertNull($business->region_id);
        $this->assertNull($business->whatsapp_number);
    }

    public function test_business_slug_is_auto_generated(): void
    {
        $business = Business::create([
            'user_id' => $this->user->id,
            'name' => 'Auto Slug Business',
            'description' => 'Testing automatic slug generation with enough characters.',
            'category_id' => $this->category->id,
            'phone' => '+233 20 222 2222',
            'status' => 'published',
        ]);

        $this->assertNotNull($business->slug);
        $this->assertStringContainsString('auto-slug-business', $business->slug);
    }

    public function test_business_has_whatsapp_link(): void
    {
        $business = Business::create([
            'user_id' => $this->user->id,
            'name' => 'WhatsApp Business',
            'slug' => 'whatsapp-business-ghi789',
            'description' => 'Business with WhatsApp number for testing.',
            'category_id' => $this->category->id,
            'phone' => '+233 20 333 3333',
            'whatsapp_number' => '+233 20 333 3333',
            'status' => 'published',
        ]);

        $this->assertNotNull($business->whatsappLink());
        $this->assertStringContainsString('wa.me', $business->whatsappLink());
    }

    public function test_business_without_whatsapp_returns_null_link(): void
    {
        $business = Business::create([
            'user_id' => $this->user->id,
            'name' => 'No WhatsApp',
            'slug' => 'no-whatsapp-mno345',
            'description' => 'Business without WhatsApp number for testing.',
            'category_id' => $this->category->id,
            'phone' => '+233 20 555 5555',
            'status' => 'published',
        ]);

        $this->assertNull($business->whatsappLink());
    }

    public function test_business_owner_can_edit_their_business(): void
    {
        $business = Business::create([
            'user_id' => $this->user->id,
            'name' => 'Editable Business',
            'slug' => 'editable-business-pqr678',
            'description' => 'A business that will be edited with enough characters.',
            'category_id' => $this->category->id,
            'phone' => '+233 20 666 6666',
            'status' => 'published',
        ]);

        $response = $this->actingAs($this->user)
            ->get("/owner/business/{$business->id}/edit");

        $response->assertStatus(200);
    }

    public function test_business_owner_can_manage_products(): void
    {
        $business = Business::create([
            'user_id' => $this->user->id,
            'name' => 'Product Business',
            'slug' => 'product-business-stu901',
            'description' => 'A business with products for testing product management.',
            'category_id' => $this->category->id,
            'phone' => '+233 20 777 7777',
            'status' => 'published',
        ]);

        $response = $this->actingAs($this->user)
            ->get("/owner/business/{$business->id}/products");

        $response->assertStatus(200);
    }

    public function test_increment_views(): void
    {
        $business = Business::create([
            'user_id' => $this->user->id,
            'name' => 'Viewed Business',
            'slug' => 'viewed-business-vwx234',
            'description' => 'A business to test view counting with enough characters.',
            'category_id' => $this->category->id,
            'phone' => '+233 20 888 8888',
            'status' => 'published',
            'views_count' => 0,
        ]);

        $this->assertEquals(0, $business->views_count);
        $business->incrementViews();
        $business->refresh();
        $this->assertEquals(1, $business->views_count);
    }

    public function test_business_published_scope(): void
    {
        Business::create([
            'user_id' => $this->user->id,
            'name' => 'Published Biz',
            'slug' => 'published-biz-yza567',
            'description' => 'A published business for testing the scope.',
            'category_id' => $this->category->id,
            'phone' => '+233 20 999 9999',
            'status' => 'published',
        ]);

        Business::create([
            'user_id' => $this->user->id,
            'name' => 'Draft Biz',
            'slug' => 'draft-biz-bcd890',
            'description' => 'A draft business for testing the scope with enough characters.',
            'category_id' => $this->category->id,
            'phone' => '+233 20 000 0000',
            'status' => 'draft',
        ]);

        $this->assertEquals(1, Business::published()->count());
    }
}
