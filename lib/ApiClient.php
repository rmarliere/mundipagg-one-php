<?php

namespace MundiPagg;

/**
 * Class ApiClient
 * @package MundiPagg
 */
use MundiPagg\One\DataContract\Enum\ApiMethodEnum;
use MundiPagg\One\DataContract\Enum\ApiResourceEnum;

/**
 * Class ApiClient
 * @package MundiPagg
 */
class ApiClient
{
    /**
     * @var string
     */
    static private $merchantKey;

    /**
     * @var string
     */
    static private $environment;

    /**
     * @var boolean
     */
    static private $isSslCertsVerificationEnabled = true;

    /**
     * @param string $environment
     */
    public static function setEnvironment($environment)
    {
        self::$environment = $environment;
    }

    /**
     * @return string
     */
    public static function getEnvironment()
    {
        return self::$environment;
    }

    /**
     * @param string $merchantKey
     */
    public static function setMerchantKey($merchantKey)
    {
        self::$merchantKey = $merchantKey;
    }

    /**
     * @return string
     */
    public static function getMerchantKey()
    {
        return self::$merchantKey;
    }

    /**
     * @return boolean
     */
    public static function isSslCertsVerificationEnabled()
    {
        return self::$isSslCertsVerificationEnabled;
    }

    /**
     * @return string
     * @throws Exception
     */
    private function getBaseUrl()
    {
        switch (self::getEnvironment())
        {
            case One\DataContract\Enum\ApiEnvironmentEnum::PRODUCTION: return 'https://transactionv2.mundipaggone.com';
            case One\DataContract\Enum\ApiEnvironmentEnum::STAGING: return 'https://stagingv2.mundipaggone.com';
            case One\DataContract\Enum\ApiEnvironmentEnum::INSPECTOR: return 'https://stagingv2-mundipaggone-com-9blwcrfjp9qk.runscope.net';

            default: throw new Exception("The api environment was not defined.");
        }
    }

    /**
     * @param $resource
     * @return string
     */
    private function buildUrl($resource)
    {
        $url = sprintf("%s/%s", $this->getBaseUrl(), $resource);

        return $url;
    }


    /**
     * @param $resource
     * @param $method
     * @param $data
     * @return array
     * @throws Exception
     */
    private function getOptions($resource, $method, $data)
    {
        $options = array
        (
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_URL => $this->buildUrl($resource),
            CURLOPT_HTTPHEADER => array
            (
                'Content-type: application/json',
                'Accept: application/json',
                'MerchantKey: '.self::getMerchantKey()
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_SSL_VERIFYPEER => self::isSslCertsVerificationEnabled()
        );

        // Associa o certificado para a verificação
        if (self::isSslCertsVerificationEnabled())
        {
            $options[CURLOPT_CAINFO] = dirname(__FILE__) . '/../data/ca-certificates.crt';
        }

        switch ($method)
        {
            case One\DataContract\Enum\ApiMethodEnum::POST:
                $options[CURLOPT_POSTFIELDS] = json_encode($data);
                break;
            case One\DataContract\Enum\ApiMethodEnum::GET:
                $options[CURLOPT_URL] = $this->buildUrl($resource).'&'.http_build_query($data);
                break;
            case One\DataContract\Enum\ApiMethodEnum::PUT:
                $options[CURLOPT_POSTFIELDS] = json_encode($data);
                break;
            case One\DataContract\Enum\ApiMethodEnum::DELETE:
                $options[CURLOPT_URL] = $this->buildUrl($resource).'&'.http_build_query($data);
                break;
            default:
                throw new Exception("Invalid http method.");
        }

        return $options;
    }

    /**
     * @param $resource
     * @param $method
     * @param $data
     * @return mixed
     * @throws One\DataContract\Report\ApiError
     * @throws Exception
     * @throws \Exception
     */
    private function sendRequest($resource, $method, $data)
    {
        // Inicializa sessão cURL
        $curlSession = curl_init();

        // Define as opções da sessão
        curl_setopt_array($curlSession, $this->getOptions($resource, $method, $data));

        // Dispara a requisição cURL
        $responseBody = curl_exec($curlSession);

        // Obtém o status code http retornado
        $httpStatusCode = curl_getinfo($curlSession, CURLINFO_HTTP_CODE);

        // Fecha a sessão cURL
        curl_close($curlSession);
        
        // Verifica se não obteve resposta
        if (!$responseBody) throw new \Exception("Error Processing Request", 1);

        // Decodifica a resposta json
        $response = json_decode($responseBody);

        // Verifica se obteve sucesso
        $success = $httpStatusCode >= 200 && $httpStatusCode < 300;

        // Trata os erros
        if ($success == false)
        {
            @$this->handleApiError($httpStatusCode, $response->RequestKey, $response->ErrorReport, $data, $responseBody);
        }

        // Retorna a resposta
        return $response;
    }

    /**
     * @param One\DataContract\Request\CreateSaleRequest $createSaleRequest
     * @return One\DataContract\Response\CreateSaleResponse
     */
    public function createSale(One\DataContract\Request\CreateSaleRequest $createSaleRequest)
    {
        $responseContent = $this->sendRequest(ApiResourceEnum::SALE, ApiMethodEnum::POST, $createSaleRequest->getData());

        return $responseContent;
    }

    /**
     * @param $httpStatusCode
     * @param $requestKey
     * @param $errorCollection
     * @param $requestData
     * @param $responseBody
     * @throws One\DataContract\Report\ApiError
     */
    private function handleApiError($httpStatusCode, $requestKey, $errorCollection, $requestData, $responseBody)
    {
        throw new One\DataContract\Report\ApiError($httpStatusCode, $requestKey, $errorCollection, $requestData, $responseBody);
    }
}
