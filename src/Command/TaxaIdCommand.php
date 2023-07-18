<?php

namespace Opie\TaxrefClient\Command;

use Opie\TaxrefClient\Service\TaxrefService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'taxa:id',
    description: 'Renvoie le taxon correspondant.',
)]
class TaxaIdCommand extends Command
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
        $result = $this->taxrefService->taxaId((int) $input->getArgument('id'));
        $output->writeln($result);
        return Command::SUCCESS;
    }
}
