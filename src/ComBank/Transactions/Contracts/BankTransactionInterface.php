<?php namespace ComBank\Transactions\Contracts;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:29 PM
 */

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\InvalidOverdraftFundsException;

interface BankTransactionInterface 
{
    public function getAmount(): float;
    public function applyTransaction(BankAccountInterface $account): float;
    public function getTransactionInfo(): string;
}
