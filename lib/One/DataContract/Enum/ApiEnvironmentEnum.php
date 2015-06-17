<?php

namespace MundiPagg\One\DataContract\Enum;

/**
 * Class ApiEnvironmentEnum
 * @package MundiPagg\One\DataContract\Enum
 */
abstract class ApiEnvironmentEnum
{
    /**
     * Ambiente de produção
     */
    const PRODUCTION = 'production';

    /**
     * Ambiente de homologação
     */
    const STAGING = 'staging';

    /**
     * Ambiente de testes com inspeção
     */
    const INSPECTOR = 'inspector';
}