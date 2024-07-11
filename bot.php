<?php
require 'vendor/autoload.php';

use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Update;

// Replace 'YOUR_BOT_TOKEN' with your actual bot token
$bot = new BotApi('7388917863:AAFseb7fG51tjGpjbW5gF7JMaTy25TkL-m4');

$bot->on(function (Update $update) use ($bot) {
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
}, function () {
    return true;
});

$bot->run();