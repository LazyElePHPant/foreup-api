<?php

namespace ForeUP\PHPSDK;

use GuzzleHttp\Client as GuzzleClient;
use ForeUP\PHPSDK\Exceptions\MissingTokenException;
use ForeUP\PHPSDK\Exceptions\MissingCourseIdException;
use ForeUP\PHPSDK\Exceptions\CustomerCreationException;

class Customer
{
    protected $client;

    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    public function create(array $customer = [], $courseId = null, $token = null)
    {
        if (is_null($courseId)) {
            throw new MissingCourseIdException('Course ID is required.');
        }

        if (is_null($token)) {
            throw new MissingTokenException('Token is required.');
        }

        try {
            $response = $this->client->post("/api_rest/index.php/courses/{$courseId}/customers", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
                'form_params' => $customer
            ]);

            return $response;
        } catch (\Exception $e) {
            throw new CustomerCreationException($e->getMessage());
        }
    }
}
