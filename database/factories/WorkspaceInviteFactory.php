<?php

namespace Database\Factories;

use App\Models\WorkspaceInvite;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkspaceInviteFactory extends Factory
{
    /**
     * The name of the model that this factory is for.
     *
     * @var string
     */
    protected $model = WorkspaceInvite::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'workspace_id' => fake()->numberBetween(1, 100),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}

    /**
     * Indicate that the invite is for a specific workspace.
     *
     * @param int $workspaceId
     * @return static
     */
    public function forWorkspace(int $workspaceId): static
    {
        return $this->state([
            'workspace_id' => $workspaceId, 
            // Use the provided workspace ID
            'email' => fake()->unique()->safeEmail(),
        ]);
    }
}

    /**
     * Indicate that the invite is for a specific email.
     *
     * @param string $email
     * @return static
     */
    public function forEmail(string $email): static
    {
        return $this->state([
            'email' => $email,
        ]);
    }
}