<?php

namespace ForeUP\PHPSDK;

use ForeUP\PHPSDK\Exceptions\InvalidCredentialException;
use GuzzleHttp\Client as GuzzleClient;
use ForeUP\PHPSDK\Customer;

class Client
{
    private $username;
    private $password;

    protected $client;

    public function __construct(string $username = null, string $password = null, string $base_uri = null)
    {
        if (is_null($username) || is_null($password) || is_null($base_uri)) {
            throw new InvalidCredentialException('API credentials must be provided.');
        }

        $this->username = $username;
        $this->password = $password;

        $this->client = new GuzzleClient([
            'base_uri' => $base_uri
        ]);
    }

    public function getToken($endpoint = 'tokens')
    {
        try {
            $response = $this->client->post("/api_rest/index.php/{$endpoint}", [
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

    public function customer()
    {
        return new Customer($this->client);
    }
}
