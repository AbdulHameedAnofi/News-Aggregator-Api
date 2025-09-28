<?php

namespace App\Contracts;

interface AggregatorInterface
{
    public function fetch(): array;
}
