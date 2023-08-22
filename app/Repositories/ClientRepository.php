<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository extends AbstractRepository
{

    public function __construct(Client $model)
    {
        $this->model = $model;
    }
}
