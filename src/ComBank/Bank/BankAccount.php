<?php namespace ComBank\Bank;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:25 PM
 */

use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\InvalidArgsException;
use ComBank\Exceptions\ZeroAmountException;
use ComBank\OverdraftStrategy\NoOverdraft;
use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use ComBank\Support\Traits\AmountValidationTrait;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class BankAccount
{
    private $balance;
    private $status;
    
    function __construct(float $initialBalance = 400.0)
    {
        $this->balance = $initialBalance;
        $this->status = 'OPEN';
    }
    public function getBalance(): float
    {
        return $this->balance;
    }
    public function reopenAccount(): string
    {
        return $this->status = 'OPEN';
    }
    public function closeAccount(): string
    {
        return $this->status = 'CLOSED';
    }

}
