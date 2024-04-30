<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="{{ asset('css/authenthication.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navstyle.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        h1 {
            margin-top: 20px;
            text-align: center;
            color: #333;
        }
        .user-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .user-item {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .user-item:hover {
            background-color: #e6e6e6;
        }
    </style>
</head>
<body>

<h1>Messages:</h1>
<ul class="user-list" >
    @foreach ($users as $user)
        <li class="user-item" onclick="location.href='{{ route('chat', ['sellerid' => Auth::id(), 'buyerid' => $user->user_id]) }}';">
            {{ $user->username }}
        </li>
    @endforeach
</ul>
</body>
</html>


