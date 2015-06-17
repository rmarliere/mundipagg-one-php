<?php

namespace MundiPagg\One\DataContract\Request\CreateSaleRequestData;

use MundiPagg\BaseObject;

/**
 * Class Order
 * @package MundiPagg\One\DataContract\Request\CreateSaleRequestData
 */
class Order extends BaseObject
{
    /**
     * @var string Número do pedido no sistema do e-commerce
     */
    protected $OrderReference;

    /**
     * @return string
     */
    public function getOrderReference()
    {
        return $this->OrderReference;
    }

    /**
     * @param string $OrderReference
     * @return $this
     */
    public function setOrderReference($OrderReference)
    {
        $this->OrderReference = $OrderReference;

        return $this;
    }
}