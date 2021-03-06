<?php

namespace Adback\ApiClientBundle\Repository;

use Adback\ApiClientBundle\Entity\ApiCache;

/**
 * Class ApiCacheRepository
 */
class ApiCacheRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param string $key
     *
     * @return null|ApiCache
     */
    public function findOneByKey($key)
    {
        $qb = $this->createQueryBuilder('a');

        $qb->andWhere($qb->expr()->eq('a.key', ':key'));
        $qb->setParameter('key', $key);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
