@extends('layouts.layoutforAdmin')
@section('content')

    <style>
        body {
            background: #f0f4f9;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            background: white;
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .user-box {
            position: relative;
            margin-bottom: 20px;
        }

        .user-box input {
            width: 100%;
            padding: 10px;
            background: none;
            border: none;
            border-bottom: 2px solid #ddd;
            outline: none;
            color: #333;
            font-size: 16px;
            transition: border-color 0.2s;
        }

        .user-box input:focus {
            border-bottom-color: #0056b3;
        }

        .user-box label {
            position: absolute;
            top: 0;
            left: 0;
            pointer-events: none;
            transition: 0.5s;
            color: #999;
        }

        .user-box input:focus + label,
        .user-box input:valid + label {
            top: -20px;
            font-size: 12px;
            color: #0056b3;
        }

        button {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            border: none;
            color: white;
            padding: 10px 20px;
            cursor: pointer;
            transition: background 0.3s;
            border-radius: 5px;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            font-size: 18px;
        }

        button:hover {
            background: linear-gradient(to right, #a777e3, #6e8efb);
        }

        .alert ul {
            list-style: none;
            padding: 0;
        }

        .alert {
            margin: 20px 0;
            padding: 15px;
            background-color: #ffdddd;
            border-left: 6px solid #f44336;
        }

        .alert li {
            color: #a94442;
        }
    </style>


    @if(isset($admin))
        <div class="form-container">
            <h2>Update Infos Admin</h2>
            <form method="post" action="{{ route('updateInfoAdmin',['id'=>$id]) }}">
                @csrf

                <div class="user-box">
                    <input type="text" id="email" name="email" required autocomplete="off"  value="{{ $admin->email }}">
                    <label for="email">Email:</label>
                </div>

                <div class="user-box">
                    <input type="password" id="password" name="password" required autocomplete="off"  value="">
                    <label for="password">Password:</label>
                </div>

                <div class="user-box">
                    <input type="text" id="address" name="address" required autocomplete="off"  value="{{ $admin->address }}">
                    <label for="address">Address:</label>
                </div>

                <div class="user-box">
                    <input type="text" id="phone" name="phone" required autocomplete="off"  value="{{ $admin->phone }}">
                    <label for="phone">Phone:</label>
                </div>



                <button type="submit">Update</button>
            </form>
        </div>
    @endif
@endsection
