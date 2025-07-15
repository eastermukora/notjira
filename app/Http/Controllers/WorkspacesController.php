<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkspacesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workspaces = Workspace::all();
        return response()->json($workspaces);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /** e
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $ownerId = Auth::user()->id;
        $workspace = Workspace::create([
            'name' => $request->name,
            'description' => $request->description ?? "",
            'owner_id' => $ownerId,
            "created_at" => time(),
            "updated_at" => time(),
        ]);

        return response()->json($workspace, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $workspace_id)
    {
        $workspace = Workspace::find($workspace_id);
        $workspace->load('owner', 'tasks', "invites");
        return response()->json($workspace);
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
