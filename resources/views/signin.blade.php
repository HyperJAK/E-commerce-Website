<!DOCTYPE html>
<html>
<head>
    <title>Sign In | Icom</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/style.css') }}">
</head>
<body>
    <div class="center">
        <h1>Sign In</h1>
        
        <form action="{{ route('signin.process') }}" method="POST">
            @csrf
            
            <div class="txt_field username">
                <input type="email" name="email" id="email" required>
                <span></span>
                <label>Email</label>
            </div>

            <div class="txt_field">
                <input type="password" name="password" id="password" required>
                <span></span>
                <label>Password</label>
            </div>

            <input type="submit" value="Sign In" class="btn">
            @if ($errors->any())
        <div class="alert alert-danger" style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
            <div class="external-links">
    <h2>Or sign in using:</h2>
    <div class="logos-container">
        <a href="{{ route('auth.google') }}"><img src="google_logo.png" alt="Google Logo"></a>
        <a href="{{ route('auth.microsoft-graph') }}"><img src="microsoft_logo.png" alt="Microsoft Logo"></a>
    </div>
</div>

            <div class="signup_link">
                <a href="{{ route('password.forgot') }}">Forgot Password?</a>
            </div>
            
            <div class="signup_link">
                <p>Don't have an account? <a href="{{ route('signup') }}">Sign Up</a></p>
            </div>
        </form>
    </div>
</body>
</html>
