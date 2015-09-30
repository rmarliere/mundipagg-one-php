<?php

require_once(dirname(__FILE__) . '/../init.php');

try
{
    // Define o ambiente utilizado (produção ou homologação)
    \MundiPagg\ApiClient::setEnvironment(\MundiPagg\One\DataContract\Enum\ApiEnvironmentEnum::PRODUCTION);

    // Define a chave da loja
    \MundiPagg\ApiClient::setMerchantKey("merchantKey");

    // Cria objeto requisição
    $request = new \MundiPagg\One\DataContract\Request\RetryRequest();

    // Define dados da requisição
    $request->setOrderKey('df128a6e-6fa4-4d69-b6f9-8844d8ddcda3');
    $creditCardTransaction = new \MundiPagg\One\DataContract\Request\RetryRequestData\RetrySaleCreditCardTransaction();
    $creditCardTransaction->setTransactionKey('35d3a59a-070c-4e4d-b482-d4c8465bc899');

    $request->addRetrySaleCreditCardTransactionCollection($creditCardTransaction);

    //Cria um objeto ApiClient
    $client = new MundiPagg\ApiClient();

    // Faz a chamada para criação
    $response = $client->Retry($request);

    // Imprime responsta
    print "<pre>";
    print json_encode(array('success' => $response->isSuccess(), 'data' => $response->getData()), JSON_PRETTY_PRINT);
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