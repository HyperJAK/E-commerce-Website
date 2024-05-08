<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        .nav {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .nav-header .nav-title {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-btn {
            display: none; /* Hide nav button by default */
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            margin: 0 15px;
            font-size: 18px;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #ffcc00;
        }

        @media (max-width: 768px) {
            .nav-btn {
                display: initial;
            }

            .nav-links {
                flex-direction: column;
                display: none;
                width: 100%;
                padding: 10px 20px;
                position: absolute;
                top: 55px;
                left: 0;
                background: linear-gradient(135deg, #6e8efb, #a777e3);
            }

            .nav-links a {
                margin: 10px 0;
            }

            .nav-btn label {
                display: block;
                cursor: pointer;
                position: relative;
                z-index: 1;
            }

            .nav-btn span {
                display: block;
                width: 25px;
                height: 3px;
                background: white;
                margin: 5px auto;
                transition: all 0.3s;
            }

            #nav-check:not(:checked) + .nav-btn + .nav-links {
                display: none;
            }

            #nav-check:checked + .nav-btn span:nth-of-type(1) {
                transform: rotate(45deg) translate(5px, 5px);
            }

            #nav-check:checked + .nav-btn span:nth-of-type(2) {
                opacity: 0;
            }

            #nav-check:checked + .nav-btn span:nth-of-type(3) {
                transform: rotate(-45deg) translate(7px, -8px);
            }
        }
    </style>
</head>
<body>
<input type="checkbox" id="nav-check" style="display:none;">
<div class="nav">
    <div class="nav-header">
        <div class="nav-title">
            Admin Page
        </div>
    </div>
    <div class="nav-btn">
        <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>

    <div class="nav-links">
        <a href="{{ route('homeAdmin',['id'=>$id]) }}">Home</a>
        <a href="{{ route('infosAdmin',['id'=>$id]) }}">Profile Admin</a>
        <a href="{{route('allUsers',['id'=>$id])}}" >All Users</a>
        <a href="{{route('AllStores',['id'=>$id])}}" >All Stores</a>
    </div>
</div>
@yield('content')
</body>
</html>
