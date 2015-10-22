<?php

namespace gateway\One\DataContract\Request\CreateSaleRequestData;

use gateway\One\DataContract\Common\BaseObject;

/**
 * Class BoletoTransactionOptions
 * @package gateway\One\DataContract\Request\CreateSaleRequestData
 */
class BoletoTransactionOptions extends BaseObject
{
    /**
     * @var string Código da moeda utilizada
     */
    protected $CurrencyIso;

    /**
     * @var int Número de dias que serão adicionados à data de expiração do boleto
     */
    protected $DaysToAddInBoletoExpirationDate;

    /**
     * @return string
     */
    public function getCurrencyIso()
    {
        return $this->CurrencyIso;
    }

    /**
     * @param string $currencyIso
     * @return $this
     */
    public function setCurrencyIso($currencyIso)
    {
        $this->CurrencyIso = $currencyIso;

        return $this;
    }

    /**
     * @return int
     */
    public function getDaysToAddInBoletoExpirationDate()
    {
        return $this->DaysToAddInBoletoExpirationDate;
    }

    /**
     * @param int $daysToAddInBoletoExpirationDate
     * @return $this
     */
    public function setDaysToAddInBoletoExpirationDate($daysToAddInBoletoExpirationDate)
    {
        $this->DaysToAddInBoletoExpirationDate = $daysToAddInBoletoExpirationDate;

        return $this;
    }
}