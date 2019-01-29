<?php

namespace Adback\ApiClientBundle\Command;

use Adback\ApiClient\Query\QueryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AnalyticsRefreshTagCommand
 */
class AnalyticsRefreshTagCommand extends Command
{
    protected $query;

    /**
     * @param QueryInterface $query
     */
    public function __construct(QueryInterface $query)
    {
        parent::__construct();
        $this->query = $query;
    }

    /**
     * Configure the command
     */
    protected function configure()
    {
        $this
            ->setName('adback:api-client:refresh-tag')
            ->setDescription('Refresh the adback tags: get urls and tags names from adback.co api')
        ;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->query->execute();
    }
}
