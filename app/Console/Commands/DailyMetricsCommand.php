<?php

namespace App\Console\Commands;

use App\Criteria\HasReadyStartupsCriteria;
use App\Jobs\UpdateStartupMetricsJob;
use App\Jobs\UpdateUserMetricsJob;
use App\Repositories\UserRepository;
use Illuminate\Console\Command;

class DailyMetricsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'metrics:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update daily startup metrics';

    private $repository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
	    $this->repository->pushCriteria(new HasReadyStartupsCriteria());
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	$users = $this->repository->all();
    	foreach ($users as $user) {
		    $startups = $user->startups()->ready()->get();
		    foreach ($startups as $startup) {
			    dispatch(new UpdateStartupMetricsJob($startup));
		    }
		    dispatch(new UpdateUserMetricsJob($user));
	    }
    }
}
