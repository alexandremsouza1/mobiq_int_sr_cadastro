@if ($consumidor == null)
  Olá, {{ $data['responsible_name'] }}.
  <br /><br />
  @if ($origin == 'register')
      Você se cadastrou no App KOnnect da Sorocaba Refrescos e agora é necessário confirmar o seu cadastro.
  @else
      Você solicitou um PIN para nova senha no App KOnnect da Sorocaba Refrescos e agora é necessário confirmar o PIN abaixo.
  @endif
  <br />
  Copie o código abaixo e cole no campo de confirmação no App.
  <br />
  <br />
  <br />
  <strong>{{ $data['activation_code'] }}</strong>
  <br />
  <br />
  <br />
  <br />
  <small>Mensagem gerada automaticamente, não a responda.</small>
@else

  <!DOCTYPE html>
  <html>
  <head>
      <meta charset="utf-8">
      <title></title>
  </head>
  <body>
  <div style="max-width: 640px; background-color: #F7F7F7; margin: 0 auto; text-align: center; padding: 20px 0 20px;">
      <!-- <div style="max-width: 640px;"> -->
      <img style="width: 100%; max-width: 297px;" src="{{ $endpoint }}/images/logococaEmail.png">

      @if ($origin == 'register')
          <h4 style="color: #525252; font-size: 36px; font-family: SANS-SERIF; font-weight: 500; margin-top: 10px;">Código de Ativação</h4>
      @else
          <h4 style="color: #525252; font-size: 36px; font-family: SANS-SERIF; font-weight: 500; margin-top: 10px;">PIN de Recuperação de Senha</h4>
      @endif


      <hr style="border: 3px solid #d10011; margin-bottom: 40px;">

      <p style="font-family: SANS-SERIF; font-size: 14px;">Olá <b>{{ $data['responsible_name'] }}</b></p>
      @if ($origin == 'register')
          <p style="font-family: SANS-SERIF; font-size: 14px;">Segue o código de ativação de acesso ao app</p>
      @else
          <p style="font-family: SANS-SERIF; font-size: 14px;">Segue o PIN para recuperação de senha no App de ativação de acesso ao app</p>
      @endif

      <div style="max-width: 300px; padding: 20px 30px; background-color: #ffffff; margin: 40px auto 30px;">

          <div style="width: 100%; display: flex; padding: 10px; margin: 0 auto; text-align: center;">
              <div style="width:40px;height:40px;float:left;border:#1c2128 2px solid;font-size:28px; padding:15px 15px;">
                  {{ $data['activation_code'][0] }}
              </div>
              <div style="width:40px;height:40px;float:left;border:#1c2128 2px solid;font-size:28px; padding:15px 15px;">
                  {{ $data['activation_code'][1] }}
              </div>
              <div style="width:40px;height:40px;float:left;border:#1c2128 2px solid;font-size:28px; padding:15px 15px;">
                  {{ $data['activation_code'][2] }}
              </div>
              <div style="width:40px;height:40px;float:left;border:#1c2128 2px solid;font-size:28px; padding:15px 15px;">
                  {{ $data['activation_code'][3] }}
              </div>
          </div>

      </div>

      <img style="width: 100%; max-width: 98px;" src="{{ $endpoint }}/images/LogoSR.png">

      <p style="font-size: 9px; font-weight: 600; color: #707070;">Central de Atendimento Sorocaba Refrescos: Atendimento 24 horas por dia, 7 dias por semana.</p>

  </div>
  </body>
  </html>
@endif
