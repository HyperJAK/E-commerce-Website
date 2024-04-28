<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css">
    <title>BotMan Chat</title>
    <style>
        .chat-container {
            max-width: 100%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .chat-messages {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9cc;
            height: 300px;
            overflow-y: scroll;
        }
        .chat-input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-messages" id="chatMessages">
        </div>
        <form id="chatForm">
            <input type="text" id="messageInput" class="chat-input" placeholder="Type a message...">
            <button type="submit">Send</button>
        </form>
    </div>

    <script>
        document.getElementById('chatForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const messageInput = document.getElementById('messageInput');
            const message = messageInput.value.trim();

            if (message !== '') {
                displayMessage('You', message); 

                const formData = new FormData();
        formData.append('driver', 'web');
        formData.append('userId', {{Auth::id()}});
        formData.append('message', message);
        const urlSearchParams = new URLSearchParams(formData);
                fetch('api/botman', {
                    method: 'POST',
                    headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
                    body:urlSearchParams
                })
                .then(response => response.json())
                .then(data => {
                    const reply = data.messages[0].text;
                    displayMessage('Bot', reply);
                })
                .catch(error => {
                    console.error('Error:', error);
                });

                messageInput.value = '';
            }
        });

        function displayMessage(sender, text) {
            const chatMessages = document.getElementById('chatMessages');
            const messageElement = document.createElement('div');
            messageElement.textContent = `${sender}: ${text}`;
            chatMessages.appendChild(messageElement);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    </script>
  
</body>
</html>
 -->

 <!doctype html>
<html>

<head>
    <title>BotMan Widget</title>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontRessource/css/chatbot.css')}}">
</head>

<body>
    <script id="botmanWidget" src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/chat.js'></script>
</body>
   
</html>