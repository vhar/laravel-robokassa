<?php

namespace Vhar\LaravelRobokassa\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static Vhar\Robokassa\Robokassa merchant(string $merchant)
 * @method static string createPaymentLink(Vhar\Robokassa\Common\Invoice $invoice)
 * @method static Vhar\Robokassa\Responses\CreatedInvoice|Vhar\Robokassa\Responses\IsSuccess createInvoice(Vhar\Robokassa\Common\InvoiceJWT $invoice)
 * @method static Vhar\Robokassa\Responses\OperationStateResponse|null deactivateInvoice(int $invoiceID)
 * @method static Vhar\Robokassa\Responses\CurrenciesList|null getCurrencies(string $lang = 'ru')
 * @method static Vhar\Robokassa\Responses\PaymentMethodsList|null getPaymentMethods(string $lang = 'ru')
 * @method static bool checkResult(array $params)
 * @method static bool checkSuccess(array $params)
 * 
 * @see https://github.com/vhar/robokassa
 */
class Robokassa extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'robokassa';
    }
}
