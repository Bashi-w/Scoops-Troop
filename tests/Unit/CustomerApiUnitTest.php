<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerApiUnitTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_customers()
    {
        // Create some mock customers
        $user = User::factory()->create(); // Create a user
        $token = $user->createToken('API Token')->plainTextToken; // Generate a token for the user

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/customers/all');


        $response->assertStatus(200)
            ->assertJsonStructure(['customers']);
    }

    public function test_get_single_customer()
    {
        // Create a mock customer
        $customer = User::factory()->create(['is_admin' => 0]);
        $token = $customer->createToken('API Token')->plainTextToken;
    
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/customers/customer/' . $customer->id);
    
        $response->assertStatus(200)
            ->assertJsonStructure(['customer']);
    }
    

    public function test_add_new_customer()
    {
        $customer = User::factory()->create(['is_admin' => 0]);
        $token = $customer->createToken('API Token')->plainTextToken;
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'mobile' => '0771234567',
            'house' => '1',
            'street' => 'Downtown',
            'city' => 'Cityville',
            'dob' => '1990-01-01',
            'password' => 'password123',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/customers/new/', $data);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Customer successfully created']);

        // Check if the user is in the database
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
        ]);
    }

    public function test_update_customer()
{
    // Create a mock customer
    $customer = User::factory()->create(['is_admin' => 0]);
    $newData = [
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
        'mobile' => '0779876543',
        'house' => '4',
        'street' => 'Uptown',
        'city' => 'New City',
        'dob' => '1985-05-05',
        'password' => 'updatedpassword123',
    ];

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $customer->createToken('API Token')->plainTextToken,
    ])->put('/api/customers/update/'. $customer->id , $newData); 

    $response->assertStatus(200)
        ->assertJson(['message' => 'Customer details updated successfully']);
}

public function test_update_customer_not_found()
{
    $newData = [
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
        'mobile' => '0779876543',
        'house' => '5',
        'street' => 'Uptown',
        'city' => 'New City',
        'dob' => '1985-05-05',
        'password' => 'updatedpassword123',
    ];

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . User::factory()->create(['is_admin' => 0])->createToken('API Token')->plainTextToken,
    ])->put('/api/customers/update/999', $newData); 

    $response->assertStatus(404)
        ->assertJson(['message' => 'Customer Not Found']);
}


public function test_delete_customer()
{
    // Create a mock customer
    $customer = User::factory()->create(['is_admin' => 0]);

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $customer->createToken('API Token')->plainTextToken,
    ])->delete('/api/customers/delete/' . $customer->id); // Use the correct route URL

    $response->assertStatus(200)
        ->assertJson(['message' => 'Customer deleted successfully']);
}

public function test_delete_customer_not_found()
{
    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . User::factory()->create(['is_admin' => 0])->createToken('API Token')->plainTextToken,
    ])->delete('/api/customers/delete/999'); 

    $response->assertStatus(404)
        ->assertJson(['message' => 'Customer Not Found']);
}

}
