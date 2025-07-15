<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Workspace;
use App\Models\WorkspaceInvite;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserInviteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_user_invites()
    {
        // Create a user
        $user = User::factory()->create(['email' => 'user@example.com']);

        // Create workspace invites for the user
        WorkspaceInvite::factory()->create([
            'workspace_id' => Workspace::factory()->create()->id,
            'email' => 'invitee@example.com',
        ]);

        // Act as the user and make the API request
        $response = $this->actingAs($user, 'sanctum')->get('/api/user/invites');

        // Assert the response
        $response->assertStatus(200);
        $response->assertJsonCount(2, 'invites');
    }
}
