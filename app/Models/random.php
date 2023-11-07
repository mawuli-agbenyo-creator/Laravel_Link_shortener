<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class random extends Model
{
    use HasFactory;

    public static function generateShortCode()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codeLength = rand(3, 5);
        
        do {
            $randomCode = '';
            for ($i = 0; $i < $codeLength; $i++) {
                $randomCode .= $characters[rand(0, strlen($characters) - 1)];
            }
        } while (Link::where('short_url', $randomCode)->where('expiration_date', '>' , now())->exists());
        
        return $randomCode;
        
    }

}
