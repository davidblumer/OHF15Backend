<?php
/**
 *
 * Copyright (c) 2015 Socialbit GmbH. All rights reserved.
 *
 */

namespace AppBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Poi
 * @package AppBundle\Document
 * @author Fabian Sabau <fabian.sabau@socialbit.de>
 *
 * @ODM\Document(repositoryClass="AppBundle\Document\Repository\PoiRepository")
 * @ODM\Index(keys={"geo"="2d"})
 */
class Poi
{
    /**
     * @var string $id
     * @ODM\Id(strategy="UUID")
     */
    private $id;

    /**
     * @var PoiType $type
     * @ODM\EmbedOne(targetDocument="AppBundle\Document\PoiType", nullable=true)
     */
    private $type;

    /**
     * @var Geo $geo
     * @ODM\EmbedOne(targetDocument="AppBundle\Document\Geo")
     */
    private $geo;

    /**
     * @var ArrayCollection|Tag[] $tags
     * @ODM\EmbedMany()
     */
    private $tags;

    /**
     * Poi constructor.
     * @param PoiType $type
     * @param Geo $geo
     * @param Tag[]|ArrayCollection $tags
     */
    public function __construct(PoiType $type, Geo $geo, array $tags)
    {
        $this->type = $type;
        $this->geo = $geo;
        $this->tags = new ArrayCollection($tags);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return PoiType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return Geo
     */
    public function getGeo()
    {
        return $this->geo;
    }

    /**
     * @return Tag[]|ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

}
