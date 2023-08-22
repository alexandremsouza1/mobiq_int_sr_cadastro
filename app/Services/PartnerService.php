<?php


namespace App\Services;

use App\Repositories\PartnerRepository;


class PartnerService extends AbstractService
{
  protected $repository;


  public function __construct(PartnerRepository $repository)
  {
    $this->repository = $repository;
  }

}