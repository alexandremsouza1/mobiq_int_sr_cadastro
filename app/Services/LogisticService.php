<?php


namespace App\Services;

use App\Repositories\LogisticRepository;


class LogisticService extends AbstractService
{
  protected $repository;


  public function __construct(LogisticRepository $repository)
  {
    $this->repository = $repository;
  }

}