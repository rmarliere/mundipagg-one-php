<?php

namespace MundiPagg\One\DataContract\Enum;

/**
 * Class CreditCardOperationEnum
 * @package MundiPagg\One\DataContract\Enum
 */
abstract class CreditCardOperationEnum
{
    /**
     * Realiza a pré-autorização do valor no cartão do cliente.
     * Necessário operação posterior por parte da loja através da operação de captura /Capture para a confirmação da transação.
     */
    const AUTH_ONLY = 'AuthOnly';

    /**
     * Realiza a autorização seguida de captura autormaticamente na adquirente.
     * Não necessita de uma operação posterior por parte da loja para a confirmação da transação
     */
    const AUTH_AND_CAPTURE = 'AuthAndCapture';

    /**
     * Realiza a pré-autorização do valor no cartão do cliente.
     * A MundiPagg será responsável por realizar a operação de captura (Capture) para a confirmação da transação.
     * A loja deverá ter uma url configurada na MundiPagg para ser notificada do sucesso ou falha da operação de captura
     */
    const AUTH_AND_CAPTURE_WITH_DELAY = 'AuthAndCaptureWithDelay';
}