<?php
namespace App\Http\Controllers;

use App\Models\WorkspaceInvite;
use Illuminate\Http\Request;

class UserInviteController extends Controller
{
    public function index(Request $request)
    {
        // Fetch invites for the authenticated user
        $userEmail = $request->user()->email; // Get the authenticated user's email
        $invites = WorkspaceInvite::where('email', $userEmail)->get();

        // Return the invites as JSON
        return response()->json([
            'invites' => $invites,
        ]);
    }
};

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'workspace_id' => 'required|exists:workspaces,id',
            'email' => 'required|email',
        ]);

        // Create a new workspace invite
        $invite = WorkspaceInvite::create([
            'workspace_id' => $request->workspace_id,
            'email' => $request->email,
        ]);

        // Return the created invite as JSON
        return response()->json([
            'invite' => $invite,
        ], 201);
    }
}