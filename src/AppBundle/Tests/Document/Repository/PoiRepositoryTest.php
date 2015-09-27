<?php
/**
 *
 * Copyright (c) 2015 Socialbit GmbH. All rights reserved.
 *
 */

namespace AppBundle\Tests\Document\Repository;

use AppBundle\Document\Geo;
use AppBundle\Document\Repository\PoiRepository;
use AppBundle\Document\Tag;
use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class PoiRepositoryTest
 * @package AppBundle\Tests\Document\Repository
 * @author Fabian Sabau <fabian.sabau@socialbit.de>
 */
class PoiRepositoryTest extends WebTestCase
{
    /** @var PoiRepository $repo */
    private $repo;

    protected function setUp()
    {
        $this->loadFixtures(['AppBundle\DataFixtures\MongoDB\PoiLoader'], null, 'doctrine_mongodb');
        $this->repo = $this->getContainer()->get('doctrine_mongodb')->getRepository('AppBundle:Poi');
    }

    public function testFindByTag()
    {
        $tag = new Tag('tag1');

        $poi = $this->repo->findOneByTag($tag);

        $this->assertNotNull($poi);
        $this->assertEquals($poi->getType()->getName(), 'type1');
    }

    public function testFindInRange()
    {
        $pois = $this->repo->findInRange(new Geo(1, 1), 10);

        $this->assertNotNull($pois);
        $this->assertCount(1, $pois);

        $this->assertEquals($pois->current()->getType()->getName(), 'type1');
    }
}
