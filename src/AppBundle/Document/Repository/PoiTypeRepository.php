<?php
/**
 *
 * Copyright (c) 2015 Socialbit GmbH. All rights reserved.
 *
 */

namespace AppBundle\Document\Repository;

use AppBundle\Document\PoiType;

/**
 * Class PoiTypeRepository
 * @package AppBundle\Document\Repository
 * @author Fabian Sabau <fabian.sabau@socialbit.de>
 */
class PoiTypeRepository
{
    /**
     * @return array
     */
    public function findAll()
    {
        return [
            new PoiType('nature'),
            new PoiType('shopping'),
            new PoiType('people'),
            new PoiType('place'),
            new PoiType('landmark'),
            new PoiType('party'),
            new PoiType('culture'),
            new PoiType('sport'),
            new PoiType('work'),
            new PoiType('fun'),
            new PoiType('food'),
            new PoiType('sleep'),
        ];
    }
}
