<?php

require_once(dirname(__FILE__) . '/../init.php');

try
{
    // Define o ambiente utilizado (produção ou homologação)
    \MundiPagg\ApiClient::setEnvironment(\MundiPagg\One\DataContract\Enum\ApiEnvironmentEnum::SANDBOX);

    // Define a chave da loja
    \MundiPagg\ApiClient::setMerchantKey("merchantKey");

    // Cria objeto requisição
    $request = new \MundiPagg\One\DataContract\Request\CancelRequest();

    // Define dados da requisição
    $request->setOrderKey("af03f1a7-bb7d-487a-af1b-5bf1631f1c9d");

    //Cria um objeto ApiClient
    $client = new MundiPagg\ApiClient();

    // Faz a chamada para criação
    $response = $client->cancel($request);

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