<?php

namespace EnsahBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ActualiteController extends Controller
{
    public function actualiteAction()
    {
        $actualites = null;
        $em = $this->getDoctrine()->getManager();
        $actualites = $em->getRepository('EnsahBundle:Actualite')->findBy(array(), array('id'=>'desc'));
        if($actualites != null)
        {
            $data = $this->get('jms_serializer')->serialize($actualites, 'json');

            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
        }
        else
        {
            $msg = 'Erreur a la lecture des actualites !';
            $response = new JsonResponse(
                array(
                    'reponse'=>$msg
                ),
                Response::HTTP_EXPECTATION_FAILED
            );
        }
        return $response;
    }

}
