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
          'situation' => $item['DIVIDA'],
          'sector' => $sector,
          'status' => 'dbClient',
        ];

        $this->create($clientData); 
      }
    }
  }

  public function create($clientData)
  {
    $client = $this->repository->store($clientData, 'clientId');
    if(isset($clientData['situation'])){
      $clientSituation = $clientData['situation'];
        $client->clientSituation()->updateOrCreate(
          ['client_id' => $client->id],
          [
            'has_no_debt' => $clientSituation == 0 ? 0 : 1,
            'debt' => $clientSituation,
          ]
        );
    }
  }

}