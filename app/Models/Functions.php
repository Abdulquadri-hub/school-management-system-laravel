<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Functions extends Model
{
    use HasFactory;

    public static function __callStatic($method, $params)
    {
        $property = strtolower(str_replace("get", '', $method));
        if (isset(session('USERS_ROW')->$property)) 
        {
            return session('USERS_ROW')->$property;
        }
        return 'Unknown';
    }

}
