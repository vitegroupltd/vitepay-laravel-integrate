# vitepay.dev Laravel

The free Laravel package to help you integrate with vitepay.dev

## Use Cases

- Create and manage software with vitepay.dev 
- Manage devices with vitepay.dev
- Create and manage licenses with vitepay.dev

## Features

- Dynamic vitepay.dev credentials from config/vitepay.php
- Easy to manage your software licenses with a few lines of coding

## Requirements

- **PHP**: 8.1 or higher
- **Laravel** 9.0 or higher

## Quick Start

If you prefer to install this package into your own Laravel application, please follow the installation steps below

## Installation

#### Step 1. Install a Laravel project if you don't have one already

https://laravel.com/docs/installation

#### Step 2. Require the current package using composer:

```bash
composer require vitegroupltd/vitepay-laravel-integrate
```

#### Step 3. Publish the controller file and config file

```bash
php artisan vendor:publish --provider="ViteGroup\VitePay\VitePayServiceProvider" --tag="vitepay"
```

If publishing files fails, please create corresponding files at the path `config/vitepay.php` and `app\Http\Controllers\VitePayControllers.php` from this package. And you can also further customize the VitePayControllers.php file to suit your project.

#### Step 4. Update the various config settings in the published config file:

After publishing the package assets a configuration file will be located at <code>config/vitepay.php</code>. Please find in vitepay.dev to get those values to fill into the config file.

<!--- ## Usage --->

## Testing

``` php
<?php

namespace App\Console\Commands;

use GuzzleHttp\Exception\GuzzleException;
use ViteGroup\VitePay\VitePayTransactions;
use Illuminate\Console\Command;

class VitePayTestCommand extends Command
{
    protected $signature = 'vitepay:test';

    protected $description = 'Test VitePay SDK';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws GuzzleException
     */
    public function handle()
    {
        $instance = new VitePayTransactions();
        print_r($instance->create(
            'INV-test-01',
            '',
            100000,
            'Description-test-01'
        ));
    }
}
```

## RESTful API Documentation

Please see [POSTMAN DOCUMENTATION](https://documentation.vitepay.dev) for details.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email contact@ViteGroup.vn or use the issue tracker.

## Credits

- [Vite., Ltd](https://github.com/vitegroupltd)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
