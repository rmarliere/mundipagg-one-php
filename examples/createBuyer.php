<?php

require_once(dirname(__FILE__) . '/../init.php');

try
{
    // Define a url utilizada
    \Gateway\ApiClient::setBaseUrl("https://stagingv2.mundipaggone.com/Buyer/");

    // Define a chave da loja
    \Gateway\ApiClient::setMerchantKey("85328786-8BA6-420F-9948-5352F5A183EB");

    // Cria objeto requisição
    $request = new \Gateway\One\DataContract\Request\CreateSaleRequestData\BuyerContract();

    $request
    ->setBirthDate(\DateTime::createFromFormat('d/m/Y', '11/05/1990'))
    ->setBuyerCategory(\Gateway\One\DataContract\Enum\BuyerCategoryEnum::PLUS)
    ->setBuyerReference("123456")
    ->setCreateDateInMerchant(new \DateTime())
    ->setDocumentNumber("58828172000138")
    ->setDocumentType(\Gateway\One\DataContract\Enum\DocumentTypeEnum::CNPJ)
    ->setEmail("comprador@gateway.com")
    ->setEmailType(\Gateway\One\DataContract\Enum\EmailTypeEnum::COMERCIAL)
    ->setFacebookId("1234567890")
    ->setGender(\Gateway\One\DataContract\Enum\GenderEnum::MALE)
    ->setHomePhone("3003-0460")
    ->setIpAdress()
    ->setLastBuyerUpdateInMerchant(new \DateTime())
    ->setMobilePhone("99999-8888")
    ->setName("Comprador Mundi")
    ->setPersonType(\Gateway\One\DataContract\Enum\PersonTypeEnum::COMPANY)
    ->setTwitterId("1234567890")
    ->setWorkPhone("99999-7777")
    ->addAddress()
    ->setAddressType(\Gateway\One\DataContract\Enum\AddressTypeEnum::COMMERCIAL)
    ->setStreet("Rua da Quitanda")
    ->setNumber("199")
    ->setComplement("10º andar")
    ->setDistrict("Centro")
    ->setCity("Rio de Janeiro")
    ->setState("RJ")
    ->setZipCode("20091005")
    ->setCountry(\Gateway\One\DataContract\Enum\CountryEnum::BRAZIL);


    //Cria um objeto ApiClient
    $client = new Gateway\ApiClient();

    // Faz a chamada para criação
    $response = $client->createBuyer($request);

    // Imprime resposta
    print "<pre>";
    print json_encode(array('success' => $response->isSuccess(), 'data' => $response->getData()), JSON_PRETTY_PRINT);
    print "</pre>";
}
catch (\Gateway\One\DataContract\Report\ApiError $error)
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