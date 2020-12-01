# Myekt Validation
A simple composer package for validate https://myket.ir/ payments

## Installation
Installation is done using the

```bash
$ composer require ehcan/myket_validation
```


## Usage Example
```php
<?php
use \MyketValidator\Validator;

class SomeClass extends SomeInterface {
  public function someMethod(){
    $myket = new Validator($packageName, $token);
    $paymentResult = $myket->validate($sku, $payment_token);

    if($paymentResult['status'] === 200 && $paymentResult['data']['purchaseState'] === 0){
      // success
      // your logic
    }
    else{
      // failed
      // your logic here
    }

  }

}
```