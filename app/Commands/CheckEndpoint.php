<?php


namespace App\Commands;


use App\Metric;

class CheckEndpoint implements ICommand
{
    private $url;

    /**
     * CheckEndpoint constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }


    public function execute()
    {
        return $this->checkUrl();
    }

    function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    function hasParameters($string) {
        $json = json_decode($string, true);
        return isset($json[Metric::MONTHLY_REVENUE])
            && isset($json[Metric::PAID_USERS])
            && isset($json[Metric::FREE_USERS]);
    }

    /**
     * @return bool
     */
    protected function checkUrl()
    {
        try {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', $this->url);
            $statusCode = $res->getStatusCode();
            $body = $res->getBody();

            return $statusCode === 200 && $body && $this->isJson($body) && $this->hasParameters($body);
        } catch (\Exception $e) {
            return false;
        }
    }
}