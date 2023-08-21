<?php

namespace App\Adapters;

use App\Adapters\Interfaces\AdapterInterface;
use App\Integrations\Itau\Generators\BoletoPDF;
use App\Integrations\Itau\Models\DataSlip\Boleto;
use App\Integrations\Itau\Service\Factory;
use Carbon\Carbon;

class DataSlipItauAdapter implements AdapterInterface
{

    protected $factory;

    private $chave;

    private $geradorPdf;

    public function __construct(Factory $factory , BoletoPDF $generatorPdf)
    {
      $this->factory = $factory;
      $this->factory->boot(Factory::$BOLETO);
      $this->chave = config("itau_payments_keys.boleto.chave");
      $this->geradorPdf = $generatorPdf;
    }

    public function getAdapt($data): array
    {
        $dataSlipAdaptIntegration = $this->adaptIntegrationDataSlip($data);
        $resultDataSlipAdaptIntegration = $this->factory->build($dataSlipAdaptIntegration);
        return $this->adaptDataSlip($data,$resultDataSlipAdaptIntegration);
    }

    private function adaptIntegrationDataSlip($data): array
    {
        $object = new \stdClass();

        foreach ($this->getInfo() as $key => $value)
        {
            $object->$key = $value;
        }

        $object->beneficiario = [
           
        ];

        $value = $this->formatPrice($data['amount']);

        $object->dado_boleto = [
           "descricao_instrumento_cobranca"=> "boleto",
           "forma_envio"=> "impressao",
           "codigo_tipo_vencimento"=>3,
           "texto_seu_numero"=> $data['ourNumber'],
           "desconto_expresso"=> false,
           "tipo_boleto"=> "a vista",
           "codigo_carteira"=> "109",
           "valor_total_titulo"=> $value,
           "codigo_especie"=> "01",
           "protesto" => [
              "protesto" => 4,
              "quantidade_dias_protesto"=> ""
           ],
           "pagador" => [
              "pessoa" => [
                 "nome_pessoa"=> $data['customer']['firstName'],
                 "nome_fantasia"=> $data['customer']['firstName'],
                 "tipo_pessoa"=> [
                    "codigo_tipo_pessoa"=> strlen($data['customer']['document']) > 11 ? "J" : "F", // F = pessoa fisica, J = pessoa juridica
                    "numero_cadastro_pessoa_fisica"=> $data['customer']['document']
                 ]
               ],
              "endereco" => [
                 "nome_logradouro"=> $data['customer']['billingAddress']['addressLine1'],
                 "nome_bairro"=> $data['customer']['billingAddress']['addressLine3'],
                 "nome_cidade"=> $data['customer']['billingAddress']['city'],
                 "sigla_UF"=> $data['customer']['billingAddress']['region'],
                 "numero_CEP"=> $data['customer']['billingAddress']['postalCode']
              ]
            ],
           "dados_individuais_boleto" => [
              [
                 "numero_nosso_numero"=> $data['ourNumber'],
                 "data_vencimento"=> $data['dueDate'],
                 "valor_titulo"=> $value,
                 "texto_seu_numero"=> $data['ourNumber']
              ]
           ]
        ];

        return (array) $object;
    }

    private function adaptDataSlip($origin,$data): array
    {
        $data->dado_boleto->customer_id = $origin['customer']['metadata']['externalId'];
        $boletos = $this->extractDataBoleto((array)$data->dado_boleto);

        $links = [];
        foreach ($boletos as $boleto) {
            $links[] = $this->geradorPdf->generatePDF($boleto);
        }

        return [
            '_id' => uniqid(),
            'status' => 'PENDING',
            'amount' => $origin['amount'],
            'paymentId' => $origin['paymentId'],
            'barcode' => $boleto->bar_code,
            'dueDate'=>  $origin['dueDate'], 
            'dueDate_formatted'=> '', 
            'installment' => 1,
            'instructions' =>  $data->dado_boleto->lista_mensagem_cobranca,
            'link' =>  $links,
            'document' =>  $origin['customer']['document'],
            'ourNumber' =>  $origin['ourNumber'],
            'tax' =>  $origin['tax'],
        ];
    }

    private function getInfo()
    {
        return [
            'codigo_canal_operacao' => "API",
            'beneficiario' => "simulacao",
            'dado_boleto' => '',
            'dados_qrcode' => '' ,
        ];
    }

    private function extractDataBoleto(array $data): array
    {
        $boletos = []; 

        $pagador = $data['pagador'];

        foreach ($data['dados_individuais_boleto'] as $item) {

            $boletoData = [
                'id' => $item->id_boleto_individual,
                'our_number' => $item->numero_nosso_numero,
                'document_number' => $pagador->pessoa->tipo_pessoa->numero_cadastro_pessoa_fisica,
                'expiration_date' => $item->data_vencimento,
                'instructions' => $data['lista_mensagem_cobranca'],
                'provider' => 'itau',
                'bar_code' => $item->codigo_barras,
                'value' => $data['valor_total_titulo'],
                'customer' => [
                    'customer_id' => $data['customer_id'],
                    'first_name'=> $pagador->pessoa->nome_pessoa,
                    'last_name'=> '',
                    'name'=> '',
                    'email'=> '',
                    'document_type'=> $pagador->pessoa->tipo_pessoa->codigo_tipo_pessoa,
                    'document_number'=> $pagador->pessoa->tipo_pessoa->numero_cadastro_pessoa_fisica,
                    'phone_number'=> '',
                    'billing_address' => [
                        'street' => $pagador->endereco->nome_logradouro,
                        'number' => '',
                        'district' => $pagador->endereco->nome_bairro,
                        'city' => $pagador->endereco->nome_cidade,
                        'state' => $pagador->endereco->sigla_UF,
                        'postal_code' => $pagador->endereco->numero_CEP,
                        'complement' => '',
                        'country'=> 'BR',
                    ]
                ]
            ];


            $boleto = new Boleto($boletoData);

   
            $boletos[] = $boleto;
        }

        return $boletos; 
    }

    private function formatPrice(int $price)
    {
        //Valor total a ser cobrado. Sendo 15 dígitos inteiros e 2 casas decimais
        return str_pad($price, 17, '0', STR_PAD_LEFT);
    }
}