<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];
    $version = $_POST['version'];
    $escapedMessage = escapeshellarg($message);
    
    $command = "python3 chatbot.py --version " . escapeshellarg($version) . " --message " . $escapedMessage;
    echo $command; 
    $output = shell_exec($command);
    
    echo $output;
} else {
    http_response_code(405);
}
?>

