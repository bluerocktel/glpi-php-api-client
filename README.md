# php-sdk

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/bluerocktel/glpi-php-api-client.svg?style=flat-square)](https://packagist.org/packages/bluerocktel/glpi-php-api-client)
[![Total Downloads](https://img.shields.io/packagist/dt/bluerocktel/glpi-php-api-client.svg?style=flat-square)](https://packagist.org/packages/bluerocktel/glpi-php-api-client)


This package is a light PHP Wrapper / SDK for the [GLPI Project](https://glpi-project.org/fr/) API.

- [Installation](#installation)
- [Authentication](#authentication)
- [Usage](#usage)
  - [Requests](#usage-requests)
  - [Resources](#usage-resources)
  - [Responses](#usage-responses)
  - [Entities](#usage-entities)
  - [Extending the Client](#usage-extends)


<a name="installation"></a>

## Installation

This library requires PHP `>=8.1`.

You can install the package via composer:

```
composer require bluerocktel/glpi-php-api-client
```

<a name="authentication"></a>

## Authentication

<a name="authentication-password-grant"></a>

### User token

To get started, first generate an App token and a User token from your GLPI dashboard. Then, you can initiate the `GlpiConnector` class providing your instance URL, App token and User token :

```php
$api = new BlueRockTEL\Glpi\GlpiConnector(
    apiUrl: 'https://glpi.mycompany.com/apirest.php',
    appToken: 'KSt7zEY3QMZDXZ5Gfyy7uxV4JoolzupiRCS4GPQQ',
    userToken:'muaYfo14YsK9fK2wutKPyZZW9z5JXW7edc5caRt5',
);
```

> If the connector fails to retreive a Session token from the provided credentials, a `BlueRockTEL\Glpi\Exceptions\AuthenticationException` will be thrown.

You can now start using the API :

```php
$response = $api->user()->search(); // list users

var_dump(
  $response->failed(), // true if the request returned 4xx or 5xx code.
  $response->json(),   // json response as an array
);
```

<a name="usage"></a>

## Usage

To query the API, you can either call each API [Endpoints requests](https://github.com/bluerocktel/glpi-php-api-client/tree/main/src/Endpoints) individually, or make use of provided [Resources classes](https://github.com/bluerocktel/glpi-php-api-client/tree/main/src/Resources) which groups the requests into clusters.


<a name="usage-requests"></a>

### Using Requests

Using single requests is pretty straightforward. You can use the `call()` method of the `GlpiConnector` class to send the desired request to the instance :

```php
use BlueRockTEL\Glpi\Endpoints;

$api = new BlueRockTEL\Glpi\GlpiConnector($apiUrl, $appToken, $userToken);

$response = $api->call(
    new Endpoints\Tickets\SearchTicketsRequest()
);

$response = $api->call(
    new Endpoints\Users\GetUserRequest($userId: 100)
);
```

<a name="usage-resources"></a>

### Using Resources

Using resources is a more convenient way to query the API. Each Resource class groups requests by specific API namespaces (User, Ticket, Profile...).

```php
use Illuminate\Support\Collection;
use BlueRockTEL\Glpi\Enums\Operator;
use BlueRockTEL\Glpi\Entities\SearchCriteria;
use BlueRockTEL\Glpi\Entities\Columns\TicketMap;

$api = new BlueRockTEL\Glpi\GlpiConnector($apiUrl, $appToken, $userToken);

$criterias = new Collection([
    new SearchCriteria(
        field: TicketMap::entity_name,
        operator: Operator::CONTAINS,
        value: $entityId,
    ),
    new SearchCriteria(
        field: TicketMap::assigned_id,
        operator: Operator::EQUALS,
        value: $userId,
    ),
]);

$response = $api->ticket()->search(
    isDeleted: false, // only non-deleted tickets
    criterias: $criterias, // set search criterias
    columns: TicketMap::all(), // set the display columns
);
```

Each of those namespace resources can be accessed using the `GlpiConnector` instance :

```php
$connector = new GlpiConnector(...);

$connector->user(): BlueRockTEL\Glpi\Resources\UserResource
$connector->profile(): BlueRockTEL\Glpi\Resources\ProfileResource
$connector->ticket(): BlueRockTEL\Glpi\Resources\TicketResource
...
```

If needed, it is also possible to create the desired resource instance manually.

```php
use BlueRockTEL\Glpi\GlpiConnector;
use BlueRockTEL\Glpi\Resources\TicketResource;

$api = new GlpiConnector(...);
$resource = new TicketResource($api); // same as $api->ticket()

$ticket = $resource->show($ticketId)->dtoOrFail();

// make changes to $ticket...

$resource->update($ticket);
```

<a name="usage-responses"></a>

### Responses

After issuing a request, the returned response is always an instance of `Saloon\Http\Response` class.
It provides some useful methods to check the response status and get the response data.

```php
// Check response status
$response->ok();
$response->failed();
$response->status();
$response->headers();

// Get response data
$response->json(); # as an array
$response->body(); # as an raw string
$response->dto(); # as a Data Transfer Object
$response->dtoOrFail(); # as a Data Transfer Object, throwing exception on 4-5xx status
```

You can learn more about responses by reading the [Saloon documentation](https://docs.saloon.dev/the-basics/responses#useful-methods), which this client uses underneath.

<a name="usage-entities"></a>

### Entities (DTO)

When working with APIs, dealing with a raw or JSON response can be tedious and unpredictable.

To make it easier, this Api client provides a way to transform the response data into a Data Transfer Object (DTO, later called Entities). This way, you are aware of the structure of the data you are working with, and you can access the data using object typed properties instead of untyped array keys.


```php
$response = $api->user()->show(id: 92);

/** @var \BlueRockTEL\Glpi\Entities\User */
$user = $response->dtoOrFail();
```


Although you can use the `dto()` method to transform the response data into an entity, it is recommended to use the `dtoOrFail()` method instead. This method will throw an exception if the response status is not 2xx, instead of returning an empty DTO.

It is still possible to access the underlying response object using the `getResponse()` method of the DTO :

```php
$entity = $response->dtoOrFail();   // BlueRockTEL\Glpi\Contracts\Entity
$entity->getResponse();             // Saloon\Http\Response
```

> Learn more about working with Data tranfert objects on the [Saloon documentation](https://docs.saloon.dev/digging-deeper/data-transfer-objects).


<a name="usage-extends"></a>

### Extending the Client

You may easily extend the Client by creating your own Resources, Requests, and Entities.

Then, by extending the `GlpiConnector` class, add your new resources to the connector :

```php
use BlueRockTEL\Glpi\GlpiConnector;

class MyCustomConnector extends GlpiConnector
{
    public function defaultConfig(): array
    {
        return [
            'timeout' => 30,
        ];
    }

    public function customResource(): \App\Resources\CustomResource
    {
        return new \App\Resources\CustomResource($this);
    }
}

$api = new MyCustomConnector($apiUrl, $appToken, $userToken);
$api->customResource()->index();
```
