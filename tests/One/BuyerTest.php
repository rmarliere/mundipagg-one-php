<?php

namespace Gateway\One;

use Gateway\One\DataContract\Request\CreateSaleRequestData\Buyer;

class BuyerTest extends \PHPUnit_Framework_TestCase
{
    public function testBirthDate()
    {
        $buyer = new Buyer();

        $birthDate = \DateTime::createFromFormat('d/m/Y', '11/05/1990');
        $buyer->setBirthdate($birthDate);

        $this->assertNotEmpty($buyer->getBirthdate());
        $this->assertEquals($birthDate, $buyer->getBirthdate());
    }
}