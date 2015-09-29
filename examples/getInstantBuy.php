<?php

require_once(dirname(__FILE__) . '/../bootstrap.php');

try
{
    // Define o ambiente utilizado (produção ou homologação)
    \MundiPagg\ApiClient::setEnvironment(\MundiPagg\One\DataContract\Enum\ApiEnvironmentEnum::PRODUCTION);

    // Define a chave da loja
    \MundiPagg\ApiClient::setMerchantKey("8A2DD57F-1ED9-4153-B4CE-69683EFADAD5");

    //Cria um objeto ApiClient
    $client = new MundiPagg\ApiClient();

    $instantBuyKey = "37356b3f-32f8-405c-8fc2-1b66dd87547b";

    // Faz a chamada para criação
    $response = $client->GetInstantBuyDataByInstantBuyKey($instantBuyKey);

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