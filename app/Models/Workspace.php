<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Models\Task;


class Workspace extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'description',
        'owner_id',
    ];
    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }


    public function tasks()
    {
        return $this->hasMany(Task::class, "workspace_id");
    }


    public function invites()
    {
        return $this->hasMany(WorkspaceInvite::class, "workspace_id");
    }
}
