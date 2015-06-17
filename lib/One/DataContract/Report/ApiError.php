<?php

namespace MundiPagg\One\DataContract\Report;

/**
 * Class ApiError
 * @package MundiPagg\One\DataContract\Report
 */
/**
 * Class ApiError
 * @package MundiPagg\One\DataContract\Report
 */
class ApiError extends \Exception
{
    /**
     * @var string HTTP Status Code
     */
    public $httpStatusCode;

    /**
     * @var Chave da requisição
     */
    public $requestKey;

    /**
     * @var string
     */
    public $responseBody;

    /**
     * @var array
     */
    public $errorCollection;

    /**
     * @var
     */
    public $requestData;

    /**
     * @param string $httpStatusCode
     * @param string $requestKey
     * @param int $errorCollection
     * @param \Exception $requestData
     * @param $responseBody
     */
    function __construct($httpStatusCode, $requestKey, $errorCollection, $requestData, $responseBody)
    {
        $this->httpStatusCode = $httpStatusCode;
        $this->requestKey = $requestKey;
        $this->errorCollection = $errorCollection;
        $this->requestData = $requestData;
        $this->responseBody = $responseBody;
    }
}