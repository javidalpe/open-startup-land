<?php


namespace App\Commands;


use App\Startup;

class CheckStartup extends CheckEndpoint implements ICommand
{
    protected $startup;

    /**
     * CheckStartup constructor.
     * @param $startup
     */
    public function __construct(Startup $startup)
    {
        parent::__construct($startup->api_endpoint);
        $this->startup = $startup;
    }

    public function execute()
    {
        $result = parent::execute();
        $this->startup->status = $result;
        $this->startup->save();
        return $result;
    }
}