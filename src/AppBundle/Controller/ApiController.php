<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\Annotations as Rest;

class ApiController extends FOSRestController
{
    
    /**
     *  @Rest\Post("/poi")
     * 
     */ 
    public function postPoiAction(Request $request)
    {
        
        $content = $request->getContent();
        $dm = $this->get('doctrine_mongodb')->getManager();
        //$poi = $dm->getRepository('AppBundle:Poi')->find(1); 
       
        $serializer = $this->get('nil_portugues.serializer.json_api_serializer');
        
        $poi = $serializer->unserialize($content);
        
        $response = new Response();
        
        return $response;
    }
    
    /**
     *  @Rest\Put("/poi/{id}")
     * 
     */ 
    public function putPoiAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $poi = $dm->getRepository('AppBundle:Poi')->find($id);
        
        $serializer = $this->get('nil_portugues.serializer.json_api_serializer');
 
    }
    
    /**
     *  @Rest\Get("/poi/{id}", name="get_poi")
     * 
     */ 
    public function getPoiAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $poi = $dm->getRepository('AppBundle:Poi')->find($id);
        
        $serializer = $this->get('nil_portugues.serializer.json_api_serializer');

        /** @var \NilPortugues\Api\JsonApi\JsonApiTransformer $transformer */
        $transformer = $serializer->getTransformer();
        $transformer->setSelfUrl($this->generateUrl('get_poi', ['id' => $id], true));
        
        $response = new Response($serializer->serialize($poi));
        
        return $response;
    }
    
    /**
     *  @Rest\Get("/pois/{lat}/{lng}/{distance}}", name="get_pois")
     * 
     */ 
    public function getPoisAction($lat, $lng, $distance)
    {
        $geo = new \AppBundle\Document\Geo($lat, $lng);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $pois = $dm->getRepository('AppBundle:Poi')->findInRange($geo, $distance);
        
        $serializer = $this->get('nil_portugues.serializer.json_api_serializer');

        /** @var \NilPortugues\Api\JsonApi\JsonApiTransformer $transformer */
        $transformer = $serializer->getTransformer();
        $transformer->setSelfUrl($this->generateUrl('get_poi', ['id' => $id], true));
        
        $response = new Response($serializer->serialize($poi));
        
        return $response;
    }
            

}
