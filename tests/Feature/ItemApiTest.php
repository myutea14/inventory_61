<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemApiTest extends TestCase {
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void {
        parent::setUp();
        Category::factory()->create(["id" => 1, "name" => "Electronics"]);
        $this->user = User::factory()->create();
    }

    public function test_guest_cannot_access_items() {
        // Guest yang belum login harus ditolak dengan status 401 (Unauthorized)
        $this->getJson("/api/v1/items")->assertStatus(401);
    }

    public function test_user_can_list_items() {
        // User yang sudah login bisa melihat data dengan status 200 (OK)
        $token = $this->user->createToken("api-token")->plainTextToken;
        $this->withHeader("Authorization", "Bearer $token")
             ->getJson("/api/v1/items")
             ->assertStatus(200);
    }

    public function test_user_can_create_item() {
        // User bisa menambah data barang dan mendapat balasan 201 (Created)
        $token = $this->user->createToken("api-token")->plainTextToken;
        $this->postJson("/api/v1/items", [
            "item_name" => "Kopi Susu",
            "description" => "Kopi enak",
            "category_id" => 1,
            "price" => 15000,
            "stock" => 10
        ], ["Authorization" => "Bearer $token"])->assertStatus(201);
    }

    public function test_user_can_delete_item() {
        // User bisa menghapus data dan mendapat balasan 200 (OK)
        $item = Item::factory()->create(["category_id" => 1]);
        $token = $this->user->createToken("api-token")->plainTextToken;
        $this->deleteJson("/api/v1/items/{$item->id}", [], ["Authorization" => "Bearer $token"])
             ->assertStatus(200);
    }
}