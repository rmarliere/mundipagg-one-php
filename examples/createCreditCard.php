<?php

require_once(dirname(__FILE__) . '/../bootstrap.php');

try
{
    // Define o ambiente utilizado (produção ou homologação)
    \MundiPagg\ApiClient::setEnvironment(\MundiPagg\One\DataContract\Enum\ApiEnvironmentEnum::PRODUCTION);

    // Define a chave da loja
    \MundiPagg\ApiClient::setMerchantKey("8A2DD57F-1ED9-4153-B4CE-69683EFADAD5");

    // Cria objeto requisição
    $request = new \MundiPagg\One\DataContract\Request\CreateSaleRequest();

    // Dados da transação de cartão de crédito
    $creditCardTransaction = new \MundiPagg\One\DataContract\Request\CreateSaleRequestData\CreditCardTransaction();
    $request->addCreditCardTransaction($creditCardTransaction);
    $creditCardTransaction
    ->setAmountInCents(100)
    ->setInstallmentCount(1)
    ->setCreditCardOperation(\MundiPagg\One\DataContract\Enum\CreditCardOperationEnum::AUTH_ONLY)
    ->setTransactionDateInMerchant(new DateTime())
    ->setTransactionReference(uniqid())
    ->getCreditCard()
        //->setInstantBuyKey("d9ff84f1-67a1-49b3-9a5d-a18d7af6d6ba")
    ->setCreditCardBrand(\MundiPagg\One\DataContract\Enum\CreditCardBrandEnum::MASTERCARD)
    ->setCreditCardNumber("5555444433332222")
    ->setExpMonth(12)
    ->setExpYear(2030)
    ->setHolderName("MUNDIPAGG TESTE")
    ->setSecurityCode("999")
    ->getBillingAddress()
    ->setAddressType(\MundiPagg\One\DataContract\Enum\AddressTypeEnum::BILLING)
    ->setStreet("Rua da Quitanda")
    ->setNumber("199")
    ->setComplement("10º andar")
    ->setDistrict("Centro")
    ->setCity("Rio de Janeiro")
    ->setState("RJ")
    ->setZipCode("20091005")
    ->setCountry(\MundiPagg\One\DataContract\Enum\CountryEnum::BRAZIL);

    // Options do credit card transaction
    $creditCardTransaction->getOptions()
    ->setCurrencyIso(\MundiPagg\One\DataContract\Enum\CurrencyIsoEnum::BRL)
    ->setCaptureDelayInMinutes(0)
    ->setIataAmountInCents(0)
    ->setInterestRate(0)
    ->setPaymentMethodCode(\MundiPagg\One\DataContract\Enum\PaymentMethodEnum::SIMULATOR)
    ->setSoftDescriptorText("TESTE");

    // Dados do comprador
    $request->getBuyer()
    ->setName("Comprador Mundi")
        //->setBuyerKey("61a86e1d-b132-4636-98ec-339cfe493c00")
    ->setPersonType(\MundiPagg\One\DataContract\Enum\PersonTypeEnum::COMPANY)
    ->setBuyerReference("123456")
    ->setBuyerCategory(\MundiPagg\One\DataContract\Enum\BuyerCategoryEnum::PLUS)
    ->setDocumentNumber("58828172000138")
    ->setDocumentType(\MundiPagg\One\DataContract\Enum\DocumentTypeEnum::CNPJ)
    ->setEmail("comprador@mundipagg.com")
    ->setEmailType(\MundiPagg\One\DataContract\Enum\EmailTypeEnum::COMERCIAL)
    ->setGender(\MundiPagg\One\DataContract\Enum\GenderEnum::MALE)
    ->setHomePhone("3003-0460")
    ->setMobilePhone("99999-8888")
    ->setBirthDate(\DateTime::createFromFormat('d/m/Y', '11/05/1990'))
    ->setFacebookId("1234567890")
    ->setTwitterId("1234567890")
    ->setCreateDateInMerchant(new \DateTime())
    ->setLastBuyerUpdateInMerchant(new \DateTime())
    ->addAddress()
    ->setAddressType(\MundiPagg\One\DataContract\Enum\AddressTypeEnum::COMMERCIAL)
    ->setStreet("Rua da Quitanda")
    ->setNumber("199")
    ->setComplement("10º andar")
    ->setDistrict("Centro")
    ->setCity("Rio de Janeiro")
    ->setState("RJ")
    ->setZipCode("20091005")
    ->setCountry(\MundiPagg\One\DataContract\Enum\CountryEnum::BRAZIL);

    $request->getMerchant()
    ->setMerchantReference("MUNDIPAGG LOJA 1");

    $request->getOptions()
    ->disableAntiFraud()
    ->setAntiFraudServiceCode("123")
    ->setCurrencyIso(\MundiPagg\One\DataContract\Enum\CurrencyIsoEnum::BRL)
    ->setRetries(3);

    $request->getOrder()
    ->setOrderReference(uniqid());

    $request->getRequestData()
    ->setEcommerceCategory(\MundiPagg\One\DataContract\Enum\EcommerceCategoryEnum::B2B)
    ->setIpAddress("255.255.255.255")
    ->setOrigin("123")
    ->setSessionId(uniqid());

    // Carrinho de compras
    $shoppingCart = $request->addShoppingCart();
    $shoppingCart->setDeliveryDeadline(new DateTime());
    $shoppingCart->setEstimatedDeliveryDate(new DateTime());
    $shoppingCart->setFreightCostInCents(199);
    $shoppingCart->setShippingCompany("Correios");
    $shoppingCart->getDeliveryAddress()
    ->setAddressType(\MundiPagg\One\DataContract\Enum\AddressTypeEnum::SHIPPING)
    ->setStreet("Rua da Quitanda")
    ->setNumber("199")
    ->setComplement("10º andar")
    ->setDistrict("Centro")
    ->setCity("Rio de Janeiro")
    ->setState("RJ")
    ->setZipCode("20091005")
    ->setCountry(\MundiPagg\One\DataContract\Enum\CountryEnum::BRAZIL);

    $shoppingCart->addShoppingCartItem()
    ->setDescription("Apple iPhone 5s 16gb")
    ->setDiscountAmountInCents(160000)
    ->setItemReference("AI5S")
    ->setName("iPhone 5S")
    ->setQuantity(1)
    ->setUnitCostInCents(1800)
    ->setTotalCostInCents(1600);

    $shoppingCart->addShoppingCartItem()
    ->setDescription("TESTE")
    ->setDiscountAmountInCents(0)
    ->setItemReference("TESTE")
    ->setName("TESTE")
    ->setQuantity(2)
    ->setUnitCostInCents(1099)
    ->setTotalCostInCents(2198);

    //Cria um objeto ApiClient
    $client = new MundiPagg\ApiClient();

    // Faz a chamada para criação
    $response = $client->createSale($request);

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