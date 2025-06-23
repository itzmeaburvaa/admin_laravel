<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $table = 'clubs'; // Assuming your table name is 'clubs'

    protected $fillable = [
        'club_name',
        'logo',
        'introduction',
        'mission',
        'staff_coordinator_name',
        'staff_coordinator_email',
        'staff_coordinator_photo',
        'year_started',
    ];

    public $timestamps = false; // if no created_at and updated_at columns
}
