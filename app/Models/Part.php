<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Part extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'serial_number',
        'car_id'
    ];

    public function car(): HasOne
    {
        return $this->hasOne(Car::class);
    }
}
