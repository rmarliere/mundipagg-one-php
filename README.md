# MundiPagg One PHP Library

## Composer

    $ composer require mundipagg/mundipagg-one-php dev-master

## Manual installation

```php
require __DIR__ . '/mundipagg-one-php/init.php';
```

## Getting started

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

    // Cria objeto do cartão de crédito
    $creditCard = \MundiPagg\One\Helper\CreditCardHelper::createCreditCard("5555 4444 3333 2222", "MUNDIPAGG", "12/2030", "999");

    // Define dados do pedido
    $createSaleRequest->addCreditCardTransaction()
        ->setPaymentMethodCode(\MundiPagg\One\DataContract\Enum\PaymentMethodEnum::SIMULATOR)
        ->setCreditCardOperation(\MundiPagg\One\DataContract\Enum\CreditCardOperationEnum::AUTH_AND_CAPTURE)
        ->setAmountInCents(150000)
        ->setCreditCard($creditCard);
        ;

    //Cria um objeto ApiClient
    $apiClient = new MundiPagg\ApiClient();

    // Faz a chamada para criação
    $response = $apiClient->createSale($createSaleRequest);

    // Mapeia resposta
    $httpStatusCode = $response->isSuccess() ? 201 : 401;
    $response = array("message" => $response->getData()->CreditCardTransactionResultCollection[0]->AcquirerMessage);
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
  
## Other examples

* [Capture](https://github.com/mundipagg/mundipagg-one-php/wiki/Capture-method)
* [Cancel](https://github.com/mundipagg/mundipagg-one-php/wiki/Cancel-method)
