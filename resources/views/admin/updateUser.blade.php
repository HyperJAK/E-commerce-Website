@extends('layouts.layoutforAdmin')

@section('content')
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            background: white;
            padding: 20px;
            margin: 40px auto;
            width: 50%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-radius: 10px;
            text-align: center;
        }

        
        h2 {
            color: #333;
            margin-bottom: 30px;
        }

        .user-box {
            position: relative;
            margin: 0 auto 25px auto;
            width: 80%;
        }

        .user-box input[type="text"], .user-box input[type="password"] {
            width: 100%;
            padding: 10px;
            background: none;
            border: none;
            border-bottom: 2px solid #ddd;
            outline: none;
            color: #333;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .user-box input[type="text"]:focus, .user-box input[type="password"]:focus {
            border-color: #0056b3;
        }

        .user-box label {
            position: absolute;
            top: 0;
            left: 0;
            color: #999;
            pointer-events: none;
            transition: 0.5s;
            font-size: 16px;
        }

        .user-box input[type="text"]:focus + label, .user-box input[type="password"]:focus + label,
        .user-box input[type="text"]:valid + label, .user-box input[type="password"]:valid + label {
            top: -20px;
            font-size: 12px;
            color: #0056b3;
        }

        button {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            border: none;
            color: white;
            padding: 12px 20px;
            cursor: pointer;
            transition: background 0.3s;
            border-radius: 5px;
            width: 80%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            font-size: 18px;
            margin-top: 20px;
        }

        button:hover {
            background: linear-gradient(to right, #a777e3, #6e8efb);
        }

        .alert {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            margin-top: 20px;
            border-radius: 4px;
            font-size: 14px;
        }

        .alert ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
    </style>


    @if(isset($id) && isset($dataUser))
        <div class="form-container">
            <h2>Update Infos for {{$dataUser->username}}</h2>
            <form method="post" action="{{route('saveUpdateUser',['id' => $id,'idUser'=>$dataUser->user_id])}}">
                @csrf
                <div class="user-box">
                    <input type="text" id="username" name="username" autocomplete="off" value="{{$dataUser->username}}" required>
                    <label for="username">Username:</label>
                </div>
                <div class="user-box">
                    <input type="text" id="email" name="email" autocomplete="off" value="{{$dataUser->email}}" required>
                    <label for="email">Email:</label>
                </div>
                <div class="user-box">
                    <input type="password" id="password" name="password" autocomplete="off" placeholder="Enter new password">
                    <label for="password">Password:</label>
                </div>
                <div class="user-box">
                    <input type="text" id="address" name="address" autocomplete="off" value="{{$dataUser->address}}" required>
                    <label for="address">Address:</label>
                </div>
                <div class="user-box">
                    <input type="text" id="phone" name="phone" autocomplete="off" value="{{$dataUser->phone}}" required>
                    <label for="phone">Phone:</label>
                </div>
                @if($errors->any())
                    <div class="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <button type="submit">Update</button>
            </form>
        </div>
    @endif
@endsection
