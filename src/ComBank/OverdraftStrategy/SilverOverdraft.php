<?php

namespace ComBank\OverdraftStrategy;

use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 1:39 PM
 */

class SilverOverdraft implements OverdraftInterface
{

    public function isGrantOverdraftFunds(float $newAmount): bool
    {
        return $newAmount >= -100.0;
    }
    public function getOverdraftFundsAmount(): float
    {
        return 100.0;
    }
}
