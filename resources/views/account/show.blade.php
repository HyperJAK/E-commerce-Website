@extends('master2')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Account Information') }}</div>

                    <div class="card-body">
                     
                       

                        <form method="POST" action="{{ route('updatemyaccount') }}">
                            @csrf
                            @method('POST')
                            <p><strong>UserName:</strong> <input type="text" name="username" value="{{ Auth::user()->username }}"></p>
<p><strong>Email:</strong> <input type="email" name="email" value="{{ Auth::user()->email }}"></p>
<p><strong>Address:</strong> <input type="text" name="address" value="{{ Auth::user()->address }}"></p>
<p><strong>Country:</strong> <input type="text" name="country" value="{{ Auth::user()->country }}"></p>
<p><strong>City:</strong> <input type="text" name="city" value="{{ Auth::user()->city }}"></p>
<p><strong>Phone:</strong> <input type="text" name="phone" value="{{ Auth::user()->phone }}"></p>
<p><strong>Are you a seller:</strong> <input type="checkbox" name="is_seller" value="1" {{ Auth::user()->is_seller ? 'checked' : '' }}> Yes</p>
<button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
         

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
                </div>

                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            </div>
        </div>
    </div>
@endsection
