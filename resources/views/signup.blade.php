<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>

</head>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '388845330635730',
      cookie     : true,
      xfbml      : true,
      version    : 'v19.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<body>
    <form action="{{ route('signup') }}" method="POST">
        @csrf
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <br>
        
        <label for="country">Country:</label>
        <input type="text" name="country" id="country" required>
        <br>
        
        <label for="city">City:</label>
        <input type="text" name="city" id="city" required>
        <br>
        
        <label for="address">Address:</label>
        <input type="text" name="address" id="address">
        <br>
        
        <label for="is_seller">Are you a seller?</label>
        <input type="checkbox" name="is_seller" id="is_seller">
        <br>
        
        <button type="submit">Sign Up</button>

        <a href="{{ route('auth.google') }}">Sign Up with Google</a>
<a href="{{ route('auth.microsoft-graph') }}">Sign Up with Microsoft</a>


<p>Already have an account? <a href="{{ route('signin') }}">Sign In</a></p>
    </form>
</body>
</html>
