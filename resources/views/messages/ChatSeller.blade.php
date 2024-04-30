<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with {{ $buyer->username }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .chat-container {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        #messageContainer {
            max-height: 500px;
            overflow-y: auto;
            margin-bottom: 20px;
        }
        .message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            color: #fff;
            width: fit-content;
            max-width: 80%;
        }
        .message.left {
            background-color: #28a745; /* Green */
            text-align: left;
        }
        .message.right {
            background-color: #007bff; /* Blue */
            text-align: right;
            margin-left: auto; /* Align right */
        }
        .message-input-container {
            display: flex;
        }
        #sellerMessageInput {
            flex-grow: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }
        #sendButton {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        #sendButton:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="chat-container">
    <div id="messageContainer">
        <h1 style="text-align:center">{{ $buyer->username }}</h1>
        @foreach($messages as $message)
            <div class="message {{ $message->senderid == $id ? 'right' : 'left' }}">
                <span>{{ $message->message }}</span>
            </div>
        @endforeach
    </div>

    <div class="message-input-container">
        <form method="post" action="{{ route('selleraddmsg') }}">
            @csrf
            <input type="hidden" name="sellerid" value="{{ $id }}">
            <input type="hidden" name="buyerid" value="{{ $buyer->user_id }}">
            <input type="text" name="sellermessage" id="sellerMessageInput" required placeholder="Type a message..." style="flex: 1;">
            <button id="sendButton" type="submit">Send</button>
        </form>
    </div>
</div>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('c9063ce10b17cee22f10', {
        cluster: 'ap2',
        encrypted: true
    });

    var channel = pusher.subscribe('my-channel{{ $id }}');
    channel.bind('my-event{{ $id }}', function(data) {
        var messageContainer = document.getElementById('messageContainer');
        var messageDiv = document.createElement('div');
        messageDiv.className = 'message ' + (data.message.senderid == {{ $id }} ? 'right' : 'left');
        messageDiv.innerHTML = '<span>' + data.message.message + '</span>';
        messageContainer.appendChild(messageDiv);
        messageContainer.scrollTop = messageContainer.scrollHeight; // Auto-scroll to latest message
    });
</script>

<script>
    window.onload = function() {
        var messageContainer = document.getElementById('messageContainer');
        messageContainer.scrollTop = messageContainer.scrollHeight;
    };
</script>

</body>
</html>
