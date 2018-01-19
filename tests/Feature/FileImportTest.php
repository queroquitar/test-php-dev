<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Console\Commands\ReadFileInsertMongo;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Application as ConsoleApplication;


class FileImportTest extends TestCase
{
   
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testThrownExpectionReadFileInsertMongo()
    {
        
        $application = new ConsoleApplication();

        $testedCommand = $this->app->make(ReadFileInsertMongo::class);
        $testedCommand->setLaravel(app());
        $application->add($testedCommand);

        $command = $application->find('mongo:import');

        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command' => $command->getName(),
            'file' => 'C:\Users\ronli\Desktop\teste\test.csv'
        ]);

        $this->assertRegExp('/Importação concluida!/', $commandTester->getDisplay());
     
    }
}
