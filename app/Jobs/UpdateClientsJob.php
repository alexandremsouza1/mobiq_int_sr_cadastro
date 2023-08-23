<?php

namespace App\Jobs;

use App\Integrations\Source;
use App\Services\ClientService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateClientsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $sourceWsdl;

    private $clientService;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Source $sourceWsdl, ClientService $clientService)
    {
        $this->sourceWsdl = $sourceWsdl;
        $this->clientService = $clientService;
    }
 

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $welcomeMessage = PHP_EOL . PHP_EOL . 'Atualizacao de clientes' . PHP_EOL . PHP_EOL;
        $output = $welcomeMessage;

        echo $welcomeMessage;


        $totalClientes = 0;

        try {
            $buscandoSetores = '1) buscando setores ... ';
            $output .= $buscandoSetores;
            echo $buscandoSetores;

            $dataSetores = $this->sourceWsdl->getImportarSetores();

            $buscandoSetoresResult = 'ok. ' . count($dataSetores) . ' setores obtidos' . PHP_EOL;
            $output .= $buscandoSetoresResult;
            echo $buscandoSetoresResult;

            $gravandoSetores = '2) gravando setores ... ';
            $output .= $gravandoSetores;
            echo $gravandoSetores;

            //$atualizaSetores = $clientSectorTableGateway->persistSectors($dataSetores);

            $gravandoSetoresResult = 'ok' . PHP_EOL;
            $output .= $gravandoSetoresResult;
            echo $gravandoSetoresResult;

            $iteracaoSetores = '3) obtendo clientes dos setores.' . PHP_EOL;
            $output .= $iteracaoSetores;
            echo $iteracaoSetores;

            foreach ($dataSetores as $setor) {
                $setor = $setor['Setor'];
                $buscandoClientesSetor = ' - buscando clientes do setor ' . $setor . ' ... ';
                $output .= $buscandoClientesSetor;
                echo $buscandoClientesSetor;

                $dataClientes = $this->sourceWsdl->getImportarClientes($setor);

                $buscandoClientesSetorResult = 'ok. ' . count($dataClientes) . ' localizados. Persistindo clientes na base de dados ... ';
                $output .= $buscandoClientesSetorResult;
                echo $buscandoClientesSetorResult;

                $this->clientService->persistClients($dataClientes, $setor);

                $buscandoClientesSetorFim = 'ok' . PHP_EOL;
                $output .= $buscandoClientesSetorFim;
                echo $buscandoClientesSetorFim;

                $totalClientes += count($dataClientes);
            }
        } catch (\Exception $exception) {
            $excessao = PHP_EOL . PHP_EOL . '----------------------------------------------' . PHP_EOL . PHP_EOL;
            $excessao .= PHP_EOL . PHP_EOL . 'Excessão na execução: ' . $exception->getMessage() . PHP_EOL . PHP_EOL;
            $excessao .= PHP_EOL . PHP_EOL . '----------------------------------------------' . PHP_EOL . PHP_EOL;

            $output .= $excessao;
            echo $excessao;
        }

        $fimProcesso = PHP_EOL . PHP_EOL . 'Processo finalizado. Um total de ' . $totalClientes . ' clientes foram atualizados/cadastrados' . PHP_EOL . PHP_EOL;
        $output .= $fimProcesso;
        echo $fimProcesso;
        return true;
    }
}
