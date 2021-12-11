<?php

namespace ForeUP\PHPSDK\Tests\Feature;

use ForeUP\PHPSDK\Client;
use ForeUP\PHPSDK\Exceptions\MissingCourseIdException;
use ForeUP\PHPSDK\Exceptions\MissingTokenException;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public function test_it_throws_missing_customer_exception()
    {
        $base_uri = 'https://private-anon-96c0c1bc8d-foreup.apiary-mock.com';

        $client = new Client('devtesting', 'devtesting1', $base_uri);

        $this->expectException(MissingCourseIdException::class);

        $client->customer()->create($this->getCustomerFactory());
    }

    public function test_it_throws_missing_token_exception()
    {
        $base_uri = 'https://private-anon-96c0c1bc8d-foreup.apiary-mock.com';

        $client = new Client('devtesting', 'devtesting1', $base_uri);

        $this->expectException(MissingTokenException::class);

        $client->customer()->create($this->getCustomerFactory(), 9039);
    }

    public function test_it_can_create_customer()
    {
        $base_uri = 'https://private-anon-96c0c1bc8d-foreup.apiary-mock.com';

        $client = new Client('devtesting', 'devtesting1', $base_uri);
        $token = $client->getToken();

        $response = $client->customer()->create($this->getCustomerFactory(), 9039, $token->data->id);

        $this->assertTrue($response->getStatusCode() == 200);
    }

    public function getCustomerFactory()
    {
        return [
            'type' => 'customer',
            'attributes' => [
                'username' => 'myusername',
                'company_name' => 'MyCompanyName',
                'taxable' => true,
                'discount' => 0,
                'opt_out_email' => false,
                'opt_out_text' => false,
                'date_created' => '2021-12-11T06:07:00-0700',
                'contact_info' => [
                    'first_name' => 'Bob',
                    'last_name' => 'Smith',
                    'phone_number' => '801',
                    'cell_phone_number' => '123 123 123',
                    'email' => 'foreup@fake.com',
                    'birthday' => '2017-01-09T06:07:00-0700',
                    'address_1' => 'test 342',
                    'address_2' => 'test 342',
                    'city' => 'Lindon',
                    'state' => 'UT',
                    'zip' => '121234',
                    'country' => 'USA',
                    'handicap_account_number' => '123',
                    'handicap_score' => '12',
                    'comments' => 'Best customer ever!!'
                ]
            ]
        ];
    }
}
