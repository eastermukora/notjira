<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;


class WorkspaceInvitesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'workspace_id' => 'required',
            'email' => 'required|email',
        ]);

        $workspace = Workspace::find($request->workspace_id);

        if (!$workspace) {
            return response()->json(['message' => 'Workspace not found.'], 404);
        }

        if ($workspace->invites()->where('email', $request->email)->exists()) {
            return response()->json(['message' => 'User already invited.'], 400);
        }

        $workspace->invites()->create([
            'email' => $request->email,
        ]);


        return response()->json(['message' => 'Invite created successfully.', 'data' => $workspace]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
