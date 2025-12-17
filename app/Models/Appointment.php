<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    // Allow safe mass assignment for these columns
    protected $fillable = [
        'client_id',
        'pet_id',
        'pet_name',
        'breed',
        'groomer_id',
        'service_id',
        'scheduled_at',
        'status',
        'client_notes',
        'admin_notes',
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function groomer()
    {
        return $this->belongsTo(Groomer::class);
    }
}