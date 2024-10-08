<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'school_id'];

    public function storagePath(): Attribute
    {
        return Attribute::make(
            get: fn() => sprintf("/storage/%s", $this->path),
        );
    }
}
