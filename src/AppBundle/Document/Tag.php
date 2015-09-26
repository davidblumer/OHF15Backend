<?php
/**
 *
 * Copyright (c) 2015 Socialbit GmbH. All rights reserved.
 *
 */

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class Tag
 * @package AppBundle\Document
 * @author Fabian Sabau <fabian.sabau@socialbit.de>
 *
 * @ODM\EmbeddedDocument()
 */
class Tag
{
    /**
     * @ODM\String()
     * @var string $name
     */
    protected $name;

    /**
     * @ODM\Float()
     * @var float
     */
    protected $weight;
}
