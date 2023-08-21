<?php


namespace App\Services\Senders\Sms;

use App\Models\Client;
use Illuminate\Support\Facades\Http;

class SmsService
{
  const STATUS_CODE_SUCCESS = '00';
  const STATUS_CODE_UNKNOWN_ERROR = '10';

  protected $config;

  protected $http;

  public function __construct(Http $http)
  {
    $this->config = config('sms');
    $this->http = $http;
  }

  public function sendCode(Client $client, string $verificationCode)
  {
    $number = $client->getPhone();
    $message = 'Seu código de verificação é: ' . $verificationCode;
    $number = str_replace(['-', ' ', '(', ')', 'x', 'X'], '', $number);

    $headers = [
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
      'Authorization' => 'Basic ' . $this->config['api']['authorization']
    ];

    $numberLenght = strlen($number);
    if ($numberLenght == 10 || $numberLenght == 11) {
      $number = '55' . $number;
    }

    $payload = [
      'sendSmsRequest' => [
        'from' => $this->config['from'],
        'to' => $number,
        'msg' => $message,
        'callbackOption' => 'NONE',
        'id' => uniqid()
      ]
    ];

    try {
      $response = $this->http::post($this->config['api']['url'], [
        'headers' => $headers,
        'json' => $payload
      ]);

      $response = $response->getBody();

      $response = json_decode($response, true);
      if (json_last_error() === JSON_ERROR_NONE) {
        if ($response['sendSmsResponse']['statusCode'] == self::STATUS_CODE_SUCCESS) {
          //salvar log
          return true;
        } else {
          //salvar log 
        }
      }
      //salvar log 
      return false;
    } catch (Exception $exception) {
      //salvar log 
      throw $exception;
    }
  }
}
