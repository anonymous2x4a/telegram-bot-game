<?php
require 'vendor/autoload.php';

use TelegramBot\Api\BotApi;

// Replace 'YOUR_BOT_TOKEN' with your actual bot token
$bot = new BotApi('7388917863:AAFseb7fG51tjGpjbW5gF7JMaTy25TkL-m4');

// Get updates
$updates = $bot->getUpdates();

foreach ($updates as $update) {
    $message = $update->getMessage();
    $chatId = $message->getChat()->getId();
    $text = $message->getText();

    if ($text == "/start") {
        $bot->sendMessage($chatId, "Welcome to the Bot!");
    } elseif ($text == "/hello") {
        $bot->sendMessage($chatId, "Hello there!");
    } else {
        $bot->sendMessage($chatId, "I don't understand that command.");
    }
}
