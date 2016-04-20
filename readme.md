Serial Shipping Container Code (S.S.C.C.) Calculator
===============

A simple PHP class to calculate a full SSCC code given your vendor code and shipping id

```php
//$vendorCode can be 7 or 8 digits.
//You must have yours and it should be assigned to you by an authority.
$vendorCode = 800800800;
//$shippingId should be the progressive shipping number of your paller of box or whatever
$shippingId = 1234;
$sscc = new new TheHiddenHaku\SerialShippingContainerCode\SerialShippingContainerCode($vendorCode);
echo $sscc->calculate($shippingId);
//echoes '080020080000012346'
```