<?php
/**
 *
 * Copyright (c) 2015 Socialbit GmbH. All rights reserved.
 *
 */

namespace AppBundle\Api;


use AppBundle\Document\Geo;
use AppBundle\Document\Poi;
use AppBundle\Document\PoiType;
use AppBundle\Document\Tag;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMS;

/**
 * Class PoiRequest
 * @package AppBundle\Api
 * @author Fabian Sabau <fabian.sabau@socialbit.de>
 */
class PoiRequest
{
    /**
     * @var Geo
     * @Assert\NotNull()
     * @JMS\Type(name="AppBundle\Document\Geo")
     */
    private $geo;

    /**
     * @var ArrayCollection|Tag[]
     * @JMS\Type(name="Doctrine\Common\Collections\ArrayCollection<AppBundle\Document\Tag>")
     */
    private $tags;

    /**
     * @var PoiType
     * @JMS\Type(name="AppBundle\Document\PoiType")
     */
    private $type;

    /**
     * @return Geo
     */
    public function getGeo()
    {
        return $this->geo;
    }

    /**
     * @return \AppBundle\Document\Tag[]|ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return PoiType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param PoiType $type
     * @return Poi
     */
    public function createPoi(PoiType $type)
    {
        return new Poi($type, $this->geo, $this->tags);
    }

}
