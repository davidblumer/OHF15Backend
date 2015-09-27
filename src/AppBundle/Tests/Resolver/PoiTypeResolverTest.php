<?php
/**
 *
 * Copyright (c) 2015 Socialbit GmbH. All rights reserved.
 *
 */

namespace AppBundle\Tests\Resolver;

use AppBundle\Document\Tag;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class PoiTypeResolverTest extends WebTestCase
{

    public function testResolveType()
    {
        $this->loadFixtures(['AppBundle\DataFixtures\MongoDB\PoiLoader'], null, 'doctrine_mongodb');

        $resolver = $this->getContainer()->get('app.poi.type_resolver');

        $tags = [
            new Tag('tag2'),
            new Tag('tag3')
        ];

        $type = $resolver->resolveType($tags);

        $this->assertNotNull($type);
        $this->assertEquals($type->getName(), 'type2');
    }
}
