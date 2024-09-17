<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Retrieve the message from the JSON payload
$data = json_decode(file_get_contents('php://input'), true);

// Check if the message is present in the payload
if (isset($data['message'])) {
    $message = $data['message'];

    // Your Telegram bot token and chat ID
    $token = '6113839454:AAFY5WlixlzhREvqK1DAGyZBRnDeY-D9jU4';
    $chatID = '1461764555';

    // Send the message to your Telegram bot
    $telegramURL = 'https://api.telegram.org/bot' . $token . '/sendMessage';
    $queryParams = http_build_query(array(
        'chat_id' => $chatID,
        'text' => $message
    ));

    $options = array(
        'http' => array(
            'method' => 'GET',
            'header' => 'Content-Type: application/json'
        )
    );
    $context = stream_context_create($options);
    $telegramResponse = file_get_contents($telegramURL . '?' . $queryParams, false, $context);

    if ($telegramResponse !== false) {
        // Output the response (optional)
        echo $telegramResponse;
    } else {
        // Handle the error
        echo 'Failed to send the message to Telegram.';
    }
} else {
    // Handle the error when message is not present
    echo 'No message provided.';
}
