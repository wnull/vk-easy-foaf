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

**Notice**: The constructor can accept an array with the key `delimiter`, if the value is FALSE, it removes prefixes (such as `rdf`, `dc`, `img` with `_`) from the keys from the `attributes` subarray.

The `foaf()` function accepts positive (for users) or negative (for groups) numbers.

```php
require __DIR__ . '/vendor/autoload.php';

$parse = new \VK\FOAF\Parser([
    //'delimiter' => false
]);

$user = $parse->foaf(19933); // user with id 19933
$group = $parse->foaf(-1); // group with id 1
```

## Result

The result is an array. If the passed identifier was positive, then an array with the key `Person` will be returned, if with a negative, then `Group`.

## License

The utility is distributed under the [MIT](https://github.com/wnull/vk-easy-foaf/blob/master/LICENSE) license.