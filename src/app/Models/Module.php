<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Training;

class Module extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'training_id',
        'order',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
