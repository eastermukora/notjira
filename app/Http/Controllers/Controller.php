<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
class Controller extends BaseController
{
    public function show($id)
    {
        // Fetch the workspace by ID with related tasks and owner
        $workspace = Workspace::with('tasks', 'owner')->findOrFail($id);

        // Return the workspace data as JSON
        return response()->json([
            'workspace' => $workspace,
        ]);
    }
}