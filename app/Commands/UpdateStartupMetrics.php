<?php


namespace App\Commands;


use App\Metric;
use App\Startup;
use Carbon\Carbon;

class UpdateStartupMetrics extends CheckStartup implements ICommand
{
    /**
     * CheckStartup constructor.
     * @param $startup
     */
    public function __construct(Startup $startup)
    {
        parent::__construct($startup);
        $this->startup = $startup;
    }

    public function execute()
    {
        $result = parent::execute();

        if (!$result) return;

        $json = json_decode($this->body, true);
        Metric::updateOrCreate([
            'recorded_at' => Carbon::today(),
            'startup_id' => $this->startup->id
        ], [
            Metric::MONTHLY_REVENUE => $json[Metric::MONTHLY_REVENUE],
            Metric::PAID_USERS => $json[Metric::PAID_USERS],
            Metric::FREE_USERS => $json[Metric::FREE_USERS],

        ]);
    }
}