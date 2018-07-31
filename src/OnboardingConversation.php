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

class OnboardingConversation extends Conversation
{
    protected $firstname;

    protected $email;

    public function askFirstname()
    {
        $this->ask("Bienvenue à vous, qui etes vous?", function(Answer $answer) {
            $this->bot->reply(ButtonTemplate::create('Bienvenue à vous, qui etes vou?')
                ->addButton(ElementButton::create('Acheteurs')->type('postback')->payload('tellmemore'))
                ->addButton(ElementButton::create('Copérative')->url('http://botman.io/'))
                ->addButton(ElementButton::create('Agriculteur')->url('http://botman.io/'))
            );
            // Save result
            $this->firstname = $answer->getText();

            $this->say('Nice to meet you '.$this->firstname);
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('One more thing - what is your email?', function(Answer $answer) {
            // Save result
            $this->email = $answer->getText();

            $this->say('Great - that is all we need, '.$this->firstname);
        });
    }

    public function run()
    {
        // This will be called immediately
        $this->askFirstname();
    }
}