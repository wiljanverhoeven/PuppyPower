<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

class Training extends Model
{
    use HasFactory;
    protected $primaryKey = 'training_id';


    protected $fillable = [
        'name',
        'description',
        'date',
        'type',
        'price',
        'age',
    ];

    public function modules()
    {
        return $this->hasMany(Module::class, 'training_id', 'training_id');
    }
}
