<?php

namespace MundiPagg\One\DataContract\Response;

/**
 * Class BaseResponse
 * @package MundiPagg\One\DataContract\Response
 */
/**
 * Class BaseResponse
 * @package MundiPagg\One\DataContract\Response
 */
class BaseResponse
{
    /**
     * @var bool
     */
    private $isSuccess;

    /**
     * @var object
     */
    private $data;

    /**
     * @param $isSuccess bool
     * @param $data
     */
    function __construct($isSuccess, $data)
    {
        $this->data = $data;
        $this->isSuccess = $isSuccess;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->isSuccess;
    }

    /**
     * @return object
     */
    public function getData()
    {
        return $this->data;
    }
}