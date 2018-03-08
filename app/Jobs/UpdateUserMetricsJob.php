<?php

namespace App\Jobs;

use App\Commands\UpdateUserMetrics;
use App\Handlers\CommandHandler;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateUserMetricsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;

	/**
	 * UpdateUserMetricsJob constructor.
	 *
	 * @param $user
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	    $commandHandler = new CommandHandler();
	    $commandHandler->executeCommand(new UpdateUserMetrics($this->user));
    }
}
