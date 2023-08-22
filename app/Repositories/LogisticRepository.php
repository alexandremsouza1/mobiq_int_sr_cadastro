<?php

namespace App\Repositories;

use App\Models\Logistic;

class LogisticRepository extends AbstractRepository
{

    public function __construct(Logistic $model)
    {
        $this->model = $model;
    }
}
