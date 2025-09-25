# LHDN MyInvoice

This is a PHP SDK for integrating with LHDN MyInvoice.

## Requirements
- PHP >= 7.4
- Composer

## Installation

Install via Composer:

```bash
composer require elaniaresource/myinvoice "*"
```

## Usage

```php
use MyInvoice\MyInvoiceClient;

$client = new MyInvoiceClient(/* config */);
// ...
```

## License
MIT

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## Packagist
To publish, ensure your repository is public and contains a valid `composer.json` and `LICENSE` file.

## Testing
Run PHPUnit:

```bash
vendor/bin/phpunit
```
