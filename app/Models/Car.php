<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'registration_number',
        'is_registered'
    ];

    /**
     * @return HasMany
     */
    public function parts(): HasMany
    {
        return $this->hasMany(Part::class);
    }

    /**
     * @return void
     * THIS METHOD IS AUTOMATICLY EXECUTE WHEN THE CLASS IS LOADED
     */
    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($car) {
            if ($car->isForceDeleting()) {
                $car->parts()->forceDelete();
            } else {
                $car->parts()->delete();
            }
        });

        static::restoring(function ($car) {
            $car->parts()->restore();
        });
    }
}
