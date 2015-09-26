<?php
/**
 *
 * Copyright (c) 2015 Socialbit GmbH. All rights reserved.
 *
 */

namespace AppBundle\Document\Repository;

use AppBundle\Document\Geo;
use AppBundle\Document\Poi;
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
        return $this->dm->createQueryBuilder()
            ->field('geo')
            ->geoNear($geo->getLat(), $geo->getLng())
            ->spherical(true)
            ->distanceMultiplier(6378.137)
            ->getQuery()
            ->execute()
        ;
    }
}
