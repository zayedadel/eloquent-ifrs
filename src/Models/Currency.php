<?php
/**
 * Eloquent IFRS Accounting
 *
 * @author Edward Mungai
 * @copyright Edward Mungai, 2020, Germany
 * @license MIT
 */
namespace Ekmungai\IFRS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Ekmungai\IFRS\Interfaces\Recyclable;

use Ekmungai\IFRS\Traits\Recycling;

/**
 * Class Currency
 *
 * @package Ekmungai\Eloquent-IFRS
 *
 * @property string $currency_code
 * @property string $name
 * @property Carbon $destroyed_at
 * @property Carbon $deleted_at
 */
class Currency extends Model implements Recyclable
{
    use SoftDeletes;
    use Recycling;

    /**
     * Construct new Currency.
     *
     * @param string $name
     * @param string $currencyCode
     *
     * @return Currency
     */
    public static function new(string $name, string $currencyCode) : Currency
    {
        $currency = new Currency();

        $currency->name = $name;
        $currency->currency_code = $currencyCode;

        return $currency;
    }

    /**
     * Currency Exchange Rates.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exchangeRates()
    {
        return $this->hasMany(ExchangeRate::class);
    }

    /**
     * Currency attributes.
     *
     * @return object
     */
    public function attributes()
    {
        return (object) $this->attributes;
    }
}
