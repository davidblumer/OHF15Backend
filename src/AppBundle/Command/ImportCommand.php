<?php

namespace AppBundle\Command;

use AppBundle\Document\Geo;
use AppBundle\Document\Poi;
use AppBundle\Document\PoiType;
use AppBundle\Document\Tag;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:data:import')
            ->setDescription('App data importer')
            ->addArgument(
                'path',
                InputArgument::OPTIONAL,
                'Path to the file you want to import'
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');

        $file = file($path);

        $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();

        foreach ($file as $line) {
            $line = trim($line, "\n");
            $currentPoi = explode(",", $line);

            $type = new PoiType($currentPoi[0]);
            $geo = new Geo(0, 0);

            $tagNames = explode(" ", $currentPoi[2]);

            $tags = array();

            foreach ($tagNames as $tagName) {
                $tags[] = new Tag($tagName);
            }

            $poi = new Poi($type, $geo, $tags);

            $dm->persist($poi);
        }

        $dm->flush();
    }
}
