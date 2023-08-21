<?php


namespace App\Services;

class ActivationService extends AbstractService
{

  protected $smsService;

  protected $emailService;

  protected $repository;

  protected $source;

  public function __construct(
    SmsService $smsService, 
    EmailService $emailService, 
    ClientRepository $repository,
    Source $source
    )
  {
    $this->smsService = $smsService;
    $this->emailService = $emailService;
    $this->repository = $repository;
  }


  public function sendCode($document, $choice)
  {
    $result =  false;
    $code = $this->generateCode();

    switch ($choice) {
      case 'email':
        $result = $this->sendCodeToEmail($document, $code);
        break;
      case 'sms':
        $result = $this->sendCodeToSms($document, $code);
        break;
      default:
        $result = $this->sendCodeToEmail($document, $code);
        break;
    }
    return $result;
  }

  private function generateCode(): string
  {
    return str_pad(rand(0000, 9999), 4, '0', STR_PAD_LEFT);
  }

  private function sendCodeToEmail($document, $code)
  {
    $client = $this->repository->getByKey('cnpj', $document);
    return $this->emailService->sendCode($client, $code);
  }

  private function sendCodeToSms($document, $code)
  {
    $client = $this->repository->getByKey('cnpj', $document);
    return $this->smsService->sendCode($client, $code);
  }


  public function checkCode($document)
  {
    $client = $this->repository->getByKey('cnpj', $document);

    $status = false;
    $message = 'could not activate your account';
    $errorInfo = 'Não foi possível ativar sua conta. Código de ativação inválido.';

    $activedBD = '1';
    $msg = 'activation complete';


    if (isset($data['status']) && $data['status'] == 'sem_registros') {
      $activedBD = '2';
      $msg = 'activation complete, in analysis';
    }

    if ($client && isset($data['status']) && $data['status'] == 'parcial_sms_ativo') {
      $activedBD = '1';
      $msg = 'activation complete';
      $dados = [
        'responsible_email'     => $client->getResponsibleEmail(),
        'responsible_password'  => $client->getResponsiblePassword()
      ];
    }

    if (isset($data['status']) &&  $data['status'] == 'parcial_quiz') {
      $activedBD = '5';
      $msg = 'activation complete, in quiz';
    }

    if (!$client && isset($data['status']) &&  $data['status'] == 'parcial_sms') {
      $activedBD = '2';
      $msg = 'activation complete, in analysis';
    }

    if ($client && isset($data['status']) && $data['status'] == 'cancelado') {
      $activedBD = '1';
      $msg = 'activation complete';
      $dados = [
        'responsible_email'     => $client->getResponsibleEmail(),
        'responsible_password'  => $client->getResponsiblePassword()
      ];
    }

    if (
      isset($data['status']) && $data['status'] == 'sem_registros' &&
      isset($data['app']) && $data['app'] == 'consumidor'
    ) {
      $activedBD = '1';
      $msg = 'activation complete';
      $dados = [
        'responsible_email'     => $client->getResponsibleEmail(),
        'responsible_password'  => $client->getResponsiblePassword()
      ];
    }

    if ($data['activation_code'] == "9999" && $config['env'] == 'dev') {
      $activedBD = 1;
    }

    $this->repository->update($client->getId(), ['activation_code' => $data['activation_code']]);
  }

  public function getValidaCPF($cpf, $birth_date)
  {
    return $this->source->getValidaCPF($cpf, $birth_date);
  }
}
