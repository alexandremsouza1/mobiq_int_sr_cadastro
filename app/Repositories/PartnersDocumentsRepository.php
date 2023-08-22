<?php

namespace App\Repositories;

use App\Models\PartnersDocuments;

class PartnersDocumentsRepository extends AbstractRepository
{

    public function __construct(PartnersDocuments $model)
    {
        $this->model = $model;
    }
}
