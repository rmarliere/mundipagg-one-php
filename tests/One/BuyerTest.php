<?php

namespace MundiPagg\One;

use MundiPagg\One\DataContract\Request\CreateSaleRequestData\Buyer;

class BuyerTest extends \PHPUnit_Framework_TestCase
{
    public function testBirthDate()
    {
        $buyer = new Buyer();

        $birthDate = \DateTime::createFromFormat('d/m/Y', '11/05/1990');
        $buyer->setBirthDate($birthDate);

        $this->assertNotEmpty($buyer->getBirthDate());
        $this->assertEquals($birthDate, $buyer->getBirthDate());
    }

    public function testBuyerAddressCollection()
    {
        $buyer = new Buyer();

        $this->assertTrue(is_array($buyer->getBuyerAddressCollection()));
        $this->assertCount(0, $buyer->getBuyerAddressCollection());

        $buyer->addBuyerAddress()
            ->setAddressType(DataContract\Enum\AddressTypeEnum::COMMERCIAL)
            ->setStreet("Rua da Quitanda")
            ->setNumber("199")
            ->setComplement("10º andar")
            ->setDistrict("Centro")
            ->setCity("Rio de Janeiro")
            ->setState("RJ")
            ->setCountry("Brasil")
            ->setZipCode("20091-005")
            ;
        $this->assertCount(1, $buyer->getBuyerAddressCollection());

        $buyerAddressCollection = $buyer->getBuyerAddressCollection();
        $firstBuyerAddress = $buyerAddressCollection[0];
        $this->assertNotNull($firstBuyerAddress);

        $this->assertEquals(DataContract\Enum\AddressTypeEnum::COMMERCIAL, $firstBuyerAddress->getAddressType());
        $this->assertEquals("Rua da Quitanda", $firstBuyerAddress->getStreet());
        $this->assertEquals("199", $firstBuyerAddress->getNumber());
        $this->assertEquals("10º andar", $firstBuyerAddress->getComplement());
        $this->assertEquals("Centro", $firstBuyerAddress->getDistrict());
        $this->assertEquals("Rio de Janeiro", $firstBuyerAddress->getCity());
        $this->assertEquals("RJ", $firstBuyerAddress->getState());
        $this->assertEquals("Brasil", $firstBuyerAddress->getCountry());
        $this->assertEquals("20091-005", $firstBuyerAddress->getZipCode());
    }
}