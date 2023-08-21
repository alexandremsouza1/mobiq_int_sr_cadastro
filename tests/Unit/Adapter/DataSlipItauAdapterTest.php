<?php

use Tests\TestCase;
use App\Adapters\DataSlipItauAdapter;
use App\Integrations\Itau\Generators\BoletoPDF;
use App\Integrations\Itau\Service\Factory;

class DataSlipItauAdapterTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testGetAdaptDataSlip()
    {

        $data = [
            'amount' => 100,
            'paymentId' => 'ABC123',
            'ourNumber' => '123456789',
            'dueDate' => '2023-07-31',
            'instructions' => 'Please pay before due date',
            'tax' => 10.00,
            'customer' => [
                'metadata' => ['externalId' => 'CUST001'],
                'firstName' => 'John',
                'lastName' => 'Doe',
                'email' => 'john.doe@example.com',
                'document' => '123456789',
                'phoneNumber' => '1234567890',
                'billingAddress' => [
                    'city' => 'New York',
                    'addressLine4' => 'Apt 123',
                    'country' => 'United States',
                    'addressLine3' => 'District 1',
                    'addressLine2' => 'Street 123',
                    'postalCode' => '10001',
                    'region' => 'NY',
                    'addressLine1' => 'Main St'
                ]
            ]
          ];

        $itauReturn = json_decode('{
            "codigo_canal_operacao":"BKL",
            "codigo_operador":"889911348",
            "etapa_processo_boleto":"efetivacao",
            "beneficiario":{
               "id_beneficiario":"150000052061",
               "nome_cobranca":"MUNDI EMPRRENDIMENTOS E L ME",
               "tipo_pessoa":{
                  "codigo_tipo_pessoa":"J",
                  "numero_cadastro_nacional_pessoa_juridica":"08867659000151"
               },
               "endereco":{
                  "nome_logradouro":"R PORTUGAL, 13, EDF T NOVO 1 AN",
                  "nome_bairro":"COMERCIO",
                  "nome_cidade":"SALVADOR",
                  "sigla_UF":"BA",
                  "numero_CEP":"40015000"
               }
            },
            "dado_boleto":{
               "descricao_instrumento_cobranca":"boleto",
               "forma_envio":"impressao",
               "tipo_boleto":"a vista",
               "pagador":{
                  "pessoa":{
                     "nome_pessoa":"Nubibat",
                     "tipo_pessoa":{
                        "codigo_tipo_pessoa":"F",
                        "numero_cadastro_pessoa_fisica":"05201005225"
                     }
                  },
                  "endereco":{
                     "nome_logradouro":"Av Hilario Pereira de Souza, 492",
                     "nome_bairro":" ",
                     "nome_cidade":"Osasco",
                     "sigla_UF":"SP",
                     "numero_CEP":"04131020"
                  },
                  "pagador_eletronico_DDA":false,
                  "praca_protesto":true
               },
               "sacador_avalista":{
                  "pessoa":{
                     "nome_pessoa":"Sacador Teste",
                     "nome_fantasia":"Empresa A",
                     "tipo_pessoa":{
                        "codigo_tipo_pessoa":"F",
                        "numero_cadastro_pessoa_fisica":"38365972840"
                     }
                  },
                  "endereco":{
                     "nome_logradouro":"Av do Estado, 55343",
                     "nome_bairro":"Ipiranga",
                     "nome_cidade":"São Paulo",
                     "sigla_UF":"SP",
                     "numero_CEP":"06120100"
                  }
               },
               "codigo_carteira":"157",
               "codigo_tipo_vencimento":3,
               "valor_total_titulo":"00000000000010001",
               "dados_individuais_boleto":[
                  {
                     "id_boleto_individual":"8835353e-ecb5-43f8-adeb-4cbf796f6be4",
                     "numero_nosso_numero":"00001056",
                     "dac_titulo":"8",
                     "data_vencimento":"2021-06-01",
                     "valor_titulo":"00000000000010001",
                     "codigo_barras":"34192863800000100011570000105681500052061000",
                     "numero_linha_digitavel":"34191570070010568150600520610007286380000010001",
                     "data_limite_pagamento":"2031-06-01",
                     "lista_mensagens_cobranca":[
                        
                     ]
                  }
               ],
               "codigo_especie":"01",
               "data_emissao":"2021-05-25",
               "pagamento_parcial":false,
               "quantidade_maximo_parcial":"0",
               "lista_mensagem_cobranca":[
                  {
                     "mensagem":"jaime3 desconto fixo percentual"
                  },
                  {
                     "mensagem":"teste2"
                  }
               ],
               "recebimento_divergente":{
                  "codigo_tipo_autorizacao":"03",
                  "codigo_tipo_recebimento":"P",
                  "percentual_minimo":"00000000000000000",
                  "percentual_maximo":"00000000000000000"
               },
               "desconto_expresso":true
            }
         }');

        $factoryMock = Mockery::mock(Factory::class)->makePartial();
        $boletoPdf = $this->getMockBuilder(BoletoPDF::class)
        ->setConstructorArgs([])
        ->onlyMethods(['streamOpenBoletoPdf'])
        ->getMock();

        $factoryMock->shouldReceive('build')->andReturn($itauReturn);
        $factoryMock->boot($factoryMock::$BOLETO);
        $adapter = new DataSlipItauAdapter($factoryMock,$boletoPdf);

        // Call the method being tested
        $result = $adapter->getAdapt($data);

        //assert no exception
        $this->assertIsArray($result);
    }


}
