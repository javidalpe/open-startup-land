<?php


namespace App\Handlers;


use App\Commands\ICommand;

class CommandHandler
{
    public function executeCommand(ICommand $command) {
        return $command->execute();
    }
}