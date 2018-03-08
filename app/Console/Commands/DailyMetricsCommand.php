<?php

namespace App\Console\Commands;

use App\Jobs\UpdateStartupMetricsJob;
use App\Startup;
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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $startups = Startup::ready()->get();
        foreach ($startups as $startup) {
            dispatch(new UpdateStartupMetricsJob($startup));
        }
    }
}
