<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
</head>
<body>
    <h1>Sign In</h1>
    
    <form action="{{ route('signin') }}" method="POST">
        @csrf
        
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <button type="submit">Sign In</button>
        </div>
        
        <div>
            <a href="{{ route('auth.google') }}">Sign In with Google</a>
            <a href="{{ route('auth.microsoft-graph') }}">Sign In with Microsoft</a>
        </div>
        <div>
    <a href="{{ route('password.forgot') }}">Forgot Password?</a>
</div>
        <p>Don't have an account? <a href="{{ route('signup') }}">Sign Up</a></p>
    </form>
</body>
</html>
