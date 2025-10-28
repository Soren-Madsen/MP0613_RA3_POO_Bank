<?php

namespace ComBank\Bank;

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
use ComBank\OverdraftStrategy\SilverOverdraft;
use ComBank\Support\Traits\AmountValidationTrait;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class BankAccount implements BankAccountInterface
{
    private $balance;
    private $status;
    private $overdraft;

    public function __construct(float $initialBalance = 0.0)
    {
        $this->balance = $initialBalance;
        $this->status = BankAccountInterface::STATUS_OPEN;
        $this->overdraft = new NoOverdraft();
    }
    public function isOpen(): bool
    {
        return $this->status === BankAccountInterface::STATUS_OPEN;
    }
    
    public function getOverdraft(): OverdraftInterface
    {
        return $this->overdraft;
    }
    public function getBalance(): float
    {
        return $this->balance;
    }
    public function setBalance($newBalance): void
    {
        $this->balance = $newBalance;
    }
    public function reopenAccount()
    {
        if ($this->isOpen()) {
            throw new BankAccountException('Account is already open.');
        }
        $this->status = BankAccountInterface::STATUS_OPEN;
    }
    public function closeAccount()
    {
        $this->status = BankAccountInterface::STATUS_CLOSED;
    }
    public function transaction(BankTransactionInterface $transaction): void
    {
        if (! $this->isOpen()) {
            throw new BankAccountException('Account is now closed.');
        }
        try {
            $newBalance = $transaction->applyTransaction($this);
            $this->setBalance($newBalance);
        } catch (ZeroAmountException $e) {
            throw new FailedTransactionException($e->getMessage());
        } catch (InvalidOverdraftFundsException $e) {
            throw new FailedTransactionException($e->getMessage());
        }
    }
    public function applyOverdraft(OverdraftInterface $overdraft): void
    {
         if (! $this->isOpen()) {
        } 
        $this->overdraft = $overdraft;
    }
}
