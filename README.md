# Mundipagg One PHP Library

## Composer

    $ composer require mundipagg/mundipagg-one-php

## Manual installation

```php
require __DIR__ . '/mundipagg-one-php/init.php';
```


## Simulator rules by amount

### Authorization

* `<= $ 1.050,00 -> Authorized`
* `>= $ 1.050,01 && < $ 1.051,71 -> Timeout`
* `>= $ 1.500,00 -> Not Authorized`
 
### Capture

* `<= $ 1.050,00 -> Captured`
* `>= $ 1.050,01 -> Not Captured`
 
### Cancellation

* `<= $ 1.050,00 -> Cancelled`
* `>= $ 1.050,01 -> Not Cancelled`
 
### Refund
* `<= $ 1.050,00 -> Refunded`
* `>= $ 1.050,01 -> Not Refunded`

## Documentation

  http://docs.mundipagg.com
  
## More Information
Access the SDK Wiki [HERE](https://github.com/mundipagg/mundipagg-one-php/wiki).
