<?php

use App\Http\Controllers\WorkspacesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // list all workspaces
    Route::get("/workspaces", [WorkspacesController::class, "index"]);

    // create a new workspace
    Route::post("/workspaces", [WorkspacesController::class, "store"]);

    // show a workspace
    Route::get("/workspaces/{workspace_id}", function () {
        return "todo";
    });

    // update a workspace
    Route::put("/workspaces/{workspace_id}", function () {
        return "todo";
    });

    // delete a workspace
    Route::delete("/workspaces/{workspace_id}", function () {
        return "todo";
    });

    // create a workspace invite
    Route::post("/workspaces/{workspace_id}/invites", function () {
        return "todo";
    });

    // show workspace invites
    Route::get("/workspaces/{workspace_id}/invites", function () {
        return "todo";
    });

    // create a task
    Route::post("/workspaces/{workspace_id}/tasks", function () {
        return "todo";
    });

    // show tasks
    Route::get("/workspaces/{workspace_id}/tasks", function () {
        return "todo";
    });

    // show a task
    Route::get("/workspaces/{workspace_id}/tasks/{task_id}", function () {
        return "todo";
    });

    // update a task
    Route::put("/workspaces/{workspace_id}/tasks/{task_id}", function () {
        return "todo";
    });

    // delete a task
    Route::delete("/workspaces/{workspace_id}/tasks/{task_id}", function () {
        return "todo";
    });
});
