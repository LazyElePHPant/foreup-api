# foreup/php-sdk

## Documentation

The documentation for the ForeUP API can be found [here][https://foreup.docs.apiary.io/].

## Installation

You can install **foreup/php-sdk** via composer or by downloading the source.

### Via Composer:

**foreup/php-sdk** is available on Packagist as the
[`foreup/php-sdk`](https://packagist.org/packages/foreup/php-sdk) package:

```
composer require foreup/php-sdk
```

## Quickstart

```php
<?php

use ForeUP\SDKPHP\Client as ForeUPClient;

$client = new ForeUPClient($email, $password, $base_uri);
```

### Create a Token

```php

$client->getToken();
```

### Create a Customer

```php

$client->customer()->create($customer, $courseId, $token);
```

### Customer Attributes

```php

$customer = [
    'type' => 'customer',
    'attributes' => [
        'username' => 'username',
        'company_name' => 'company_name',
        'taxable' => true,
        'discount' => 0,
        'opt_out_email' => false,
        'opt_out_text' => false,
        'date_created' => '2021-12-11T06:07:00-0700',
        'contact_info' => [
            'first_name' => 'first_name',
            'last_name' => 'last_name',
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
```