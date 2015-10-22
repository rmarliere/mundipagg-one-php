# gateway One PHP Library

## Composer

    $ composer require gateway/gateway-one-php dev-master

## Manual installation

```php
require __DIR__ . '/gateway-one-php/init.php';
```

## Getting started

```php
try
{
    // Carrega dependências
    require_once(dirname(__FILE__) . '/../init.php');

    // Define o ambiente utilizado (produção ou homologação)
    \gateway\ApiClient::setEnvironment(\gateway\One\DataContract\Enum\ApiEnvironmentEnum::STAGING);

    // Define a chave da loja
    \gateway\ApiClient::setMerchantKey("merchantKey");

    // Cria objeto requisição
    $createSaleRequest = new \gateway\One\DataContract\Request\CreateSaleRequest();

    // Cria objeto do cartão de crédito
    $creditCard = \gateway\One\Helper\CreditCardHelper::createCreditCard("5555 4444 3333 2222", "gateway", "12/2030", "999");

    // Define dados do pedido
    $createSaleRequest->addCreditCardTransaction()
        ->setPaymentMethodCode(\gateway\One\DataContract\Enum\PaymentMethodEnum::SIMULATOR)
        ->setCreditCardOperation(\gateway\One\DataContract\Enum\CreditCardOperationEnum::AUTH_AND_CAPTURE)
        ->setAmountInCents(150000)
        ->setCreditCard($creditCard);
        ;

    // Cria um objeto ApiClient
    $apiClient = new \gateway\ApiClient();

    // Faz a chamada para criação
    $response = $apiClient->createSale($createSaleRequest);

    // Mapeia resposta
    $httpStatusCode = $response->isSuccess() ? 201 : 401;
    $response = array("message" => $response->getData()->CreditCardTransactionResultCollection[0]->AcquirerMessage);
}
catch (\gateway\One\DataContract\Report\CreditCardError $error)
{
    $httpStatusCode = 400;
    $response = array("message" => $error->getMessage());
}
catch (\gateway\One\DataContract\Report\ApiError $error)
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

  http://docs.gateway.com
  
## More Information
Access the SDK Wiki [HERE](https://github.com/gateway/gateway-one-php/wiki).
