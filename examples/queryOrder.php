<?php

require_once(dirname(__FILE__) . '/../init.php');

try
{
    // Define o ambiente utilizado (produção ou homologação)
    \MundiPagg\ApiClient::setEnvironment(\MundiPagg\One\DataContract\Enum\ApiEnvironmentEnum::PRODUCTION);

    // Define a chave da loja
    \MundiPagg\ApiClient::setMerchantKey("merchantKey");

    //Cria um objeto ApiClient
    $client = new MundiPagg\ApiClient();

    // Faz a chamada para criação
    $response = $client->searchSaleByOrderKey("d45f99c9-ef85-4773-9926-1130b1b81fe5");

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