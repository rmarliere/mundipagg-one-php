<?php

require_once(dirname(__FILE__) . '/../init.php');

try
{
    // Define a url utilizada
    \gateway\ApiClient::setBaseUrl("https://sandbox.mundipaggone.com");

    // Define a chave da loja
    \gateway\ApiClient::setMerchantKey("85328786-8BA6-420F-9948-5352F5A183EB");

    // Cria objeto requisição
    $request = new \gateway\One\DataContract\Request\CaptureRequest();

    // Define dados da requisição
    $request->setOrderKey("d1ecdef4-7b70-47fb-8ba7-76b32843936c");

    //Cria um objeto ApiClient
    $client = new gateway\ApiClient();

    // Faz a chamada para criação
    $response = $client->capture($request);

    print "<pre>";
    print json_encode($response, JSON_PRETTY_PRINT);
    print "</pre>";

    // Imprime resposta
    print "<pre>";
    print json_encode(array('success' => $response->isSuccess(), 'data' => $response->getData()), JSON_PRETTY_PRINT);
    print "</pre>";
}
catch (\gateway\One\DataContract\Report\ApiError $error)
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