<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->fallback(function($bot){
    $message = $bot->getMessage();
    $bot->reply('Sorry, i don\'t understand '. $message->getText());
    $bot->reply('My known commands are:');
    $bot->reply('Weather in {location}');
    $bot->reply('{days} day forecast for {location}');
});

$botman->hears('Hi(.*)|Hello', function ($bot) {
    $bot->reply('Hello!');
});

$botman->hears('Weather in {location}', function ($bot, $location) {
    $bot->reply($location);
});

$botman->hears('{days} day forecast for {location}', function ($bot, $days, $location) {
    $bot->reply($location . ' for ' . $days . ' days');
});

$botman->hears('([0-9]) day forecast for (.*)', function ($bot, $days, $location) { //Reihenfolge beachten
    $bot->reply($location . ' for ' . $days . ' days');
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');
