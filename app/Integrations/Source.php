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
    $result = $this->client->post('valida-cpf', [
      'cpf' => $cpf,
      'birth_date' => $birth_date
    ]);
    return $result['data'];
  }

  public function getImportarSetores()
  {
    $result = $this->client->get('consultar-setores');
    return $result['data'];
  }

  public function getImportarClientes($sector)
  {
    $url = 'importar-clientes?setor=' . $sector;
    $result = $this->client->get($url);
    return $result['data'];
  }
}