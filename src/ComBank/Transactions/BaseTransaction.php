<?php namespace ComBank\Transactions;

use ComBank\Transactions\Contracts\BankTransactionInterface;
use ComBank\Support\Traits\AmountValidationTrait;


abstract class BaseTransaction implements BankTransactionInterface
{
    use AmountValidationTrait;
    protected float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
        $this->validateAmount($amount);
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}
