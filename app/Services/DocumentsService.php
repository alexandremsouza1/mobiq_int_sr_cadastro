<?php


namespace App\Services;

use App\Repositories\PartnersDocumentsRepository;


class PartnersDocumentsService extends AbstractService
{
  protected $repository;


  public function __construct(PartnersDocumentsRepository $repository)
  {
    $this->repository = $repository;
  }

}