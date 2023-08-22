<?php


namespace Tests\Feature;

use App\Integrations\Source;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use App\Jobs\UpdateClientsJob;
use App\Services\ClientService;
use Tests\TestCase;

class UpdateClientsJobTest extends TestCase
{
    use RefreshDatabase;


    //vendor/bin/phpunit --filter testUpdateClientsJobDispatchesCorrectly tests/Feature/UpdateClientsJobTest.php
    public function testUpdateClientsJobDispatchesCorrectly()
    {

        $sourceWsdl = app(Source::class);
        $clientService = app(ClientService::class);

        $job = (new \App\Jobs\UpdateClientsJob($sourceWsdl, $clientService));

        dispatch($job);


        Queue::assertPushed(UpdateClientsJob::class, function ($job) use ($sourceWsdl, $clientService) {
            return $job->sourceWsdl === $sourceWsdl && $job->clientService === $clientService;
        });
    }
}
