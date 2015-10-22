<?php

require_once(dirname(__FILE__) . '/../init.php');

try
{
    // Define a url utilizada
    \gateway\ApiClient::setBaseUrl("https://api.mundipaggone.com");

    // Define a chave da loja
    \gateway\ApiClient::setMerchantKey("8A2DD57F-1ED9-4153-B4CE-69683EFADAD5");

    //Cria um objeto ApiClient
    $client = new gateway\ApiClient();

    // Faz a chamada para criação
    $response = $client->SearchTransactionReportFile('20150928');

    // Imprime resposta
    print "<pre>";
    var_dump($response);
    print "</pre>";
}
catch (\gateway\One\DataContract\Report\ApiError $error)
{
    // Imprime json
    print "<pre>";
    print ($error);
    print "</pre>";
}
catch (Exception $ex)
{
    // Imprime json
    print "<pre>";
    print ($ex);
    print "</pre>";
}