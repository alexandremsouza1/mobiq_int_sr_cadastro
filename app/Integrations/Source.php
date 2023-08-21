<?php

namespace App\Integrations;


class Source
{
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
}