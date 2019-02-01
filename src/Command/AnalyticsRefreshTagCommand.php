<?php

namespace Adback\ApiClientBundle\Command;

use Adback\ApiClient\Query\QueryInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AnalyticsRefreshTagCommand
 */
class AnalyticsRefreshTagCommand extends ContainerAwareCommand
{
    protected $query;

    /**
     * @param QueryInterface $query
     */
    public function __construct(QueryInterface $query = null)
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
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!($this->query instanceof QueryInterface)) {
            $this->query = $this->getContainer()->get('adback_api_client.query.script_url');
        }
        $this->query->execute();
    }
}
