<?php
/**
 *
 * Copyright (c) 2015 Socialbit GmbH. All rights reserved.
 *
 */

namespace AppBundle\Resolver;
use AppBundle\Document\Poi;
use AppBundle\Document\PoiType;
use AppBundle\Document\Repository\PoiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * Class PoiTypeResolver
 * @package AppBundle\Resolver
 * @author Fabian Sabau <fabian.sabau@socialbit.de>
 */
class PoiTypeResolver
{
    /**
     * @var PoiRepository
     */
    private $poiRepository;

    /**
     * PoiTypeResolver constructor.
     * @param PoiRepository $poiRepository
     */
    public function __construct(PoiRepository $poiRepository)
    {
        $this->poiRepository = $poiRepository;
    }

    public function resolveType($tags)
    {
        $types = array();

        foreach($tags as $tag) {
            /** @var Poi $poi */
            $pois = $this->poiRepository->findByTag($tag);

            foreach ($pois as $poi) {
                $type = $poi->getType();

                $types[$type->getName()][] = $tag;
            }
        }

        uasort($types, function($a, $b) {
            return count($a) - count($b);
        });

        $type = key($types);

        return $type ? new PoiType($type) : null;
    }
}
