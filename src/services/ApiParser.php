<?php

namespace App\services;

use Symfony\Component\HttpClient\NativeHttpClient;

class ApiParser
{
    public function parse($id)
    {
        $client = new NativeHttpClient();
        $response = $client->request('GET', 'http://localhost:90/api/all', [
            'json' => ['id' => $id],
        ]);
        return json_decode($response->getContent());
    }
}