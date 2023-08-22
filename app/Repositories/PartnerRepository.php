<?php

namespace App\Repositories;

use App\Models\Partner;

class PartnerRepository extends AbstractRepository
{

    public function __construct(Partner $model)
    {
        $this->model = $model;
    }
}
