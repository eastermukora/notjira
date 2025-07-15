<?php

namespace App\Http\Controllers;

use App\Models\WorkspaceInvite;
use App\Models\Workspace;
use Illuminate\Http\Request;
use App\Mail\WorkspaceInviteMail;
use Illuminate\Support\Facades\Mail;

class UserInviteController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'workspace_id' => 'required|exists:workspaces,id',
            'email' => 'required|email',
        ]);

        // Create the invite
        $workspaceInvite = WorkspaceInvite::create([
            'workspace_id' => $request->workspace_id,
            'email' => $request->email,
        ]);

        // Fetch workspace details
        $workspace = Workspace::find($request->workspace_id);

        // Send the email
        Mail::to($request->email)->send(new WorkspaceInviteMail($workspace->name, $request->email));

        return response()->json(['message' => 'Invite sent successfully!']);
    }

    public function index()
    {
        // Fetch all invites for the authenticated user
        $invites = WorkspaceInvite::where('email', auth()->user()->email)->get();

        return response()->json(['invites' => $invites]);
    }
}
