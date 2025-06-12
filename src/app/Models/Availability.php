<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $fillable = ['admin_id', 'date', 'start_time', 'end_time', 'repeat_weekly', 'repeat_until'];
}