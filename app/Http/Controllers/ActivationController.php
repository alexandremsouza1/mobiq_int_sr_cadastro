<?php

namespace App\Http\Controllers;

use App\Trait\DateTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActivationController extends DefaultApiController
{
    use DateTrait;

    
    protected $service;


    public function __construct(ActivationService $service)
    {
        $this->service = $service;
    }


    public function sendCode(Request $request)
    {
        $document = $request->input('cnpj');

        $choice = $request->input('choice');

        $code = $this->service->sendCode($document, $choice);

        $data = [
            'code' => $code
        ];

        $statusCode = 200;

        $messageText = 'Code successfully sent';

        return response()->json(['data' => $data, 'message' => $messageText, 'status' => true], $statusCode);
    }


    public function checkCode(Request $request)
    {
        $document = $request->input('cnpj');

        $code = $this->service->checkCode($document);

        $data = [
            'code' => $code
        ];

        $statusCode = 200;

        $messageText = 'Code successfully checked';

        return response()->json(['data' => $data, 'message' => $messageText, 'status' => true], $statusCode);
    }

    public function checkCpf(Request $request)
    {
        $data = $request->all();

        $cpf                 = $data['cpfPartner'];
        $date_birth_partner     = $this->treat_birth($data['dateBirthPartner']);

        $validCPF = $this->service->getValidaCPF($cpf, $date_birth_partner);

        $data = [
            'validaCPF' => $validCPF
        ];

        $statusCode = 200;

        $messageText = 'Code successfully sent';

        return response()->json(['data' => $data, 'message' => $messageText, 'status' => true], $statusCode);
    }
}
