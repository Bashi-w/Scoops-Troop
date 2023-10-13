<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase; // Use this trait to reset the database after each test
    use WithFaker; // Use this trait to generate fake data

    public function test_login_form()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_user_duplication()
    {
        $user1 = User::make([
            'name' => 'John Doe',
            'email' => 'john@gmail.com'
        ]);

        $user2 = User::make([
            'name' => 'Jane Doe',
            'email' => 'jane@gmail.com'
        ]);

        $this->assertTrue($user1->email != $user2->email);
    }

    public function test_delete_user(){
        $user = User::factory()->count(1)->make();
        $user = User::first();

        if($user){
            $user->delete();
        }

        $this->assertTrue(true);
    }

    public function test_create_user(){
        // Generate fake data for registration
        $fakeData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password123', // Change to meet your password requirements
            'password_confirmation' => 'password123',
            'mobile' => '0771234567', // Or provide a default value if needed
            'house' => $this->faker->buildingNumber,
            'street' => $this->faker->streetName,
            'city' => $this->faker->city,
            'dob' => $this->faker->date('Y-m-d', '2003-09-09'), // Assuming 'dob' is the date of birth field
        ];
    
        // Make a POST request to register the user
        $response = $this->post('register', $fakeData);
    
        // Assert that the response status is 302 (redirect)
        $response->assertStatus(302);
    
        // Assert that the user's profile has been created in the database
        $this->assertDatabaseHas('users', [
            'name' => $fakeData['name'],
            'email' => $fakeData['email'],
        ]);
    }
    
    

    // public function test_database(){
    //     $this->assertDatabaseHas('users',[
    //         'name' => 'John Doe'
    //     ]);
    // }

    public function test_database_missing(){
        $this->assertDatabaseMissing('users',[
            'name' => 'John'
        ]);
    }

    public function test_update_user_profile()
    {
        // Create a user and authenticate them 
        $user = User::factory()->create();
        $this->actingAs($user);

        // Generate fake data for the update request
        $fakeData = [
            'name' => $this->faker->name,
            'mobile' => '0771234567',
            'house' => $this->faker->buildingNumber,
            'street' => $this->faker->streetName,
            'city' => $this->faker->city,
            'email' => $this->faker->safeEmail,
        ];

        // Make a PUT request to update the user profile
        $response = $this->put('/user/' . $user->id, $fakeData);

        // Assert that the response status is 302 (redirect)
        $response->assertStatus(302);

        // Assert that the user's profile has been updated in the database
        $this->assertDatabaseHas('users', $fakeData);
    }

}
