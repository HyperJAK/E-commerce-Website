<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with Seller</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .chat-container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            height: 90vh;
        }
        #messageContainer {
            overflow-y: auto;
            flex-grow: 1;
            padding: 10px;
            margin-bottom: 10px;
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
            padding: 10px 20px;
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
        .message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            color: #fff;
            width: fit-content;
            max-width: 70%;
        }
        .message.right {
            background-color: #007bff;
            margin-left: auto;
            text-align: right;
        }
        .message.left {
            background-color: #28a745;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="chat-container">
    <div id="messageContainer">
        <h1 style="text-align:center">{{ $seller->username }}</h1>
        @foreach($messages as $message)
            <div class="message {{ $message->senderid == $id ? 'right' : 'left' }}">
                <span>{{ $message->message }}</span>
            </div>
        @endforeach
    </div>

    <div class="message-input-container">
        <form method="post" action="{{ route('buyeraddmsg') }}">
            @csrf
            <input type="hidden" name="buyerid" value="{{ $id }}">
            <input type="hidden" name="sellerid" value="{{ $seller->user_id }}">
            <input type="text" name="sellermessage" id="sellerMessageInput" required placeholder="Type a message...">
            <button id="sendButton" type="submit">Send</button>
        </form>
    </div>
</div>


<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
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
        messageContainer.scrollTop = messageContainer.scrollHeight;
    });
</script>

<script>
    window.onload = function() {
        document.getElementById('messageContainer').scrollTop = document.getElementById('messageContainer').scrollHeight;
    };
</script>
</body>
</html>
