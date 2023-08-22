<?php

namespace App\Integrations;


class Source
{

  private $client;


  public function __construct(Client $client)
  {
    $this->client = $client;
  }

  public function getValidaCPF($cpf, $birth_date)
  {
    return $this->client->post('valida-cpf', [
      'cpf' => $cpf,
      'birth_date' => $birth_date
    ]);
  }

  public function getImportarSetores()
  {
    return $this->client->get('consultar-setores');
  }

  public function getImportarClientes($sector)
  {
    return $this->client->get('importar-clientes', [
      'setor' => $sector
    ]);
  }
}