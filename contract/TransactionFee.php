<?php

namespace Contract;

interface TransactionFee
{
    public function deductionByFee(int $ammount);
}
