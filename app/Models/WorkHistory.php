<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'start_at',
        'resigned_at',
        'company_id',
        'alumni_id',
    ];

    public function status(): Attribute
    {
        return new Attribute(
            get: fn() => $this->resigned_at ?: 'present'
        );
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
