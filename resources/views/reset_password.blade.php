<!DOCTYPE html>
<html>
<head>
    <title>Reset Password | Icom</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/style.css') }}">
</head>
<body>
    <div class="center">
        <h1>Reset Password</h1>
        
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            
            <input type="hidden" name="token" value="{{ $token }}">
            
        

           
            <div class="txt_field username">
                <input type="email" name="email" id="email" value="{{ $email }}" readonly required>
                <span></span>
                <label style="top: -5px; color: #2691d9;">Email:</label>
            </div>


            
            <div class="txt_field">
            <input type="password" name="password" id="password" required>
                <span></span>
                <label>New Password:</label>
            </div>


            <div class="txt_field">
            <input type="password" name="password_confirmation" id="password_confirmation" required>
                <span></span>
                <label>Confirm Password:</label>
            </div>

            <div style="margin-bottom: 20px;"> 
                <input type="submit" value="Reset Password" class="btn">
            </div>
        </form>
    </div>
</body>
</html>
