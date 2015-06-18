# MundiPagg One PHP Library

## Composer

    $ composer require mundipagg/mundipagg-one-php dev-master

## Manual Installation

```php
require __DIR__ . '/mundipagg-one-php/init.php';
```

## Getting Started

```php
try
{
    // Carrega dependências
    require_once(dirname(__FILE__) . '/vendor/autoload.php');

    // Define o ambiente utilizado (produção ou homologação)
    \MundiPagg\ApiClient::setEnvironment(\MundiPagg\One\DataContract\Enum\ApiEnvironmentEnum::STAGING);

    // Define a chave da loja
    \MundiPagg\ApiClient::setMerchantKey("be43cb17-3637-44d0-a45e-d68aaee29f47");

    // Cria objeto requisição
    $createSaleRequest = new \MundiPagg\One\DataContract\Request\CreateSaleRequest();

    // Define dados do pedido
    $createSaleRequest->addCreditCardTransaction()
        ->setPaymentMethodCode(\MundiPagg\One\DataContract\Enum\PaymentMethodEnum::SIMULATOR)
        ->setAmountInCents(150000)
        ->getCreditCard()
            ->setCreditCardBrand(\MundiPagg\One\DataContract\Enum\CreditCardBrandEnum::MASTERCARD)
            ->setCreditCardNumber("5555444433332222")
            ->setExpMonth(12)
            ->setExpYear(2030)
            ->setHolderName("MUNDIPAGG")
            ->setSecurityCode("999")
        ;

    //Cria um objeto ApiClient
    $apiClient = new MundiPagg\ApiClient();

    // Faz a chamada para criação
    $createSaleResponse = $apiClient->createSale($createSaleRequest);

    // Mapeia resposta
    $httpStatusCode = $createSaleResponse->CreditCardTransactionResultCollection[0]->Success ? 201 : 401;
    $response = array("message" => $createSaleResponse->CreditCardTransactionResultCollection[0]->AcquirerMessage);
}
catch (\MundiPagg\One\DataContract\Report\ApiError $error)
{
    $httpStatusCode = $error->errorCollection->ErrorItemCollection[0]->ErrorCode;
    $response = array("message" => $error->errorCollection->ErrorItemCollection[0]->Description);
}
catch (\Exception $ex)
{
    $httpStatusCode = 500;
    $response = array("message" => "Ocorreu um erro inesperado.");
}
finally
{
    // Devolve resposta
    http_response_code($httpStatusCode);
    header('Content-Type: application/json');
    print json_encode($response);
}
```

## Simulator Rules by Amount

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
  
## Other examples

* [Capture](https://github.com/mundipagg/mundipagg-one-php/wiki/Capture-method)
* [Cancel](https://github.com/mundipagg/mundipagg-one-php/wiki/Cancel-method)
