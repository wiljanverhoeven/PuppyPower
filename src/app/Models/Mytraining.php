<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Mytraining extends Model
{
    use HasFactory;
    protected $primaryKey = 'mytraining_id';

    protected $fillable = [
        'user_id',
        'training_id',
        'status',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id', 'training_id');
    }
}
