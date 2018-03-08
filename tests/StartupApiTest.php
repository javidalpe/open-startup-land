<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StartupApiTest extends TestCase
{
    use MakeStartupTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateStartup()
    {
        $startup = $this->fakeStartupData();
        $this->json('POST', '/api/v1/startups', $startup);

        $this->assertApiResponse($startup);
    }

    /**
     * @test
     */
    public function testReadStartup()
    {
        $startup = $this->makeStartup();
        $this->json('GET', '/api/v1/startups/'.$startup->id);

        $this->assertApiResponse($startup->toArray());
    }

    /**
     * @test
     */
    public function testUpdateStartup()
    {
        $startup = $this->makeStartup();
        $editedStartup = $this->fakeStartupData();

        $this->json('PUT', '/api/v1/startups/'.$startup->id, $editedStartup);

        $this->assertApiResponse($editedStartup);
    }

    /**
     * @test
     */
    public function testDeleteStartup()
    {
        $startup = $this->makeStartup();
        $this->json('DELETE', '/api/v1/startups/'.$startup->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/startups/'.$startup->id);

        $this->assertResponseStatus(404);
    }
}
