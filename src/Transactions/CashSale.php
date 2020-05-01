<?php
/**
 * Eloquent IFRS Accounting
 *
 * @author Edward Mungai
 * @copyright Edward Mungai, 2020, Germany
 * @license MIT
 */
namespace Ekmungai\IFRS\Transactions;

use Ekmungai\IFRS\Interfaces\Sells;
use Ekmungai\IFRS\Interfaces\Fetchable;

use Ekmungai\IFRS\Traits\Selling;
use Ekmungai\IFRS\Traits\Fetching;

use Ekmungai\IFRS\Models\Transaction;
use Ekmungai\IFRS\Models\Account;

use Ekmungai\IFRS\Exceptions\MainAccount;

class CashSale extends Transaction implements Sells, Fetchable
{
    use Selling;
    use Fetching;

    /**
     * Transaction Number prefix
     *
     * @var string
     */

    const PREFIX = Transaction::CS;

    /**
     * Construct new CashSale
     *
     * @param array $attributes
     *
     */
    public function __construct($attributes = []) {

        $attributes['credited'] = false;
        $attributes['transaction_type'] = self::PREFIX;

        parent::__construct($attributes);
    }

    /**
     * Validate CashSale Main Account
     */
    public function save(): void
    {
        if (is_null($this->getAccount()) or $this->getAccount()->account_type != Account::BANK) {
            throw new MainAccount(self::PREFIX, Account::BANK);
        }

        parent::save();
    }
}
