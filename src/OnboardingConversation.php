<?php
/**
 * Created by PhpStorm.
 * User: Kimt
 * Date: 31/07/2018
 * Time: 19:01
 */

namespace AgriBot;


use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\ListTemplate;
use DateTime;

class OnboardingConversation extends Conversation
{

        protected $title;
        protected $description;
        protected $prix;
        protected $budget;

    public function askAnnonce()
    {
        $this->ask('Titre de votre annonce?', function(Answer $answer) {
            // Save result
            $this->title = $answer->getText();

            $this->askDescription();
        });
    }

        public function askDescription()
    {
        $this->ask('Decrivez votre annonce?', function(Answer $answer) {
            // Save result
            $this->description = $answer->getText();

            $this->askPrix();
        });
    }

       public function askPrix()
    {
        $this->ask('Prix au kilo?', function(Answer $answer) {
            // Save result
            $this->prix = $answer->getText();

            $this->askBudget();
        });
    }

        public function askBudget()
    {
        $this->ask('Votre budget?', function(Answer $answer) {
            // Save result
            $this->budget = $answer->getText();

            $this->askContinuer();
        });
    }

        public function askContinuer()
    {
        $this->ask('Voulez vous ajouter cette annonce?', function(Answer $answer) {

            $annonce = new Annonce();
            $date = new DateTime('now');
            $slug = str_shuffle($this->title);
            $annonce->setTitle($this->title);
            $annonce->setSlug($slug);
            $annonce->setDescription($this->description);
            $annonce->setPrice($this->prix);
            $annonce->setBudget($this->budget);
            $annonce->setEtatId(4);
            $annonce->setCategoryId(1);
            $annonce->setUserId(1);
            $annonce->setStatus("Acheteurs");
            $annonce->setCreatedAt($date);
            $annonce->setUpdatedAt($date);

            $annonce->add();

            $this->say("Annonce Ajouté avec succès!");
            // Save result
            $reponse = $answer->getText();

            });
    }

    public function run()
    {
        // This will be called immediately
        $this->askAnnonce();
    }
}