<div class="container">
    <h1>Edit Profile</h1>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ old('username', Auth::user()->username) }}" required>
        </div>
        
        <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" readonly required>
</div>
        
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" name="country" id="country" class="form-control" value="{{ old('country', Auth::user()->country) }}" required>
        </div>
        
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ old('city', Auth::user()->city) }}">
        </div>
        
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', Auth::user()->address) }}">
        </div>
        
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>