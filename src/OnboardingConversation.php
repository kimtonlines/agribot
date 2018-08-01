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

class OnboardingConversation extends Conversation
{
        private $annonce;

        public function __construct()
        {
            $this->annonce = new Annonce();
            $this->annonce->setEtatId(1);
            $this->annonce->setCategoryId(1);
            $this->annonce->setUserId(1);

        }

    public function askAnnonce()
    {
        $this->ask('Titre de votre annoce?', function(Answer $answer) {
            // Save result
            $title = $answer->getText();
            $this->annonce->setTitle($title);
            $this->say($this->annonce->getTitle());
            $slug = str_shuffle($answer->getText());
            $this->annonce->setSlug($slug);

            $this->askDescription();
        });
    }

        public function askDescription()
    {
        $this->ask('Decrivez votre annonce?', function(Answer $answer) {
            // Save result
            $this->annonce->setDescription($answer->getText());
            $this->askPrix();
        });
    }

       public function askPrix()
    {
        $this->ask('Prix au kilo?', function(Answer $answer) {
            // Save result
            $this->annonce->setPrice($answer->getText());

            $this->askBudget();
        });
    }

        public function askBudget()
    {
        $this->ask('Votre budget?', function(Answer $answer) {
            // Save result
            $this->annonce->setBudget($answer->getText());

            $this->askContinuer();
        });
    }

        public function askContinuer()
    {
        $this->ask('Voulez vous continuer?', function(Answer $answer) {
            // Save result
            $reponse = $answer->getText();
            $this->annonce->add();
            });
    }

    public function run()
    {
        // This will be called immediately
        $this->askAnnonce();
    }
}