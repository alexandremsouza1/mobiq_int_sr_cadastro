<?php

namespace App\Adapters\Interfaces;


interface AdapterInterface
{
    public function getAdapt($data): array;
}