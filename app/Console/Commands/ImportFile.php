<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Content;

class ImportFile extends Command
{
    protected $contentModel;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:xml 
        {filePath : Caminho do arquivo XML}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Content $contentModel)
    {
        parent::__construct();
        $this->contentModel = $contentModel;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filePath = $this->argument('filePath');

        if(is_file($filePath)){
            if(substr($filePath, -3)){
                $xml = simplexml_load_file($filePath);
                $registers = $this->contentModel->xmlInsert($xml);

                echo 'Fora(m) adcionado(s) "' .$registers. '" registro(s)' . PHP_EOL;
            }
            else{
                echo 'Extensão inválida. O arquivo deve ser um XML' . PHP_EOL;
            }
        }
        else{
            echo 'Arquivo "' .$filePath. '" não encontrado' . PHP_EOL;
        }
    }
}
