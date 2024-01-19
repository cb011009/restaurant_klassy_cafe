<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    
     


    use DatabaseTransactions;

    public function test_admin_can_access_admin_panel()
    {
        // Create an admin user using the UserFactory with 'admin' role
        $adminUser = User::factory()->create(['user_role' => 'admin']);

        // Act as the admin user and attempt to access the admin panel
        $response = $this->actingAs($adminUser)->get('/admin_panel');

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);
    }

    /*public function test_non_admin_user_cannot_access_admin_panel()
    {
        // Create a non-admin user using the UserFactory with 'user' role
        $user = User::factory()->create(['user_role' => 'user']);

        // Act as the non-admin user and attempt to access the admin panel
        $response = $this->actingAs($user)->get('/admin_panel');

        // Assert that the response status is a 403 (Forbidden) or any other expected behavior
        $response->assertStatus(403);
    }*/

    public function testNonAdminUserIsRedirectedToLogin()
{
    // Arrange: Create a non-admin user
    $user = User::factory()->create([
        'user_role' => 'user', // Adjust the role as needed
    ]);

    // Act: Attempt to access the admin panel
    $response = $this->actingAs($user)->get('/admin_panel');

    // Assert that the response status is a 302 (Redirect)
    $response->assertStatus(302);

    // Assert that the user is redirected to the login page
    $response->assertLocation('/login');
}

}
