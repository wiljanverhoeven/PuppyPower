<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['admin_id', 'user_id', 'date', 'start_time', 'end_time'];

    public function availability()
    {
        return $this->belongsTo(Availability::class, 'availability_id');
    }
}