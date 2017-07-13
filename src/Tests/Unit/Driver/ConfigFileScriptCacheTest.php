<?php

namespace Adback\ApiClient\Tests\Unit\Driver;

use Adback\ApiClient\Driver\ScriptCacheInterface;
use Adback\ApiClientBundle\Driver\ConfigFileScriptCache;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class ConfigFileScriptCacheTest
 */
class ConfigFileScriptCacheTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConfigFileScriptCache
     */
    protected $cache;

    /**
     * @var Filesystem
     */
    protected $fs;
    protected $cacheDir;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->fs = new Filesystem();
        $this->cacheDir = __DIR__ . '/cache';
        if ($this->fs->exists($this->cacheDir)) {
            $this->fs->remove($this->cacheDir);
        }

        $this->cache = new ConfigFileScriptCache($this->cacheDir, true);
    }

    /**
     * Test instance
     */
    public function testInstance()
    {
        $this->assertInstanceOf(ScriptCacheInterface::CLASS, $this->cache);
    }

    /**
     * Test set, get and clear
     */
    public function testSetGetClear()
    {
        $cacheFile = $this->cacheDir . '/adback/apiCache.php';

        $this->cache->setAnalyticsScript('foo');
        $this->assertTrue($this->fs->exists($cacheFile));
        $this->assertSame(json_encode(['adback_analytics_script' => 'foo']), file_get_contents($cacheFile));

        $this->assertSame('foo', $this->cache->getAnalyticsScript());

        $this->cache->clearAnalyticsData();
        $this->assertTrue($this->fs->exists($cacheFile));
        $this->assertSame(json_encode([]), file_get_contents($cacheFile));
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        parent::tearDown();

        if ($this->fs->exists($this->cacheDir)) {
            $this->fs->remove($this->cacheDir);
        }
    }
}
