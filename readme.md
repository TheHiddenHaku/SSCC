Serial Shipping Container Code (S.S.C.C.) Calculator
===============

A simple PHP class to calculate a full SSCC code given your vendor code and shipping number

```php
$vendorCode = 800200800;
$shippingNumber = 1234;
$sscc = new TheHiddenHaku\SerialShippingContainerCode\SerialShippingContainerCode($vendorCode);
echo $sscc->calculate($shippingNumber);
//echoes '080020080000012346'
```

### Installation
install with composer
```
composer require thehiddenhaku/sscc
```

### Usage

First you need to instantiate the class
```php
$sscc = new TheHiddenHaku\SerialShippingContainerCode\SerialShippingContainerCode($vendorCode, $extensionDigit);
```
The first parameter `$vendorCode` is your personal vendor code.\s\s
The code must be assigned to you (or your client) by and authority.\s\s
It can be either 7 or 9 digit long.

The second parameter `$extensionDigit` is an optional digit that will be added at the beginning of the code.\s\s
It defaults to `0` but you can override it with any positive integer between `0` and `9`

Once the class is ready, just call the `calculate()` method like this
```php
$code = $sscc->calculate($shippingNumber);
```
the parameter `$shippingNumber` id the progressive number of your shipping.\s\s
If your `$vendorCode` is 7 digit your `$shippingNumber` must be 9 digit (it will be "zerofilled" behind the scene)\s\s
if your `$vendorCode` is 9 digit your `$shippingNumber` must be 7 digit (it will be "zerofilled" behind the scene)\s\s
The method will return a complete SSCC code (with the correct Check Digit) which you can use where needed for instance in logistic labels

###Testing

I used phpunit so you can just run
```php
vendor/bin/phpunit
```

### Contribute

Feel free to contribute and improve the class. just fork it and open you PR

### License

This library is licensed under the MIT license. Please see [License file](LICENSE.txt) for more information.