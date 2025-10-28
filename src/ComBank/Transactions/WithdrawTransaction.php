<?php namespace ComBank\Transactions;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 1:22 PM
 */

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\Exceptions\ZeroAmountException;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class WithdrawTransaction extends BaseTransaction implements BankTransactionInterface 
{
    public function __construct(float $amount)
    {
        parent::__construct($amount);
    }

    public function applyTransaction(BankAccountInterface $account): float
    {
        $newBalance = $account->getBalance() - $this->getAmount();
        if ($newBalance < 0.0) {
            $overdraftFunds = $account->getOverdraft()->getOverdraftFundsAmount();

            if ($overdraftFunds <= 0.0) {
                throw new InvalidOverdraftFundsException('Insufficient balance to complete the withdrawal.');
            }

            if ($newBalance < -$overdraftFunds) {
                throw new InvalidOverdraftFundsException('Withdrawal exceeds overdraft limit.');
            }
        }
        return $newBalance;
    }
    public function getTransactionInfo(): string
    {
    return 'WITHDRAW_TRANSACTION';
    }
   
}
