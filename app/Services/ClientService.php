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

  public function getStatusCnpj($cnpj)
  {
    $document = (string)preg_replace("/\D/", '', $cnpj);

    //byPass if env dev
    if (env('APP_ENV') == 'dev') {
      return [
        'status' => 'ativo',
        'message' => 'Você já possui cadastro ativo!',
        'data' => [
          'company_social_name' => 'Empresa Teste'
        ]
      ];
    }

    $status = 'sem_registros';
    $message = 'Seguir para CADASTRO!';
    $data = [];
    //0 - Ativação SMS Pendente | 1- Ativo | 2 - Cadastro em Análise | 3 - Cadastro Bloqueado | 4 - Cadastro Cancelado | 5 - Cadastro na etapa do Quiz | 6 - Cadastro dentro do prazo para reanalise | 7 - Cadastro na Etapa de Envio de Documento

    $client = $this->getByKey('cnpj', $document);

    switch ($client->getActivated()) {
      case 'registerInactive':
        # code...
        break;
      case 'registerAnalise':
        # code...
        break;
      case 'registerBlocked':
        # code...
        break;
      case 'registerCanceled':
        # code...
        break;
      case 'registerQuiz':
        # code...
        break;
      case 'registerApprovals':
        # code...
        break;
      case 'registerUploads':
        # code...
        break;
      case 'registerStepTwo':
        # code...
        break;
      case 'notAddress':
        # code...
        break;
      case 'registerPartial':
        # code...
        break;
      default:
        # code...
        break;
    }

    if (!$client) {
      $status = 'cadastro_parcial';
      $message = 'Seguir para PRÉ-CADASTRO, passo seguinte!';
      $data = $this->repository->getClient($document);
    }

    if ($client && !$register) {
      $status = 'cliente_base';
      $message = 'Seguir para CADASTRO!';
      $data = [
        'company_social_name' => $client->getName()
      ];
    }

    if (!$client && !$register) {
      $status = 'sem_registros';
      $message = 'Seguir para CADASTRO!';
    }

    if (!$client && $registerInactive) {
      $status = 'parcial_sms_ativo';
      $message = 'Seguir para ATIVAÇÂO SMS!';
    }

    if ($client && $registerInactive) {
      $status = 'parcial_sms_ativo';
      $message = 'Seguir para ATIVAÇÂO SMS!';
      $data = [
        'company_social_name' => $client->getName()
      ];
    }

    if ($registerAnalise) {
      $status = 'analise';
      $message = 'Cadastro sendo Analisado!';
    }

    if ($registerBlocked) {
      $status = 'bloqueado';
      $message = 'Cadastro NEGADO!';
    }

    if ($register && $client) {
      $status = 'ativo';
      $message = 'Você já possui cadastro no aplicativo. Caso não se recorde do seu login ou senha utilize as opções Esqueci minha senha ou Whatsapp!';
      $data = [
        'company_social_name' => $client->getName()
      ];
    }

    if ($registerCanceled) {
      $status = 'cancelado';
      $message = 'Cadastro Cancelado!';
      $data = [
        'company_social_name' => $client->getName()
      ];
    }



    return $this->formatReturnData($data, $status, $message);
  }
}
