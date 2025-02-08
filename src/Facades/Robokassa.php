<?php

namespace Vhar\LaravelRobokassa\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static Vhar\Robokassa\Robokassa merchant(string $merchant)
 * @method static string sendPaymentRequestCurl(array $params)
 * @method static array getPaymentMethods(string $lang)
 * @method static array opState(int $invoiceID)
 * 
 * @see https://github.com/robokassa/sdk-php
 */
class Robokassa extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'robokassa';
    }
}
