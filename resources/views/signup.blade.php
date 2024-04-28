<!DOCTYPE html>
<html>
<head>
    <title>Sign Up | Icom</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/style.css') }}">
</head>

<body>
    <div class="center">
        <h1>Sign Up</h1>
        <form action="{{ route('signup.process') }}" method="POST">
            @csrf
            
            <div class="left-column">
            <div class="txt_field username"> 
    <input type="text" name="username" id="username" required>
    <span></span>
    <label>Username</label>
</div>
                
                <div class="txt_field">
                    <input type="email" name="email" id="email" required>
                    <span></span>
                    <label>Email</label>
                </div>
                
                <div class="txt_field">
                    <input type="password" name="password" id="password" required>
                    <span></span>
                    <label>Password</label>
                </div>
                
                <div class="txt_field">
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                    <span></span>
                    <label>Confirm Password</label>
                </div>
            </div>
            
            <div class="right-column">
            <div class="txt_field username"> 
                    <input type="text" name="country" id="country" required>
                    <span></span>
                    <label>Country</label>
                </div>
                
                <div class="txt_field">
                    <input type="text" name="city" id="city" required>
                    <span></span>
                    <label>City</label>
                </div>
                
                <div class="txt_field">
                    <input type="text" name="address" id="address" required>
                    <span></span>
                    <label>Address</label>
                </div>
                
                <div class="txt_field checkbox-field">
                    <input type="checkbox" name="is_seller" id="is_seller" >
                    <span class="checkmark"></span>
                    <label>Are you a seller?</label>
                </div>
            </div>
            
            
            <input type="submit" value="Sign Up" class="btn">
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
          <h2>Or sign up using:</h2>
          <div class="logos-container">
              <a href="{{ route('auth.google') }}"><img src="google_logo.png" alt="Google Logo"></a>
              <a href="{{ route('auth.microsoft-graph') }}"><img src="microsoft_logo.png" alt="Microsoft Logo"></a>
          </div>
      </div>
            
            <div class="signup_link">
                <p>Already have an account? <a href="{{ route('signin') }}">Sign In</a></p>
            </div>
        </form>
    </div>
</body>
</html>
