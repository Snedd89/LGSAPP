<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // Table Name
    protected $table = "bookings";
    // Primary Key
    public $primaryKey = "id";
    // Timestamps
    public $timestamps = true;
}
