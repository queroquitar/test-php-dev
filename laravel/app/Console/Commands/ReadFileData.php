<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ReadFileData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'read-file-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Le arquivo é insere dados em base mongodb';

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
        $this->info("Read File public/test.csv");
        $datacsv = Storage::get('public/test.csv');
        $data = [];
        foreach(explode("\r\n",$datacsv) as $line){
            $cvs = str_getcsv($line);
            $data[] = [
                "name" => $cvs[1],
                "date" => $cvs[2],
                "price" => $cvs[3],
                "value" => $cvs[4]
            ];
        }
        $collection = (new \MongoDB\Client)->test->data;
        $this->info("Save data Mongo db test.data");
        $collection->insertMany($data);
    }
}
