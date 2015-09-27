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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\MongoDB\CursorInterface;
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
     * @return ArrayCollection|Poi[]
     */
    public function findInRange(Geo $geo, $distance)
    {
        $distance = (float)$distance;

        /** @var CursorInterface $cursor */
        $qb = $this->createQueryBuilder()
            ->field('geo')->withinCenter($geo->getLat(),$geo->getLng(),$distance)
//            ->eagerCursor(true)
            ->getQuery()
            ->execute()
        ;

        $result = new ArrayCollection();

        foreach ($qb as $poi) {
            $result->add($poi);
        }

        return $result;
    }

    /**
     * @param string $tag
     */
    public function findOneByTag(Tag $tag)
    {
        return $this->findOneBy(['tags' => $tag]);
    }

    public function findByTag(Tag $tag)
    {
        return $this->findBy(['tags' => $tag]);
    }
}
