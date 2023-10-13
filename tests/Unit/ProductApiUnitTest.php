<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;

class ProductApiUnitTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_products()
    {
        // Create some mock products
        $products = Product::factory(5)->create();

        $user = User::factory()->create(); // Create a user
        $token = $user->createToken('API Token')->plainTextToken; // Generate a token for the user

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/products/all');

        $response->assertStatus(200)
            ->assertJsonStructure(['products']);
    }

    public function test_get_single_product()
    {
        // Create a mock product
        $product = Product::factory()->create();
        $user = User::factory()->create(); // Create a user
        $token = $user->createToken('API Token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/products/product/' . $product->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['product']);
    }

    public function test_get_single_product_not_found()
{
    $user = User::factory()->create(); // Create a user
    $token = $user->createToken('API Token')->plainTextToken;

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->get('/api/products/product/999');

    $response->assertStatus(404); 
}


    public function test_add_new_product()
    {
        $user = User::factory()->create(['is_admin' => 0]); // Create a user
        $token = $user->createToken('API Token')->plainTextToken;

        $data = [
            'name' => 'New Product',
            'image' => '1686122531.png',
            'price' => 10.99,
            'description' => 'Description for the new product',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/products/new', $data);

        $response->assertStatus(200)
        ->assertJson(['message' => 'Product successfully created']);

        // Check if the product is in the database
        $this->assertDatabaseHas('products', [
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
            'image' => $data['image'],
        ]);

        
    }

    public function test_update_product()
    {
        // Create a mock product
        $product = Product::factory()->create();
        $user = User::factory()->create(); // Create a user
        $token = $user->createToken('API Token')->plainTextToken;

        $newData = [
            'name' => 'Updated Product Name',
            'image' => '1686122531.png',
            'price' => 19.99,
            'description' => 'Updated product description',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('/api/products/update/' . $product->id, $newData);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Product updated successfully']);

        // Check if the product data is updated in the database
        $this->assertDatabaseHas('products', [
            'name' => $newData['name'],
            'price' => $newData['price'],
            'description' => $newData['description'],
        ]);

        // Check if the new image file exists in storage and the old one is deleted
        Storage::disk('public')->assertExists($newData['image']->hashName());
        Storage::disk('public')->assertMissing($product->image);
    }

    public function test_delete_product()
    {
        // Create a mock product
        $product = Product::factory()->create();
        $user = User::factory()->create(); // Create a user
        $token = $user->createToken('API Token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete('/api/products/delete/' . $product->id);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Product deleted successfully']);

        // Check if the product is deleted from the database
        $this->assertDatabaseMissing('products', ['id' => $product->id]);

        // Check if the image file is deleted from storage
        Storage::disk('public')->assertMissing($product->image);
    }
}

