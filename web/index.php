<?php
/**
 * Created by PhpStorm.
 * User: Kimt
 * Date: 31/07/2018
 * Time: 18:15
 */

require('../vendor/autoload.php');

use AgriBot\Annonce;
use AgriBot\Database;
use AgriBot\OnboardingConversation;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Cache\SymfonyCache;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\ListTemplate;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$adapter = new FilesystemAdapter();


/*$annonce = new Annonce();

$annonce->setTitle("Achat de café");
$annonce->setDescription("Je veux acheter du café");
$annonce->setSlug("achat");
$annonce->setPrice(200);
$annonce->setBudget(2000);
$annonce->setEtatId(1);
$annonce->setCategoryId(1);
$annonce->setUserId(1);
*/

$db = Database::getConnection();

$select = $db->query('DELETE FROM annonces WHERE id = 232');

//$res = $select->fetchAll();

//dd($res);
/*
       $db->query
    ('
          INSERT INTO annonces(title, description, slug, status, etat_id, category_id, user_id, budget, price, created_at, updated_at)
          VALUES("Achat", "Achat de café", "achat", "Acheteur", 4, 1, 1, "5000", "500", "2018-08-03 00:49:48", "2018-08-03 00:49:48")
    ');*/

/*$pdoStatement->bindValue(':title', $annonce->getTitle());
$pdoStatement->bindValue(':description', $annonce->getDescription());
$pdoStatement->bindValue(':budget', $annonce->getBudget());
$pdoStatement->bindValue(':status', $annonce->getStatus());
$pdoStatement->bindValue(':slug',  $annonce->getSlug());
$pdoStatement->bindValue(':category_id', $annonce->getCategoryId());
$pdoStatement->bindValue(':user_id', $annonce->getUserId());
$pdoStatement->bindValue(':price', $annonce->getPrice());*/
 
//$pdoStatement->execute();



$config = [
    'facebook' => [
        'token' => 'EAAc7UhlqCQABAJNbh6YQ3XUHsfhnVPa6dZCEx13InSEmghTzPTBWWEqLd7CVSslSkBKcjs8WwEmdtZCX13qjpW60NE44dvoLJKDm0NCZCKGYq8h5yRuqIKe7kC5524ApKGQNhJUHUVXPxjI8luzebYLZBcWctoxK1kDZAShcZAaBKjoVdB68ga',
        'app_secret' => '3f326ba22a1958a9698e2c194ded7ef1',
        'verification'=>'3f326ba22a1958a9698e2c194ded7ef1',
    ]
];

DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);

// Create BotMan instance
$botman = BotManFactory::create($config, new SymfonyCache($adapter));

// Give the bot something to listen for.
$botman->hears('demarrer', function (BotMan $bot) {

    $bot->reply(Question::create("Vous etes?")->addButtons([
        Button::create("Acheteur")->value("acheteur"),
        Button::create("Coopérative")->value("Coopérative"),
        Button::create("Agriculteur")->value("Agriculteur"),
    ]));
});

$botman->hears("acheteur", function (BotMan $bot) {
    $bot->reply(ButtonTemplate::create("Annonce?")
        ->addButton(ElementButton::create("Déposer une annonce")->type('postback')->payload('deposer'))
        ->addButton(ElementButton::create("Voir toutes les annonces")->url("http://agrivoire.herokuapp.com/Annonce"))
    );
});

$botman->hears("deposer", function (BotMan $bot) {
    $bot->startConversation(new OnboardingConversation);
});

$botman->hears('oui', function (BotMan $bot) {
    $bot->reply(Question::create("Suivant:")->addButtons([
        Button::create("Catégorie")->value("categorie"),
        Button::create("Délai de livraison")->value("livraison"),
        Button::create("Profil de l'Entreprise")->value("profil"),
    ]));
});

$botman->hears('categorie', function (BotMan $bot) {
    $bot->reply(ListTemplate::create()
        ->useCompactView()
        ->addGlobalButton(ElementButton::create('voir plus')->url('http://agrivoire.herokuapp.com/sol-culture'))
        ->addElement(
            Element::create('Produit de saison')
                ->image('https://agrivoire.herokuapp.com/public/pages/July2018/sack-309849_640-cropped.png')
                ->addButton(ElementButton::create('Choisir')
                    ->payload('psaison')->type('postback'))
        )
        ->addElement(
            Element::create('Produit hors saison')
                ->image('https://agrivoire.herokuapp.com/public/pages/July2018/SugarCane-cropped.png')
                ->addButton(ElementButton::create('Choisir')
                    ->payload('psaison')->type('postback'))
        )
        ->addElement(
            Element::create('Fruit')
                ->image('https://agrivoire.herokuapp.com/public/pages/July2018/legume-cropped.png')
                ->addButton(ElementButton::create('Choisir')
                    ->payload('pfruit')->type('postback'))
        )
        ->addElement(
            Element::create('Légumes')
                ->image('https://agrivoire.herokuapp.com/public/pages/July2018/wheat-576549_1280-cropped.png')
                ->addButton(ElementButton::create('Choisir')
                    ->payload('plegumes')->type('postback'))
        )
    );
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


// Start listening
$botman->listen();