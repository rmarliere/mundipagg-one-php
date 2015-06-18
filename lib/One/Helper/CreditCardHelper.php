<?php

namespace MundiPagg\One\Helper;

use MundiPagg\One\DataContract\Enum\CreditCardBrandEnum;

/**
 * Class CreditCardHelper
 * @package MundiPagg\One\Helper
 */
abstract class CreditCardHelper
{
    /**
     * Obtém a bandeira do cartão a partir do número
     * @param string $number Número do cartão
     * @return string Bandeira do cartão
     */
    public static function getBrandByNumber($number)
    {
        // Extrai somente números do cartão
        $number = preg_replace("/[^0-9a-zA-Z ]/", "", $number);

        if (in_array(substr($number, 0, 6), array('401178', '504175', '509002', '509003', '438935', '457631', '451416', '457632', '506726', '506727', '506739', '506741', '506742', '506744', '506747', '506748', '506778', '636297', '636368', '637095')))
        {
            return CreditCardBrandEnum::ELO;
        }
        elseif (substr($number, 0, 4) == '6011' || substr($number, 0, 3) == '622' || in_array(substr($number, 0, 2), array('64', '65')))
        {
            return CreditCardBrandEnum::DISCOVER;
        }
        elseif (in_array(substr($number, 0, 3), array('301', '305')) || in_array(substr($number, 0, 2), array('36', '38')))
        {
            return CreditCardBrandEnum::DINERS;
        }
        elseif (in_array(substr($number, 0, 2), array('34', '37')))
        {
            return CreditCardBrandEnum::AMEX;
        }
        elseif (substr($number, 0, 2) == '50')
        {
            return CreditCardBrandEnum::AURA;
        }
        elseif (in_array(substr($number, 0, 2), array('38', '60')))
        {
            return CreditCardBrandEnum::HIPERCARD;
        }
        elseif ($number[0] == '4')
        {
            return CreditCardBrandEnum::VISA;
        }
        elseif ($number[0] == '5')
        {
            return CreditCardBrandEnum::MASTERCARD;
        }
        else
        {
            return null;
        }
    }
}