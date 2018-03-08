<?php

use Faker\Factory as Faker;
use App\Startup;
use App\Repositories\StartupRepository;

trait MakeStartupTrait
{
    /**
     * Create fake instance of Startup and save it in database
     *
     * @param array $startupFields
     * @return Startup
     */
    public function makeStartup($startupFields = [])
    {
        /** @var StartupRepository $startupRepo */
        $startupRepo = App::make(StartupRepository::class);
        $theme = $this->fakeStartupData($startupFields);
        return $startupRepo->create($theme);
    }

    /**
     * Get fake instance of Startup
     *
     * @param array $startupFields
     * @return Startup
     */
    public function fakeStartup($startupFields = [])
    {
        return new Startup($this->fakeStartupData($startupFields));
    }

    /**
     * Get fake data of Startup
     *
     * @param array $postFields
     * @return array
     */
    public function fakeStartupData($startupFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'speech' => $fake->word,
            'website' => $fake->word,
            'api_endpoint' => $fake->word,
            'currency' => $fake->word,
            'user_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $startupFields);
    }
}
