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

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;


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

    $bot->ask('Quel est le titre de votre annonce?', function (Answer $answer, $annonce) use ($bot) {
        $bot->reply('{annonce}');
        // Save result
        if ($annonce) {
            $bot->ask('Descrivez votre annonce?', function (Answer $answer, $description) use ($bot) {
                $bot->reply('{description}');
                if ($description) {
                    $bot->ask('Quel est votre prix au kilo.?', function (Answer $answer) {


                    });
                }
            });
        };
    });

    /* $bot->reply(Question::create("Choix:")
         ->addButtons([
             Button::create("1-Titre de votre annonce")->value("1-Titre de votre annonce"),
             Button::create("2-Description de l'annonce")->value("2-Description de l'annonce"),
             Button::create("3-Prix au kilo")->value("3-Prix au kilo"),
             Button::create("4-Quel est votre budget?")->value("4-Quel est votre budget?"),
             Button::create("5-Choisir une catégorie")->value("categorie"),
             Button::create("6-Délai de livraison")->value("livraison"),
             Button::create("7-Quel est le profit de votre entreprise?")->value("profit"),
         ]));
 });*/

    /*$botman->hears("categorie", function (BotMan $bot) {
        $bot->reply(Question::create("Produit:")->addButtons([
            Button::create("Produit de saison")->value("saison"),
            Button::create("Produit hors saison")->value("hors"),
            Button::create("Fruit")->value("fruit"),
            Button::create("Légumes")->value("legumes"),
        ]));
    });

    $botman->hears("livraison", function (BotMan $bot) {
        $bot->reply(Question::create("Choix:")->addButtons([
            Button::create("Urgent")->value("urgent"),
            Button::create("Normal")->value("normal"),
            Button::create("Moyen terme")->value("mterme"),
            Button::create("long terme")->value("lterme"),
        ]));
    });

    $botman->hears("profit", function (BotMan $bot) {
        $bot->reply(Question::create("Vous etes:")->addButtons([
            Button::create("Particulier")->value("pparticulier"),
            Button::create("Coopérative")->value("pcooperative"),
            Button::create("acheteur")->value("pacheteur"),
            Button::create("agriculteur")->value("pagriculteur"),
        ]));
    });*/
});

// Start listening
$botman->listen();