<?php
/**
 *
 * Copyright (c) 2015 Socialbit GmbH. All rights reserved.
 *
 */

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Geo
 * @package AppBundle\Document
 * @author Fabian Sabau <fabian.sabau@socialbit.de>
 *
 * @ODM\EmbeddedDocument()
 */
class Geo
{
    /**
     * @var float $lat
     * @ODM\Float()
     * @JMS\Type(name="float")
     */
    private $lat;

    /**
     * @var float $lng
     * @ODM\Float()
     * @JMS\Type(name="float")
     */
    private $lng;

    /**
     * Geo constructor.
     * @param float $lat
     * @param float $lng
     */
    public function __construct($lat, $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    /**
     * @return float
     */
    public function getLat()
    {
        return (float)$this->lat;
    }

    /**
     * @return float
     */
    public function getLng()
    {
        return (float)$this->lng;
    }

}
