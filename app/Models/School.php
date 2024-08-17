<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'stage', 'address'];

    /**
     * Get all of the alumni for the School
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alumni(): HasMany
    {
        return $this->hasMany(Alumni::class, 'school_id', 'id');
    }

    public function photos()
    {
        return $this->hasMany(SchoolPhoto::class);
    }
}
