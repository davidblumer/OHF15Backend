<?php
/**
 *
 * Copyright (c) 2015 Socialbit GmbH. All rights reserved.
 *
 */

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class PoiType
 * @package AppBundle\Document
 * @author Fabian Sabau <fabian.sabau@socialbit.de>
 *
 * @ODM\EmbeddedDocument()
 */
class PoiType
{
    /**
     * @ODM\String()
     * @var string $name
     */
    private $name;

    /**
     * PoiType constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}
