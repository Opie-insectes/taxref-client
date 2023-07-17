<?php

namespace App\Command;

use App\Service\TaxrefService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'taxa:id:media',
    description: 'Renvoie la liste des media associés à ce taxon.',
)]
class TaxaIdMediaCommand extends Command
{
    public function __construct(
        private TaxrefService $taxrefService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('id', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = $this->taxrefService->taxaIdMedia((int) $input->getArgument('id'));
        if ($result === null) {
            $output->writeln('No results.');
            return Command::SUCCESS;
        }

        foreach ($result->embedded as $embeddedKey => $embedded) {
            $output->writeln($embeddedKey);
            $output->writeln($embedded);
        }
        return Command::SUCCESS;
    }
}
