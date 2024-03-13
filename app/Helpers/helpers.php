<?php

use App\Models\Functions;
use App\Models\class_enroll_students;
use App\Models\class_lesson;
use App\Models\Rank;
use Illuminate\Notifications\DatabaseNotification;

class Helpers
{

    public static function __callStatic($method, $params)
    {
        $property = strtolower(str_replace("get", '', $method));
        if (isset(session('USERS_ROW')->$property)) 
        {
            return session('USERS_ROW')->$property;
        }
        return 'Unknown';
    }
    
    public static function Notifcations()
    {
        $user_id = session()->get('USERS_ROW')->user_id;
        $rank = session()->get('USERS_ROW')->rank;

        switch ($rank) {

            case 'student': 

                    $notify = DatabaseNotification::where("read_at", null)
                    ->join('users', "notifications.notifiable_id", "=", "users.id")
                    ->where('users.user_id', $user_id)
                    ->select("notifications.*")
                    ->get();
                    
                    if(!empty($notify))
                    {
                        return $notify;
                    }

                break;
            
            default:
                # code...
                break;
        }
    }

    public static function getTime($timeStamp)
    {

        // Current date and time
        $currentDateTime = new DateTime();
        
        // Example past date and time (replace this with your actual date and time)
        $pastDateTime = new DateTime($timeStamp);
        
        // Calculate the difference
        $interval = $currentDateTime->diff($pastDateTime);
        
        // Get the components of the difference
        $years = $interval->y;
        $months = $interval->m;
        $days = $interval->d;
        $hours = $interval->h;
        $minutes = $interval->i;
        $seconds = $interval->s;
        
        // Format the result
        $result = '';
        
        if ($years > 0) {
            $result .= $years . ' year' . ($years > 1 ? 's' : '') . ' ';
        }
        
        if ($months > 0) {
            $result .= $months . ' month' . ($months > 1 ? 's' : '') . ' ';
        }
        
        if ($days > 0) {
            $result .= $days . ' day' . ($days > 1 ? 's' : '') . ' ';
        }
        
        if ($hours > 0) {
            $result .= $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ';
        }
        
        if ($minutes > 0) {
            $result .= $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ';
        }
        
        if ($result === '') {
            $result = 'Just now';
        } else {
            $result .= 'ago';
        }
        
        return $result;
        
        

    }
}


function get_image($image, $gender = 'male'){

    if (!file_exists($image)){
        $image = 'assets/';
        if ($gender == 'male') {
            $image .= "img/male.jpg";
            
        }elseif($gender == "female"){
            $image .= "img/female.jpg";
        }
    }else {
        $imageCrop = new App\Models\ImageCrop();
        $image = '/' . $imageCrop->profile_thumb($image);
    }
    return $image;
}

function get_date($date){
    if(!empty($date)){
        return date("jS M, Y",strtotime($date));
    }
}



