<?php

namespace ForeUP\PHPSDK\Tests\Feature;

use ForeUP\PHPSDK\Client;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public function test_it_can_create_customer()
    {
        $base_uri = 'https://private-anon-96c0c1bc8d-foreup.apiary-mock.com';

        $client = new Client('devtesting', 'devtesting1', $base_uri);

        $token = $client->getToken();

        $this->assertTrue($token->data->type == 'token');
    }
}
