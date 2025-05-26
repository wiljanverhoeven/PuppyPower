<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mymodule extends Model
{
    protected $primaryKey = 'mymodule_id';

    protected $fillable = [
        'user_id',
        'module_id',
        'status',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'mymodule_id');
    }
}
