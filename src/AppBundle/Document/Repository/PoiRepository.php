<?php
/**
 *
 * Copyright (c) 2015 Socialbit GmbH. All rights reserved.
 *
 */

namespace AppBundle\Document\Repository;

use AppBundle\Document\Geo;
use AppBundle\Document\Poi;
use AppBundle\Document\Tag;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Class PoiRepository
 * @package AppBundle\Document\Repository
 * @author Fabian Sabau <fabian.sabau@socialbit.de>
 */
class PoiRepository extends DocumentRepository
{
    /**
     * Find all POIs in geo range
     *
     * @param Geo $geo
     * @param $distance
     * @return array|Poi[]|null
     */
    public function findInRange(Geo $geo, $distance)
    {
        return $this->createQueryBuilder()
            ->field('geo')
            ->geoWithinCenter($geo->getLat(), $geo->getLng(), $distance)
//            ->geoNear($geo->getLat(), $geo->getLng())
//            ->spherical(true)
//            ->distanceMultiplier(6378.137)
            ->eagerCursor(true)
            ->getQuery()
            ->execute()
        ;
    }

    /**
     * @param string $tag
     */
    public function findOneByTag(Tag $tag)
    {
//        $criteria = Criteria::create()
//            ->where(Criteria::expr()->in('tags', $tag))
//        ;

        return $this->findOneBy(['tags' => $tag]);
    }

    public function findByTag(Tag $tag)
    {
        return $this->findBy(['tags' => $tag]);
    }
}
