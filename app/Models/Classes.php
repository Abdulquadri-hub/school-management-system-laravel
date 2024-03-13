<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Classes extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->BelongsTo(\App\Models\User::class, 'user_id');
    }

    public function class_enroll()
    {
        return $this->BelongsTo(\App\Models\class_enroll_students::class, 'class_id');
    }
}
