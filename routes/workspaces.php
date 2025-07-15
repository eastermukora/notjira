<?php

use App\Http\Controllers\TasksController;
use App\Http\Controllers\WorkspaceInvitesController;
use App\Http\Controllers\WorkspacesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    // list all workspaces
    Route::get("/api/workspaces", [WorkspacesController::class, "index"]);

    // create a new workspace
    Route::post("/api/workspaces", [WorkspacesController::class, "store"]);


    // show the workspace details page
    Route::get(
        "/workspaces/{workspace_id}",
        function (string $workspace_id) {
            return Inertia::render('WorkspaceDetails', ["workspace_id" => $workspace_id]);
        }
    )->middleware(['auth', 'verified'])->name('workspaces.show');

    // show a workspace
    Route::get("/api/workspaces/{workspace_id}", [WorkspacesController::class, "show"]);



    // create a workspace invite
    Route::post("/api/workspaces/{workspace_id}/invites", [WorkspaceInvitesController::class, "create"]);

    // assign a task to a user
    Route::post("/api/workspaces/{workspace_id}/tasks/{task_id}/assign", [TasksController::class, "assign"]);

    // create a task
    Route::post("/api/workspaces/{workspace_id}/tasks", [TasksController::class, "store"]);
});
