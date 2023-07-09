<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use App\Models\Image_crop;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    function get_image($image,$gender = 'female'){

    if (!file_exists($image)) {
        $image = '{{url("assets/")}}';
        if ($gender == 'female') {
            $image = "{{url('assets/img/female.png')}}";
        }
    }else {
        $class = new Image_crop();
        $image = "{{url('/')}}" . $class->profile_thumb($image);
    }
    return $image;
}

    //user_id mutator
    // public function setUser_idAttribute($value){
    //     $value .= $this->attributes['firstname'] . "." . $this->attributes['lastname'];
    //     $this->attributes['user_id'] = $value;
    //     while ($this->where("user_id", $this->attributes['user_id'] )) {
    //         $this->attributes['user_id'] .= rand(10,9999);
    //     }
    // }
    
    // public function make_school_id($data)
    // {
    //     if (isset($_SESSION['USER']->school_id)) 
    //     {
    //         // $data['school_id'] = $_SESSION['USER']->school_id;
    //     }
    //     return $data;
    // }


    
}
