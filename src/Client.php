<?php

namespace ForeUP\PHPSDK;

use ForeUP\PHPSDK\Exceptions\InvalidCredentialException;
use GuzzleHttp\Client as GuzzleClient;

class Client
{
    private $username;
    private $password;

    public function __construct(string $username = null, string $password = null, string $base_uri = null)
    {
        if (! $username || ! $password || ! $base_uri) {
            throw new InvalidCredentialException('API credentials must be provided.');
        }

        $this->username = $username;
        $this->password = $password;

        $this->client = new GuzzleClient([
            'base_uri' => $base_uri
        ]);
    }

    public function getToken($endpoint = '/api_rest/index.php/tokens')
    {
        try {
            $response = $this->client->post($endpoint, [
                'query' => [
                    'email' => $this->username,
                    'password' => $this->password
                ]
            ]);

            return json_decode($response->getBody()->getContents());

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
