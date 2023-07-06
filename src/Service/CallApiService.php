<?php

namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }


    public function getWeatherly(): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.open-meteo.com/v1/meteofrance?latitude=48.8534&longitude=2.3488&hourly=temperature_2m'
        );

        return $response->toArray();
    }
}