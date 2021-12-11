<?php

namespace ForeUP\PHPSDK\Tests\Feature;

use ForeUP\PHPSDK\Client;
use ForeUP\PHPSDK\Exceptions\InvalidCredentialException;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function test_it_can_get_mock_token()
    {
        $base_uri = 'https://private-anon-96c0c1bc8d-foreup.apiary-mock.com';

        $client = new Client('devtesting', 'devtesting1', $base_uri);

        $token = $client->getToken();

        $this->assertTrue($token->data->type == 'token');
    }

    public function test_it_throws_exception_if_credentials_are_missing()
    {
        $this->expectException(InvalidCredentialException::class);

        $client = new Client();
    }

    public function test_it_throws_exception_if_invalid_endpoint()
    {
        $base_uri = 'https://private-anon-96c0c1bc8d-foreup.apiary-mock.com';

        $client = new Client('devtesting', 'devtesting1', $base_uri);

        $this->expectException(\Exception::class);
        $token = $client->getToken('/tokens');
    }
}