<?php

namespace Contract;

interface TransactionFee
{
    public function deductionByFee();

    public function additionByFee();
}
