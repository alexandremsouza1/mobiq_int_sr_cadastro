<?php

use Tests\TestCase;
use App\Adapters\PixItauAdapter;
use App\Integrations\Itau\Service\Factory;

class PixItauAdapterTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }
    /**
     * @dataProvider providerStatus
     */
    public function testGetAdaptPix($status)
    {

        $data = [
            "amount" => "10050",
            "paymentId" => "PCC-0000001223",
            "customer" => array(
                "document" => "22776171000140",
                "firstName" => "Razão Social da Empresa"
            )
        ];

        // Assert the result
        $expectedResult = [
            "_id" => "7dbbc0d1-3eb0-4a74-ba88-0d5f3ffb2a8f",
            "status" => $status,
            "amount" => "10050",
            "paymentId" => "PCC-0000001223",
            "customer" => [
                "document" => "22776171000140",
                "firstName" => "Razão Social da Empresa"
            ],
                "copyAndPaste" => "00020101021226740014br.gov.bcb.pix210812345678220412342308123456782420001122334455 667788995204000053039865406123.455802BR5913FULANO DE TAL6008BRASILIA62190515RP12345678- 201980720014br.gov.bcb.pix2550bx.com.br/spi/U0VHUkVET1RPVEFMTUVOVEVBTEVBVE9SSU8=63 0434D1",
                "qrCode" => "data:image/png;base64,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",
                "expireAt" => "2023-07-19T10:32:29.000000Z"
        ];

        $getNetReturn =  (object) [
            "payment_id" => "7dbbc0d1-3eb0-4a74-ba88-0d5f3ffb2a8f",
            "status" => $status,
            "description" => "QR Code gerado com sucesso e aguardando o pagamento.",
            "additional_data" => (object) [
                "transaction_id" => "100509110c95e-4c2b-4b78-9d01-615a3516b3cc",
                "qr_code" => "00020101021226740014br.gov.bcb.pix210812345678220412342308123456782420001122334455 667788995204000053039865406123.455802BR5913FULANO DE TAL6008BRASILIA62190515RP12345678- 201980720014br.gov.bcb.pix2550bx.com.br/spi/U0VHUkVET1RPVEFMTUVOVEVBTEVBVE9SSU8=63 0434D1",
                "creation_date_qrcode" => "2023-07-19T10:29:29",
                "expiration_date_qrcode" => "2023-07-19T10:32:29",
                "psp_code" => "033"
            ]
        ];

        $factoryMock = Mockery::mock(Factory::class)->makePartial();
        $factoryMock->shouldReceive('build')->andReturn($getNetReturn);
        $factoryMock->setType($factoryMock::$PIX);
        $adapter = new PixItauAdapter($factoryMock);

        // Call the method being tested
        $result = $adapter->getAdapt($data);

        $this->assertEquals($expectedResult, $result);
    }

    public function providerStatus()
    {
        return [
            [
                'WAITING',
            ],
            [
                'APPROVED'
            ],
            [
                'EXPIRED'
            ],
        ];
    }
}
