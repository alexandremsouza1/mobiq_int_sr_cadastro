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

  public function getStatusCnpj($cnpj): string
  {
    $client = $this->getByKey('cnpj', $cnpj);
    return $client->status;
  }

  /**
   * @param $clients
   * @param $sector
   * @param int $agent
   */
  public function persistClients($clients, $sector)
  {
    foreach ($clients as $item) {
      if (isset($item['CNPJ']) && !empty($item['CNPJ'])) {
        $clientData = [
          'clientId' => $item['CLIENTE'],
          'document' => $item['CNPJ'],
          'name' => $item['RAZAO_SOCIAL'],
          'ClientSituation' =>
          [
            'hasNoDebt' => $item['DIVIDA'] == 0 ? 0 : 1,
            'debt' => $item['DIVIDA'],
          ],
          'sector' => $sector,
        ];

        $this->repository->store($clientData, 'clientId');
      }
    }
  }

}
