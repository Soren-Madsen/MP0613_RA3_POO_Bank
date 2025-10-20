<?php namespace ComBank\Transactions;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 11:30 AM
 */

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class DepositTransaction implements BankTransactionInterface
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
        return $account->getBalance() + $this->amount;
    }
    public function getTransactionInfo(): string
    {
        return "Deposit of amount: " . $this->amount;
    }
}
