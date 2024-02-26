<!DOCTYPE html>
<html>
<head>
    <title>Chatbot UI</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-5">Chatbot Interface</h2>
        <div class="form-group">
            <label for="versionSelect">Choose a version:</label>
            <select class="form-control" id="versionSelect">
                <option value="Chatv1">chat v1</option>
                <option value="Chatv2">chat v2</option>
            </select>
        </div>
        <div id="chat" class="p-3 mb-2 bg-light text-dark border rounded">
        </div>
        <input type="text" id="userInput" class="form-control" placeholder="Ask me something...">
        <button onclick="sendMessage()" class="btn btn-primary mt-2">Send</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        function sendMessage() {
            var userMessage = $('#userInput').val();
            var version = $('#versionSelect').val();
            $('#chat').append('<div>User: ' + userMessage + '</div>');
            $.post('chatbot_endpoint.php', {message: userMessage, version: version},
                function(data){
                    var botMessage = data;
                    $('#chat').append('<div>Bot: ' + botMessage + '</div>');
                });
            $('#userInput').val(''); 
        }
    </script>
</body>
</html>

