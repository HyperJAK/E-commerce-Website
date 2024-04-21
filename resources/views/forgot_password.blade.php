<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <h1>Forgot Password</h1>
    
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <button type="submit">Send Password Reset Link</button>
        </div>
    </form>
</body>
</html>