<?php


namespace App\Services\Senders\Email;

use App\Models\Client;
use Illuminate\Support\Facades\Mail;

class EmailService
{

  protected $verificationCodeEmail;

  public function __construct(VerificationCodeEmail $verificationCodeEmail)
  {
      $this->verificationCodeEmail = $verificationCodeEmail;
  }

  public function sendCode(Client $client, $verificationCode)
  {
    try{
      Mail::to($client->getEmail())->send(new VerificationCodeEmail($client,$verificationCode));
      return true;
    }catch(\Exception $e){
      return false;
    }
  }


}