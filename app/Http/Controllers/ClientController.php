<?php

namespace App\Http\Controllers;



use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends DefaultApiController
{
    protected $clientService;

    protected $partnerService;

    protected $companyService;

    protected $logisticService;

    protected $documentsService;


    public function __construct(ClientService $clientService, PartnerService $partnerService, CompanyService $companyService, LogisticService $logisticService, DocumentsService $documentsService)
    {
        $this->clientService = $clientService;
        $this->partnerService = $partnerService;
        $this->companyService = $companyService;
        $this->logisticService = $logisticService;
        $this->documentsService = $documentsService;
    }


    public function statusRegistration(Request $request)
    {
        $cnpj = $request->input('cnpj');

        $client = $this->clientService->getStatusCnpj($cnpj);

        $data = [
            'status' => $client->status,
            'message' => $client->message
        ];

        $statusCode = 200;

        $messageText = 'Cnpj status successfully obtained';

        return response()->json(['data' => $data,'message' => $messageText, 'status' => true], $statusCode);
    }
 




}