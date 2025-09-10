<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alumni extends Model
{
    use HasFactory;

    protected $fillable = ['mobile', 'address', 'pob', 'dob', 'registration_at', 'graduation_at', 'school_id', 'user_id'];

    /**
     * Get the user that owns the Alumni
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the school that owns the Alumni
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function workHistories(): HasMany
    {
        return $this->hasMany(WorkHistory::class);
    }

    /**
     * Get the latest work history associated with the alumni.
     */
    public function latestWorkHistory()
    {
        return $this->hasOne(WorkHistory::class)->latestOfMany();
    }

    /**
     * Accessor to get the cohort year from registration_at
     */
    public function getCohortAttribute()
    {
        return date('Y', strtotime($this->registration_at));
    }
}
