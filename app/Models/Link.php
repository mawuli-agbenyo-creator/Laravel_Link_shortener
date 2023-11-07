<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Link extends Model
{
    protected $fillable = ['original_url', 'short_url', 'expiration_date'];

    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        // When creating a new link, set the expiration date to 24 hours from creation
        static::creating(function ($link) {
            $link->expiration_date = Carbon::now()->addHours(24);
        });
    }
}
