<?php

namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Process\Process;


class SaveBdCommand extends Command
{
    use LockableTrait;

    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'bd:save';
    protected static $defaultDescription = 'Save BD';
    private $client;
    private $container;
    private $output;

    protected function configure(): void
    {
        $this->setHelp('Sauvegarde la base de donnÃ©es');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $this->output = $output;
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process.');

            return Command::SUCCESS;
        }


        $output->writeln([
            'Sauvegarde start',
            '============',
            '',
        ]);

        $name = "GDSport-" . date('Y-m-d-H:i:s');

        $dumpCommand = sprintf(
            'mysqldump -u%s -p%s %s > %s',
            'login4674',
            'LvXgFsUJrpYzgPP',
            $name,
            "/datas/$name.sql"
        );

        $process = Process::fromShellCommandline($dumpCommand);
        $process->run();

        $encryptedFilePath = "/datas/{$name}-encrypted.sql";
        $encryptionKey = 'macledecryptage';

        $fileContents = file_get_contents("/datas/$name.sql");
        $encryptedContents = openssl_encrypt($fileContents, 'AES-256-CBC', $encryptionKey, 0, substr(md5($encryptionKey), 0, 16));
        file_put_contents($encryptedFilePath, $encryptedContents);

        unlink("/datas/$name.sql");

        $zipCommand = sprintf(
            "zip /datas/$name-encrypted.zip %s",
            "/datas/$name-encrypted.sql"
        );

        $process = Process::fromShellCommandline($zipCommand);
        $process->run();

        $delSqlFile = sprintf(
            "rm -r /datas/$name-encrypted.sql"
        );

        $process = Process::fromShellCommandline($delSqlFile);
        $process->run();

        $output->writeln([
            'Sauvegarde end',
            '============',
            '',
        ]);

        $this->release();

        return Command::SUCCESS;

        
    }
}
