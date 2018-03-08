<?php

namespace App\Jobs;

use App\Commands\UpdateStartupMetrics;
use App\Handlers\CommandHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateStartupMetricsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $startup;

    /**
     * UpdateStartupMetricsJob constructor.
     * @param $startup
     */
    public function __construct($startup)
    {
        $this->startup = $startup;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $commandHandler = new CommandHandler();
        $commandHandler->executeCommand(new UpdateStartupMetrics($this->startup));
    }
}
