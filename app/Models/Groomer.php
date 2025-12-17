<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groomer extends Model
{
    use HasFactory;

    protected $table = 'groomers';// singular table name

    protected $fillable = [
        'user_id',
        'full_name',    
        'email',
        'employment_status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
