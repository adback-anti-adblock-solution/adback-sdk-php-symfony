<?php

namespace Adback\ApiClientBundle\Driver;

use Adback\ApiClient\Driver\ScriptCacheInterface;
use Adback\ApiClient\Driver\SqlScriptCache;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class ConfigFileScriptCache
 */
class ConfigFileScriptCache extends SqlScriptCache implements ScriptCacheInterface
{
    protected $cache;

    /**
     * @param $cacheDirectory
     * @param $debug
     */
    public function __construct($cacheDirectory, $debug)
    {
        $adbackCacheDir = $cacheDirectory . '/adback';
        $file = $adbackCacheDir . '/apiCache.php';
        $fs = new FileSystem();
        if (!$fs->exists($file)) {
            $fs->mkdir($adbackCacheDir);
            $fs->touch($file);
        }
        $this->cache = new ConfigCache($file, $debug);
    }

    /**
     * @param string $key
     *
     * @return string|null
     */
    protected function get($key)
    {
        $content = json_decode(file_get_contents($this->cache->getPath()), true);

        if (array_key_exists($key, $content)) {
            return $content[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @param string $value
     */
    protected function set($key, $value)
    {
        $content = json_decode(file_get_contents($this->cache->getPath()), true);

        if (null === $content) {
            $content = [];
        }

        $content[$key] = $value;
        $this->cache->write(json_encode($content));
    }

    /**
     * @param string $key
     */
    protected function clear($key)
    {
        $content = json_decode(file_get_contents($this->cache->getPath()), true);

        if (array_key_exists($key, $content)) {
            unset($content[$key]);
        }

        $this->cache->write(json_encode($content));
    }
}
