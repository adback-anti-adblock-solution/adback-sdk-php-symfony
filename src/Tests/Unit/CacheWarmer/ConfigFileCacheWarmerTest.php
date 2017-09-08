<?php

namespace Adback\ApiClientBundle\Tests\Unit\CacheWarmer;

use Adback\ApiClient\Query\QueryInterface;
use Adback\ApiClientBundle\CacheWarmer\ConfigFileCacheWarmer;
use Phake;
use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;

/**
 * Class ConfigFileCacheWarmerTest
 */
class ConfigFileCacheWarmerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConfigFileCacheWarmer
     */
    protected $warmer;

    protected $query;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->query = Phake::mock(QueryInterface::CLASS);

        $this->warmer = new ConfigFileCacheWarmer($this->query);
    }

    /**
     * Test instance
     */
    public function testInstance()
    {
        $this->assertInstanceOf(CacheWarmerInterface::CLASS, $this->warmer);
    }

    /**
     * Test query call
     */
    public function testWarmup()
    {
        $this->warmer->warmUp('');

        Phake::verify($this->query)->execute();
    }

    /**
     * Test optionnal
     */
    public function testIsOptional()
    {
        $this->assertFalse($this->warmer->isOptional());
    }
}
