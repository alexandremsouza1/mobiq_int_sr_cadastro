<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use App\Services\CompanyService;
use App\Services\LogisticService;
use App\Services\PartnersDocumentsService;
use App\Services\PartnerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends DefaultApiController
{
    protected $clientService;

    protected $partnerService;

    protected $companyService;

    protected $logisticService;

    protected $documentsService;


    public function __construct(
        ClientService $clientService, 
        PartnerService $partnerService, 
        CompanyService $companyService, 
        LogisticService $logisticService, 
        PartnersDocumentsService $documentsService)
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

        $statusCode = 200;

        $messageText = 'Cnpj status successfully obtained';

        return response()->json(['data' => $client,'message' => $messageText, 'status' => true], $statusCode);
    }
 




}