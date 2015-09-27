<?php

namespace AppBundle\Controller;

use AppBundle\Api\PoiRequest;
use AppBundle\Document\Geo;
use AppBundle\Document\Poi;
use FOS\RestBundle\Controller\FOSRestController;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiController extends FOSRestController
{

    /**
     * @Rest\View()
     *
     * @param $id
     * @return array
     */
    public function getPoiAction($id)
    {
        $repo = $this->get('doctrine_mongodb')->getRepository('AppBundle:Poi');

        $poi = $repo->find($id);

        if (!$poi) {
            throw new NotFoundHttpException();
        }

        return ['poi' => $poi];
    }

    /**
     * @Rest\Get(path="/pois")
     * @Rest\View()
     *
     * @return array
     */
    public function getPoisAction()
    {
        $repo = $this->get('doctrine_mongodb')->getRepository('AppBundle:Poi');

        return ['pois' => $repo->findAll()];
    }


    /**
     * @Rest\View()
     * @Rest\Post(path="/pois")
     *
     * @ParamConverter("poiRequest", class="AppBundle\Api\PoiRequest")
     *
     * @param PoiRequest $poiRequest
     * @return View
     */
    public function postPoiAction(PoiRequest $poiRequest)
    {
        $dm = $this->get('doctrine_mongodb.odm.document_manager');
        $resolver = $this->get('app.poi.type_resolver');

        $type = $poiRequest->getType();

        if (!$type) {
            $type = $resolver->resolveType($poiRequest->getTags());
        }

        if (!$type) {
            return View::create(null, Codes::HTTP_BAD_REQUEST);
        }

        $poi = $poiRequest->createPoi($type);

        $dm->persist($poi);
        $dm->flush();
    }


}
