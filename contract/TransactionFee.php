<?php

namespace Contract;

interface TransactionFee
{
    public function additionByFee(int $ammount);
    public function deductionByFee(int $ammount);
}
