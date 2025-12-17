<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Client;
use App\Models\Groomer;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
        
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationships
    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function groomer()
    {
        return $this->hasOne(Groomer::class);
    }

    // Helper for role checks
    public function isRole(string $role): bool
    {
        return $this->role === $role;
    }
}