<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/style.css') }}">
</head>
<body>
    <div class="center">
        <h1>Forgot Password</h1>
        
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            
          

            <div class="txt_field username">
            <input type="email" name="email" id="email" required>
                <span></span>
                <label>Email</label>
            </div>

        

            <div>
                <input type="submit" value="Send Password Reset Link" class="btn">
            </div>
            @if ($errors->any())
        <div class="alert alert-danger" style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        </form>
        
        <div class="signup_link">
            <p>Remember your password? <a href="{{ route('signin') }}">Sign In</a></p>
        </div>
    </div>
</body>
</html>
