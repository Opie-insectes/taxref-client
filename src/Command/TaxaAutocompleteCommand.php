<?php

namespace App\Command;

use App\Service\TaxrefService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'taxa:autocomplete',
    description: 'Renvoie les taxons qui contiennent un terme.',
)]
class TaxaAutocompleteCommand extends Command
{
    public function __construct(
        private TaxrefService $taxrefService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('terme', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = $this->taxrefService->taxaAutocomplete($input->getArgument('terme'));
        $output->writeln("Résultats: {$result->page->totalElements}");
        foreach ($result->embedded['taxa'] as $taxa) {
            $output->writeln("\t$taxa->scientificName [cdNom $taxa->id] [cdRef $taxa->referenceId]");
        }
        return Command::SUCCESS;
    }
}
