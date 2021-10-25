# Easy parser FOAF VK

A fast and easy utility for parsing data from [FOAF VK](https://vk.com/foaf.php).

## Prerequisites

You will need `php` version `^8.0`, as well as the `ext-simplexml` dependence.

## Installation

You can install it using Composer using the following command:

```sh
$ composer require wnull/vk-easy-foaf
```

## Using

The `foaf()` function accepts positive (for users) or negative (for groups) numbers.

```php
require __DIR__ . '/vendor/autoload.php';

$parse = new VKEasyFoaf\Parser();

$user = $parse->foaf(19933); // user with id 19933
$group = $parse->foaf(-1); // group with id 1
```

## Result

If the passed id was positive, then an array with the key `Person` will be returned, if with a negative, then `Group`.

## License

[MIT](LICENSE)