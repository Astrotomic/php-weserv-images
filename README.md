

# PHP images.weserv.nl

[![Latest Version](http://img.shields.io/packagist/v/astrotomic/php-weserv-images.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/astrotomic/php-weserv-images)
[![MIT License](https://img.shields.io/github/license/Astrotomic/php-weserv-images.svg?label=License&color=blue&style=for-the-badge)](https://github.com/Astrotomic/php-weserv-images/blob/master/LICENSE)
[![Offset Earth](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-green?style=for-the-badge)](https://plant.treeware.earth/Astrotomic/php-weserv-images)

[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/Astrotomic/php-weserv-images/run-tests?style=flat-square&logoColor=white&logo=github&label=Tests)](https://github.com/Astrotomic/php-weserv-images/actions?query=workflow%3Arun-tests)
[![StyleCI](https://styleci.io/repos/243765043/shield)](https://styleci.io/repos/243765043)
[![Total Downloads](https://img.shields.io/packagist/dt/astrotomic/php-weserv-images.svg?label=Downloads&style=flat-square)](https://packagist.org/packages/astrotomic/php-weserv-images)

This package provides a fluent PHP OOP builder for [images.weserv.nl](https://images.weserv.nl).

## Installation

You can install the package via composer:

```bash
composer require astrotomic/php-weserv-images
```

## Usage

```php
use Astrotomic\Weserv\Images\Url;
use Astrotomic\Weserv\Images\Enums\Fit;

$url = new Url('https://images.weserv.nl/lichtenstein.jpg');
$url->w(512)->h(512)->we()->fit(Fit::INSIDE);

echo $url;
// https://images.weserv.nl/?w=512&h=512&we=1&fit=inside&url=https%3A%2F%2Fimages.weserv.nl%2Flichtenstein.jpg
```

![](https://images.weserv.nl/?w=512&h=512&we=1&fit=inside&url=https%3A%2F%2Fimages.weserv.nl%2Flichtenstein.jpg)

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please check [SECURITY](https://github.com/Astrotomic/.github/blob/master/SECURITY.md) for steps to report it.

## Credits

- [Tom Witkowski](https://github.com/Gummibeer)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Treeware

You're free to use this package, but if it makes it to your production environment I would highly appreciate you buying the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to [plant trees](https://www.bbc.co.uk/news/science-environment-48870920). If you contribute to my forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees at [offset.earth/treeware](https://plant.treeware.earth/Astrotomic/php-weserv-images)

Read more about Treeware at [treeware.earth](https://treeware.earth)
