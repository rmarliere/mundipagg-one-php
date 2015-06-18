<?php

require_once(dirname(__FILE__) . '/../bootstrap.php');

try
{
    // Define o ambiente utilizado (produção ou homologação)
    \MundiPagg\ApiClient::setEnvironment(\MundiPagg\One\DataContract\Enum\ApiEnvironmentEnum::INSPECTOR);

    // Define a chave da loja
    \MundiPagg\ApiClient::setMerchantKey("8a2dd57f-1ed9-4153-b4ce-69683efadad5");

    // Cria objeto requisição
    $request = new \MundiPagg\One\DataContract\Request\CancelRequest();

    // Define dados da requisição
    $request->setOrderKey("2d79380f-2256-4854-963d-1174a8615db7");

    //Cria um objeto ApiClient
    $client = new MundiPagg\ApiClient();

    // Faz a chamada para criação
    $response = $client->cancel($request);

    // Imprime responsta
    print "<pre>";
    print json_encode($response, JSON_PRETTY_PRINT);
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