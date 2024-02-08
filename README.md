# Embloy-PHP
Embloy's PHP SDK for interacting with your Embloy integration.

## Installation

You can install the Embloy PHP SDK via Composer. Run the following command in your terminal:

```bash
composer require embloy/embloy-php
```

## Usage

To use the Embloy PHP SDK, you'll need to initialize an EmbloyClient object with your client token and session information. Here's an example of how to use it:

```php
use Embloy\EmbloyClient;
use Embloy\EmbloySession;

// Create an instance of EmbloySession
$session = new EmbloySession('mode', 'job_slug', ['success_url' => 'optional_success_url', 'cancel_url' => 'optional_cancel_url']);

// Create an instance of EmbloyClient
$client = new EmbloyClient('your-client-token', $session);

try {
    // Make a request to generate the URL
    $url = $client->makeRequest();
    echo "Application URL: $url";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

## Run Tests

To run the tests for the Embloy PHP SDK, you'll need PHPUnit installed. If you haven't already installed PHPUnit, you can do so via Composer. Run the following command:

```bash
composer require --dev phpunit/phpunit
```

Once PHPUnit is installed, you can run the tests with the following command:

```bash
vendor/bin/phpunit tests
```

## Publish Package
    
To publish the Embloy PHP SDK package, ensure that your package meets the Composer's standards by validating it with the following command:

```bash
composer validate
```

---

© Carlo Bortolan, Jan Hummel

> Carlo Bortolan &nbsp;&middot;&nbsp;
> GitHub [@carlobortolan](https://github.com/carlobortolan) &nbsp;&middot;&nbsp;
> contact via [bortolanoffice@embloy.com](mailto:bortolanoffice@embloy.com)
>
> Jan Hummel &nbsp;&middot;&nbsp;
> GitHub [@github4touchdouble](https://github.com/github4touchdouble) &nbsp;&middot;&nbsp;
> contact via [hummeloffice@embloy.com](mailto:hummeloffice@embloy.com)
