<?php namespace ComBank\Transactions;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 1:22 PM
 */

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class WithdrawTransaction implements BankTransactionInterface
{
  private $amount;


    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
    public function applyTransaction(BankAccountInterface $account): float
    {
        return $account->getBalance() - $this->amount;
    }
    public function getTransactionInfo(): string
    {
        return "Withdrawal of amount: " . $this->amount;
    }
   
}
