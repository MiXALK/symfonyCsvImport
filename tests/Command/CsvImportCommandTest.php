<?php

namespace App\Tests\Command;

use App\Command\CsvImportCommand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CsvImportCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $em = $this->createMock(EntityManagerInterface::class);
        $application->add(new CsvImportCommand($em));

        $command = $application->find('csv:import');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('Next products skipped:', $output);
    }
}