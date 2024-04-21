<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        
        <input type="hidden" name="token" value="{{ $token }}">
        
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ $email }}" readonly required>
        </div>

        <div>
            <label for="password">New Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        
        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>

        <div>
            <button type="submit">Reset Password</button>
        </div>
    </form>
</body>
</html>