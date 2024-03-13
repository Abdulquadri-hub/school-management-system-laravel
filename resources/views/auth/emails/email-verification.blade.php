
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>

     <div>
        <h1>Welcome To Laravel LMS</h1>
        <p>{{ $user->firstname }} {{ $user->lastname }}</p>
        <p>Your password is  {{ $user->user_password }}</p>

        <p>
            <a href="{{ url('/verify-email/'.$user->email_verify_token . '?uid=' . $user->user_id ) }}">
                <button>
                    click here to verify your email
                </button>
            </a>
        </p>
     </div>

 </body>
 </html>

    
    
     
