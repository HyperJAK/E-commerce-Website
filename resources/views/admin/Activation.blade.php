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
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            margin: 10px auto;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        button {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 20px 0;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        }

        button:hover {
            background-color: #45a049;
        }
    </style>



    @if(isset($id) && isset($store))

        <div class="form-container">
            <h2>Activation for {{ $store->name }}</h2>

            <form action="{{ route('saveActivation', ['id' => $id, 'idStore' => $store->store_id]) }}" method="POST">
                @csrf

                <label class="switch">
                    <input type="checkbox" name="status" @if($store->status) checked @endif>
                    <span class="slider"></span>
                </label>

                <button type="submit">Update</button>
            </form>
        </div>

    @endif
@endsection
