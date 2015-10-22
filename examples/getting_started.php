<?php

require_once(dirname(__FILE__) . '/../init.php');

try
{
    // Define a url utilizada
    \gateway\ApiClient::setBaseUrl("url_here");

    // Define a chave da loja
    \gateway\ApiClient::setMerchantKey("85328786-8BA6-420F-9948-5352F5A183EB");

    // Cria objeto requisição
    $createSaleRequest = new \gateway\One\DataContract\Request\CreateSaleRequest();

    // Cria objeto do cartão de crédito
    $creditCard = \gateway\One\Helper\CreditCardHelper::createCreditCard("5555 4444 3333 2222", "gateway", "12/2030", "999");

    // Define dados do pedido
    $createSaleRequest->addCreditCardTransaction()
        ->setPaymentMethodCode(\gateway\One\DataContract\Enum\PaymentMethodEnum::SIMULATOR)
        ->setCreditCardOperation(\gateway\One\DataContract\Enum\CreditCardOperationEnum::AUTH_ONLY)
        ->setAmountInCents(1098) // R$ 10,98
        ->setCreditCard($creditCard);
        ;

    //Cria um objeto ApiClient
    $apiClient = new gateway\ApiClient();

    // Faz a chamada para criação
    $response = $apiClient->createSale($createSaleRequest);

    // Mapeia resposta
    $httpStatusCode = $response->isSuccess() ? 201 : 401;
    $response = array("message" => $response->getData()->CreditCardTransactionResultCollection[0]->AcquirerMessage, "data" => $response->getData());
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
    print json_encode($response, JSON_PRETTY_PRINT);
}