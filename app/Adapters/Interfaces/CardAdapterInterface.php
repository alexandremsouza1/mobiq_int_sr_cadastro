<?php

namespace App\Adapters\Interfaces;


interface CardAdapterInterface
{
    public function getAdapt($data): array;
    public function adaptCard($data): array;
}