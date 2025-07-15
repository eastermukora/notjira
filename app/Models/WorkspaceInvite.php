<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class WorkspaceInvite extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'workspace_id',
        'email',
    ];
    // The 'hidden' property specifies attributes that should be hidden for arrays.
    protected $hidden = [
        'remember_token',
    ];

    // The 'casts' property defines how attributes should be cast when accessed.
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    // The 'workspace' method defines a relationship indicating that this model
    // belongs to a Workspace model.
    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
