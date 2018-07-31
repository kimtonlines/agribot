<?php
/**
 * Created by PhpStorm.
 * User: Kimt
 * Date: 31/07/2018
 * Time: 18:15
 */

require('../vendor/autoload.php');

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

use AgriBot\OnboardingConversation;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;

$config = [
    'facebook' => [
        'token' => 'EAAc7UhlqCQABAJNbh6YQ3XUHsfhnVPa6dZCEx13InSEmghTzPTBWWEqLd7CVSslSkBKcjs8WwEmdtZCX13qjpW60NE44dvoLJKDm0NCZCKGYq8h5yRuqIKe7kC5524ApKGQNhJUHUVXPxjI8luzebYLZBcWctoxK1kDZAShcZAaBKjoVdB68ga',
        'app_secret' => '3f326ba22a1958a9698e2c194ded7ef1',
        'verification'=>'3f326ba22a1958a9698e2c194ded7ef1',
    ]
];

DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);

// Create BotMan instance
$botman = BotManFactory::create($config);

// Give the bot something to listen for.
$botman->hears('.*(Bonjour|bonjour|Salut|salut).*', function (BotMan $bot) {
    $bot->reply('Bonjour à vous!');
    $bot->reply(ButtonTemplate::create('Do you want to know more about BotMan?')
        ->addButton(ElementButton::create('Tell me more')->type('postback')->payload('tellmemore'))
        ->addButton(ElementButton::create('Show me the docs')->url('http://botman.io/'))
    );
});

// Start listening
$botman->listen();