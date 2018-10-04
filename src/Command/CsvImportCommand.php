<?php

namespace App\Command;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use League\Csv\Reader;

class CsvImportCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * CsvImportCommand constructor.
     *
     * @param EntityManagerInterface $em
     *
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->em = $em;
    }

    /**
     * Configure
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this->setName('csv:import')
             ->setDescription('Imports the mock CSV data file')
             ->addArgument('test_mode', InputArgument::OPTIONAL, 'Is it a test mod?');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Attempting import CSV...');

        $reader = Reader::createFromPath('%kernel.root_dir%/../src/Data/stock.csv');

        $results = $reader->fetchAssoc();

        $resultsCounter = iterator_count($results);

        $io->progressStart($resultsCounter);

        $successCounter = 0;

        $skippedProducts = [];

        foreach ($results as $row) {
            $product = new Product();
            $product->setProductName($row['Product Name']);
            $product->setProductDesc($row['Product Description']);
            $product->setProductCode($row['Product Code']);
            $product->setDtmAdded(new \DateTime());
            $product->setStmTimestamp(new \DateTime());
            $product->setStockLevel($row['Stock']);
            $product->setPrice($row['Cost in GBP']);

            //Import Rules
            if ($row['Discontinued'] == "yes") {
                $product->setDtmDiscontinued(new \DateTime());
            } else {
                $product->setDtmDiscontinued(null);
            }

            if (($row['Cost in GBP'] >= 5) and ($row['Stock'] >= 10) and ($row['Cost in GBP'] <= 1000)) {
                $this->em->persist($product);
                $successCounter = (string)++$successCounter;
            } else {
                $skippedProducts[] = ' '.$row['Product Code'];
            }

            $io->progressAdvance();
        }

        $skippedCounter = (string)($resultsCounter - $successCounter);

        $skippedReport = implode(",", $skippedProducts);

        $testMode = $input->getArgument('test_mode');


        //save products to database if test mode is not used
        if ($testMode !== "test") {
            $this->em->flush();
        }

        $io->progressFinish();

        //report import result
        $io->success($successCounter.' processed successfully!');
        $io->warning($skippedCounter.' skipped. '."\n".'Next products skipped:'.$skippedReport.'.');
    }
}
