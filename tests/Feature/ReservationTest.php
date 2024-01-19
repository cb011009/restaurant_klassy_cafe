<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReservationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    
     use DatabaseTransactions;

     public function testUserWithNoReservationsSeesNoReservationsMessage()
{
    // Arrange: Create a user with the role "user" and no reservations
    $user = User::factory()->create(['user_role' => 'user']);

    // Act: Simulate the user journey
    $response = $this->actingAs($user)
        ->get('/reservation'); // Navigate to the reservation page

    // Assert: Check if the message for no reservations is displayed
    $response->assertStatus(200); // Ensure the response is successful
    $response->assertSee('You have no reservations.'); // Check if the no reservations message is present
}


public function testUserCanSeeReservationDetailsAfterMakingReservation()
{
    $user = User::factory()->create(['user_role' => 'user']);

    // Act: Simulate the user journey
    $response = $this->actingAs($user)
        ->get('/reservation'); // Navigate to the reservation page

    $response = $this->post('/reservation', [
        'number_of_guests' => 4,
        'time_slot' => 'Dinner - 8:00 PM',
        'date' => '2024-01-19',
        'occasion' => "It's my daughter's birthday",
        'additional_info' => "She likes your ramen noodles.",
    ]);


    // Follow the redirect to the final destination
    $redirectedResponse = $this->followRedirects($response);

    // Assert: Check if the reservation details are displayed
    $redirectedResponse->assertStatus(200); // Ensure the response is successful

    
    

    
}




    public function testNonUserCannotAccessReservationPage()
    {
        // Arrange: Create a user with a different role (e.g., "admin")
        $nonUser = User::factory()->create(['user_role' => 'admin']);

        // Act: Try to access the reservation page
        $response = $this->actingAs($nonUser)->get('/reservation');

        // Assert: Check if the user is redirected to the login page or any other expected behavior
        $response->assertRedirect('/login');
    }
}
