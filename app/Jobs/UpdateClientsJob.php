<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateClientsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

        $serviceManager = $this->getServiceManager();
        /** @var Source $sourceWsdl */
        $sourceWsdl = $serviceManager->get(Source::class);
        /** @var ClientSectorTableGateway $clientSectorTableGateway */
        $clientSectorTableGateway = $serviceManager->get(ClientSectorTableGateway::class);
        /** @var ClientService $clientService */
        $clientService = $serviceManager->get(ClientService::class);
        $totalClientes = 0;

        try {
            $buscandoSetores = '1) buscando setores ... ';
            $output .= $buscandoSetores;
            echo $buscandoSetores;

            $dataSetores = $sourceWsdl->getImportarSetores();

            $buscandoSetoresResult = 'ok. ' . count($dataSetores) . ' setores obtidos' . PHP_EOL;
            $output .= $buscandoSetoresResult;
            echo $buscandoSetoresResult;

            $gravandoSetores = '2) gravando setores ... ';
            $output .= $gravandoSetores;
            echo $gravandoSetores;

            $atualizaSetores = $clientSectorTableGateway->persistSectors($dataSetores);

            $gravandoSetoresResult = 'ok' . PHP_EOL;
            $output .= $gravandoSetoresResult;
            echo $gravandoSetoresResult;

            $iteracaoSetores = '3) obtendo clientes dos setores.' . PHP_EOL;
            $output .= $iteracaoSetores;
            echo $iteracaoSetores;

            foreach ($atualizaSetores as $setor) {
                $buscandoClientesSetor = ' - buscando clientes do setor ' . $setor . ' ... ';
                $output .= $buscandoClientesSetor;
                echo $buscandoClientesSetor;

                $dataClientes = $sourceWsdl->getImportarClientes($setor);

                $buscandoClientesSetorResult = 'ok. ' . count($dataClientes) . ' localizados. Persistindo clientes na base de dados ... ';
                $output .= $buscandoClientesSetorResult;
                echo $buscandoClientesSetorResult;

                $clientService->persistClients($dataClientes, $setor);

                $buscandoClientesSetorFim = 'ok' . PHP_EOL;
                $output .= $buscandoClientesSetorFim;
                echo $buscandoClientesSetorFim;

                $totalClientes += count($dataClientes);
            }
        } catch (Exception $exception) {
            $excessao = PHP_EOL . PHP_EOL . '----------------------------------------------' . PHP_EOL . PHP_EOL;
            $excessao .= PHP_EOL . PHP_EOL . 'Excessão na execução: ' . $exception->getMessage() . PHP_EOL . PHP_EOL;
            $excessao .= PHP_EOL . PHP_EOL . '----------------------------------------------' . PHP_EOL . PHP_EOL;

            $output .= $excessao;
            echo $excessao;
        }

        $fimProcesso = PHP_EOL . PHP_EOL . 'Processo finalizado. Um total de ' . $totalClientes . ' clientes foram atualizados/cadastrados' . PHP_EOL . PHP_EOL;
        $output .= $fimProcesso;
        echo $fimProcesso;

        /** @var Adapter $dbAdapter */
        $dbAdapter = $serviceManager->get(Adapter::class);
        $dbAdapter->query("INSERT INTO cron_logs (cron_name, result, created) VALUES (?,?,?)")
            ->execute(['atualiza-clientes', $output, date('Y-m-d H:i:s')]);

        return true;
    }
}
