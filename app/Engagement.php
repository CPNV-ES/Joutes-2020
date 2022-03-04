<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engagement extends Model
{
    use HasFactory;
    public $timestamps = false;

    public static function findBySlug(string $slug): self
    {
        return self::where('slug', $slug)->firstOrFail();
    }
}
