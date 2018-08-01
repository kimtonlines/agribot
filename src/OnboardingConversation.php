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
        $this->ask('Quel est le titre de votre annoce?', function(Answer $answer) {
            // Save result
            $annonce = $answer->getText();
            $this->say($annonce);
            $this->askDescription();
        });
    }

        public function askDescription()
    {
        $this->ask('Decrivez votre annonce', function(Answer $answer) {
            // Save result
            $description = $answer->getText();

            $this->say($description);
        });
    }

    public function run()
    {
        // This will be called immediately
        $this->askAnnonce();
    }
}