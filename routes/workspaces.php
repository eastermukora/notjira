<?php

use App\Http\Controllers\TasksController;
use App\Http\Controllers\WorkspacesController;
use App\Models\Workspace;
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

    // update a workspace
    Route::put("/api/workspaces/{workspace_id}", function () {
        return "todo";
    });

    // delete a workspace
    Route::delete("/api/workspaces/{workspace_id}", function () {
        return "todo";
    });

    // create a workspace invite
    Route::post("/api/workspaces/{workspace_id}/invites", function () {
        return "todo";
    });

    // show workspace invites
    Route::get("/api/workspaces/{workspace_id}/invites", function () {
        return "todo";
    });

    // create a task
    Route::post("/api/workspaces/{workspace_id}/tasks", [TasksController::class, "store"]);

    // show tasks
    Route::get("/api/workspaces/{workspace_id}/tasks", function () {
        return "todo";
    });

    // show a task
    Route::get("/api/workspaces/{workspace_id}/tasks/{task_id}", function () {
        return "todo";
    });

    // update a task
    Route::put("/api/workspaces/{workspace_id}/tasks/{task_id}", function () {
        return "todo";
    });

    // delete a task
    Route::delete("/api/workspaces/{workspace_id}/tasks/{task_id}", function () {
        return "todo";
    });
});
