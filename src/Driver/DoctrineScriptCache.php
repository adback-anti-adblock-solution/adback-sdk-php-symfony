<?php

namespace Adback\ApiClientBundle\Driver;

use Adback\ApiClient\Driver\ScriptCacheInterface;
use Adback\ApiClient\Driver\SqlScriptCache;
use Adback\ApiClientBundle\Entity\ApiCache;
use Adback\ApiClientBundle\Repository\ApiCacheRepository;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class DoctrineScriptCache
 */
class DoctrineScriptCache extends SqlScriptCache implements ScriptCacheInterface
{
    protected $repository;
    protected $entityManager;

    /**
     * @param ApiCacheRepository $repository
     * @param ObjectManager      $manager
     */
    public function __construct(ApiCacheRepository $repository, ObjectManager $manager)
    {
        $this->repository = $repository;
        $this->entityManager = $manager;
    }

    /**
     * @param string $key
     *
     * @return string|null
     */
    protected function get($key)
    {
        $element = $this->repository->findOneByKey($key);

        if ($element instanceof ApiCache) {
            return $element->getValue();
        }

        return null;
    }

    /**
     * @param string $key
     * @param string $value
     */
    protected function set($key, $value)
    {
        $element = $this->repository->findOneByKey($key);

        if (!$element instanceof ApiCache) {
            $element = new ApiCache();
            $element->setKey($key);
            $this->entityManager->persist($element);
        }

        $element->setValue($value);

        $this->entityManager->flush($element);
    }

    /**
     * @param string $key
     */
    protected function clear($key)
    {
        $element = $this->repository->findOneByKey($key);

        if ($element instanceof ApiCache) {
            $this->entityManager->remove($element);
            $this->entityManager->flush($element);
        }
    }
}
