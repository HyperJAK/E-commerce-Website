<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Messages</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .user-list {
            list-style-type: none;
            padding: 0;
            margin: 20px auto;
            width: 80%;
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
        .user-item span {
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 5px 8px;
            font-size: 12px;
            float: right;
            margin-top: -2px;
        }
    </style>

</head>
<body>
<h1>Messages:</h1>
<ul class="user-list">
    @foreach ($users as $user)
        <li class="user-item" onclick="location.href='{{ route('chatBuyer', ['buyerid' => $id, 'sellerid' => $user->user_id]) }}';">
            {{ $user->username }}

        </li>
    @endforeach
</ul>
</body>
</html>
