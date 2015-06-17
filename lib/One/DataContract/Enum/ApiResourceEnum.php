<?php

namespace MundiPagg\One\DataContract\Enum;

/**
 * Class ApiResourceEnum
 * @package MundiPagg\One\DataContract\Enum
 */
abstract class ApiResourceEnum
{
    const SALE = 'sale/';
    const CAPTURE = 'sale/capture';
    const CANCEL = 'sale/cancel';
    const RETRY = 'sale/retry';
    const QUERY = 'sale/query';
}