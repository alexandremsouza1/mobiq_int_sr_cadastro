<?php


namespace App\Services;

use App\Repositories\ClientRepository;


class ClientService extends AbstractService
{
  protected $repository;


  public function __construct(ClientRepository $repository)
  {
    $this->repository = $repository;
  }

  public function getStatusCnpj($cnpj) : string
  {
    $client = $this->getByKey('cnpj', $cnpj);
    return $client->status;
  }
}
