<?php

interface TransactionFee
{
    public function calculateDeduction(int $amount);
}
