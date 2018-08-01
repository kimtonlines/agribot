<?php
/**
 * Created by PhpStorm.
 * User: Kimt
 * Date: 31/07/2018
 * Time: 19:01
 */

namespace AgriBot;


use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class OnboardingConversation extends Conversation
{

        public function askAnnonce()
    {
        $this->ask('Titre de votre annoce?', function(Answer $answer) {
            // Save result
            $titre = $answer->getText();
            $this->askDescription();
        });
    }

        public function askDescription()
    {
        $this->ask('Decrivez votre annonce?', function(Answer $answer) {
            // Save result
            $description = $answer->getText();
            $this->askPrix();
        });
    }

       public function askPrix()
    {
        $this->ask('Prix au kilo?', function(Answer $answer) {
            // Save result
            $prix = $answer->getText();

            $this->askBudget();
        });
    }

        public function askBudget()
    {
        $this->ask('Votre budget?', function(Answer $answer) {
            // Save result
            $budget = $answer->getText();

            $this->askCtegorie();
        });
    }

        public function askCtegorie()
    {
        $this->ask('Choisir une catégorie?', function(Answer $answer) {
            // Save result
            $budget = $answer->getText();

            //$this->say($description);
        });
    }

    public function run()
    {
        // This will be called immediately
        $this->askAnnonce();
    }
}