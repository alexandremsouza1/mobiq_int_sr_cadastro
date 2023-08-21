<?php


namespace App\Services\Senders\Email;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationCodeEmail
{

  use Queueable, SerializesModels;

  public $verificationCode;

  public $info;

  public function __construct(Client $info,string $verificationCode)
  {
    $this->info = $info;
    $this->verificationCode = $verificationCode; 
  }

  public function build()
  {
    $title = env('CLIENT_NAME').' : '.'Código de Verificação';
    return $this->view('emails.verification_code')
       ->with([
         'info' => $this->info,
       ])
      ->subject($title);
  }
}
