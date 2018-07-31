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
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
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
$botman->hears('demarer', function (BotMan $bot) {

  $bot->reply(Question::create("Quick replie 3:")->addButtons([
      Button::create("Acheteur")->value("acheteur"),
      Button::create("Coopérative")->value("Coopérative"),
      Button::create("Agriculteur")->value("Agriculteur"),
  ]));
});

$botman->hears("acheteur", function (BotMan $bot) {
    $bot->reply(Question::create("Choix:")->addButtons([
        Button::create("1-Déposer une annonce")->value("deposer"),
        Button::create("2-Voir toutes les annonces")->value("2-Voir toutes les annonces"),
    ]));
});

$botman->hears("deposer", function (BotMan $bot) {
    $bot->reply(Question::create("Choix:")
        ->addButton(Button::create("1-Titre de votre annonce")->value("1-Titre de votre annonce"))
        ->addButton(Button::create("2-Description de l'annonce")->value("2-Description de l'annonce"))
        ->addButton(Button::create("3-Prix au kilo")->value("3-Prix au kilo"))
        ->addButton(Button::create("4-Quel est votre budget?")->value("4-Quel est votre budget?"))
        ->addButton(Button::create("5-Choisir une catégorie")->value("categorie"))
    );
});

$botman->hears("categorie", function (BotMan $bot) {
    $bot->reply(Question::create("Produit:")->addButtons([
        Button::create("Produit de saison")->value("saison"),
        Button::create("Produit hors saison")->value("hors"),
        Button::create("Fruit")->value("fruit"),
        Button::create("Légumes")->value("legumes"),
        Button::create("5-Choisir une catégorie")->value("categorie"),
        Button::create("6-Délai de livraison")->value("livraison"),
        Button::create("7-Quel est le profit de votre entreprise?")->value("profit"),
    ]));
});

$botman->hears("categorie", function (BotMan $bot) {
    $bot->reply(Question::create("Produit:")->addButtons([
        Button::create("Produit de saison")->value("saison"),
        Button::create("Produit hors saison")->value("hors"),
        Button::create("Fruit")->value("fruit"),
        Button::create("Légumes")->value("legumes"),
        Button::create("5-Choisir une catégorie")->value("categorie"),
    ]));
});

$botman->hears("livraison", function (BotMan $bot) {
    $bot->reply(Question::create("Choix:")->addButtons([
        Button::create("Urgent")->value("urgent"),
        Button::create("Normal")->value("normals"),
        Button::create("Moyen terme")->value("mterme"),
        Button::create("long terme")->value("lterme"),
    ]));
});

$botman->hears("profit", function (BotMan $bot) {
    $bot->reply(Question::create("Vous etes:")->addButtons([
        Button::create("Particulier")->value("particulier"),
        Button::create("Coopérative")->value("cooperative"),
        Button::create("acheteur")->value("acheteur"),
        Button::create("agriculteur")->value("agriculteur"),
    ]));
});

// Start listening
$botman->listen();