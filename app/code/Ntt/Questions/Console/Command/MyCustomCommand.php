<?php
namespace Ntt\Questions\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class MyCustomCommand extends Command
{
    protected function configure()
    {
        $this->setName('ntt:custom-command')
            ->setDescription('This is a custom command')
            ->addArgument('name', InputArgument::OPTIONAL, 'Your name');
        
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name') ?: 'Guest';
        $output->writeln('<info>Hello ' . $name . '! This is your custom CLI command.</info>' . date('Y-m-d H:i:s'));
        return Command::SUCCESS;
    }
}
