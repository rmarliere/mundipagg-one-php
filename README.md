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
    \MundiPagg\ApiClient::
        setEnvironment(\MundiPagg\One\DataContract\Enum\ApiEnvironmentEnum::STAGING);

    // Define a chave da loja
    \MundiPagg\ApiClient::
        setMerchantKey("26778804-1fa1-4bc8-9623-0a8dce052c2c");

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

    // Imprime resposta
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

## Documentation

  http://docs.mundipagg.com
