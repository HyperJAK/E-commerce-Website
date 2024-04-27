<!DOCTYPE html>
<html>
<head>
    <title>Verify Your Email | Icom</title>
</head>
<body>
    <h1>Verify Your Email</h1>
    <p>Hi {{ $user->username }},</p>
    <p>Thank you for signing up. Please click the link below to verify your email address:</p>
    <a href="{{ url('/verify-email/' . $user->verification_token) }}">Verify Email</a>
    <p>If you did not sign up for this account, you can safely ignore this email.</p>
    <p>Thank you!</p>
</body>
</html>