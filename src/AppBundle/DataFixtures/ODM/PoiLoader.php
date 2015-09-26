<?php
/**
 *
 * Copyright (c) 2015 Socialbit GmbH. All rights reserved.
 *
 */

namespace AppBundle\DataFixtures\ODM;

use AppBundle\Document\Geo;
use AppBundle\Document\Poi;
use AppBundle\Document\PoiType;
use AppBundle\Document\Tag;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class PoiLoader
 * @package AppBundle\Tests\Document\Repository\Fixtures
 * @author Fabian Sabau <fabian.sabau@socialbit.de>
 */
class PoiLoader implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tag1 = new Tag('tag1');
        $tag2 = new Tag('tag2');
        $tag3 = new Tag('tag3');
        $tag4 = new Tag('tag4');

        $poi1 = new Poi(new PoiType('type1'), new Geo(0,0), [$tag1, $tag2, $tag3]);
        $poi2 = new Poi(new PoiType('type2'), new Geo(0,0), [$tag2, $tag3, $tag4]);

        $manager->persist($poi1);
        $manager->persist($poi2);
        $manager->flush();
    }

}
