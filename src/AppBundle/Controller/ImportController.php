<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Document\Poi;
use AppBundle\Document\Geo;
use AppBundle\Document\PoiType;
use AppBundle\Document\Tag;

use FOS\RestBundle\Controller\Annotations as Rest;

class ImportController extends FOSRestController
{
    
    /**
     *  @Rest\Post("/import")
     * 
     */ 
    public function postImportAction(Request $request)
    {
        $uploadedFile=$request->files->get("import");
        
        $file = file($uploadedFile);
        
        $dm = $this->get('doctrine_mongodb')->getManager();
       
        foreach ($file as $line)
        {
           $line = trim($line, "\n");
           $currentPoi = explode(",", $line);
           
           $type = new PoiType($currentPoi[0]);
           $geo = new Geo(0, 0);
           
           $tagNames = explode(" ", $currentPoi[2]);
           
           $tags = array();
           
           foreach ($tagNames as $tagName)
           {
               $tags[] = new Tag($tagName);
           }
           
           $poi = new Poi($type, $geo, $tags);

           $dm->persist($poi);
        }

        $dm->flush();
        
        $response = new Response();
        return $response;
    }
            

}
