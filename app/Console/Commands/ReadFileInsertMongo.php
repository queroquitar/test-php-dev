<?php

namespace App\Console\Commands;

use App\Debt;
use Illuminate\Console\Command;

class ReadFileInsertMongo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mongo:import {file}';


    /**
     * Tipos de extensão permitidas.
     *
     * @var string
     */
    protected $extensions = ['csv'];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Realiza a importação de dados através de caminho para um arquivo.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filePath = $this->useUtf8Encoding($this->argument('file'));

        if (!$this->verifyExtensionFile($filePath)) {
            $this->error('No momento somente estamos implementando csv, iremos aceitar mais tipos de arquivo em breve!');
        }

        $this->importData($filePath);

        $this->info('Importação concluida!');

    }

    /**
     * Serve para garantir que o caminho do arquivo será lido em utf8.
     * @param $argument
     * @return string
     */
    protected function useUtf8Encoding($argument)
    {
        return iconv(mb_detect_encoding($argument, mb_detect_order(), true), "UTF-8", $argument);
    }

    /**
     * Recebe o arquivo e verifica se a extensão dele é valida.
     * @param $filePath
     * @return bool
     */
    protected function verifyExtensionFile($filePath)
    {
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

        if (in_array($fileExtension, $this->extensions)) {
            return true;
        }
        return false;
    }

    /**
     * Recebe o caminho do arquivo e importa os dados dos debitos.
     * @param $filePath
     * @return bool
     */
    protected function importData($filePath)
    {

        $fileData = [];
        $file = fopen($filePath, 'r');
        while (($line = fgetcsv($file)) !== false) {
            $debt = new Debt;
            $debt->name = $line[1];
            $debt->date = $line[2];
            $debt->value = $line[3];
            $debt->phone = $line[4];
            $debt->save();
        }

        fclose($file);

        return true;
    }
}
