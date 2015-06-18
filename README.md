# MundiPagg One PHP Library

## Composer

    $ composer require mundipagg/mundipagg-one-php dev-master

## Manual Installation

```php
require __DIR__ . '/mundipagg-one-php/init.php';
```

## Getting Started

### Create transaction

Exemplo do arquivo index.php

```php
require_once(dirname(__FILE__) . '/bootstrap.php');

try
{
    // Define o ambiente utilizado (produção ou homologação)
    \MundiPagg\ApiClient::setEnvironment(\MundiPagg\One\DataContract\Enum\ApiEnvironmentEnum::STAGING);

    // Define a chave da loja
    \MundiPagg\ApiClient::setMerchantKey("26778804-1fa1-4bc8-9623-0a8dce052c2c");

    // Cria objeto requisição
    $createSaleRequest = new \MundiPagg\One\DataContract\Request\CreateSaleRequest();

    // Define dados do pedido
    $createSaleRequest->addCreditCardTransaction()
        ->setPaymentMethodCode(\MundiPagg\One\DataContract\Enum\PaymentMethodEnum::SIMULATOR)
        ->setAmountInCents(199)
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

    // Imprime responsta
    print "<pre>";
    print json_encode($createSaleResponse, JSON_PRETTY_PRINT);
    print "</pre>";
}
catch (\MundiPagg\One\DataContract\Report\ApiError $error)
{
    // Imprime json
    print "<pre>";
    print json_encode($error, JSON_PRETTY_PRINT);
    print "</pre>";
}
catch (Exception $ex)
{
    // Imprime json
    print "<pre>";
    print json_encode($ex, JSON_PRETTY_PRINT);
    print "</pre>";
}

```

### Cancel

Exemplo do arquivo index-cancel.php

```php
require_once(dirname(__FILE__) . '/bootstrap.php');

try
{
    \MundiPagg\ApiClient
    ::setEnvironment(\MundiPagg\Checkout\DataContract\Enum\ApiEnvironmentEnum::STAGING);
   
    \MundiPagg\ApiClient
    ::setMerchantKey("54409272-781D-4470-BFA3-C58A5A005B49");

    //Cria o objeto do cancelamento
    $cancelRequest = new \MundiPagg\Checkout\DataContract\Request\CancelRequest();

    //Define a chave de token para o pedido a ser cancelado (tokenKey gerado anteriormente)
    $cancelRequest->setTokenKey($tokenKey);

    //Solicita o cancelamento
    $cancelResponse = $apiClient->processCancelRequest($cancelRequest);

    // Imprime json
    header("Content-Type: application/json");
    print json_encode($cancelResponse->getData());
}
catch (\MundiPagg\Checkout\DataContract\Report\ApiError $error)
{
    var_dump($error);
}


```


### Cloud Checkout

Exemplo do arquivo index-sendpayment.php

```php
require_once(dirname(__FILE__) . '/bootstrap.php');

try
{
    \MundiPagg\ApiClient
    ::setEnvironment(\MundiPagg\Checkout\DataContract\Enum\ApiEnvironmentEnum::STAGING);
    
    \MundiPagg\ApiClient
    ::setMerchantKey("54409272-781D-4470-BFA3-C58A5A005B49");

     //Cria o objeto do envio do botão de pagamento
    $sendPaymentRequest = new \MundiPagg\Checkout\DataContract\Request\SendPaymentRequest();

    // Define opções do envio do botão de pagamento
    $sendPaymentRequest->getOptions()
        ->enableSendByEmail()
        ->disableSendByTwitter()
    ;

    //Define a chave de token para o pedido a ser enviado (tokenKey gerado anteriormente)
    $sendPaymentRequest->setTokenKey($tokenKey);

    //Define o Email:
    $sendPaymentRequest->setEmail("contato@mundipagg.com");

    //Define a mensagem customizada
    $sendPaymentRequest->setCustomEmailMessage("Teste - Checkout na Nuvem");

    //Define o remetente:
    $sendPaymentRequest->setSenderName("REMETENTE");

    //Define o destinatário:
    $sendPaymentRequest->setReceiverName("DESTINATARIO");

    //Envia a solicitação
    $sendPaymentResponse = $apiClient->processSendPaymentRequest($sendPaymentRequest);   

    // Imprime json
    header("Content-Type: application/json");
    print json_encode($sendPaymentResponse->getData());
}
catch (\MundiPagg\Checkout\DataContract\Report\ApiError $error)
{
    var_dump($error);
}


```

### Query

Exemplo do arquivo index-query.php

```php
require_once(dirname(__FILE__) . '/bootstrap.php');

try
{
    \MundiPagg\ApiClient
    ::setEnvironment(\MundiPagg\Checkout\DataContract\Enum\ApiEnvironmentEnum::STAGING);
    
    \MundiPagg\ApiClient
    ::setMerchantKey("54409272-781D-4470-BFA3-C58A5A005B49");
    
    //Cria o objeto de consulta
    $queryRequest = new \MundiPagg\Checkout\DataContract\Request\QueryRequest();

    //Define a chave de token para o pedido a ser consultado (tokenKey gerado anteriormente)
    $queryRequest->setTokenKey($tokenKey);

    //Solicita a consulta
    $queryResponse = $apiClient->processQueryRequest($queryRequest);

    // Imprime json
    header("Content-Type: application/json");
    print json_encode($queryResponse->getData());
}
catch (\MundiPagg\Checkout\DataContract\Report\ApiError $error)
{
    var_dump($error);
}


```
## Documentation

  http://docs.mundicheckout.apiary.io
