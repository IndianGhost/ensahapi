<?php

namespace EnsahBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EmploiController extends Controller
{
    public function emploiTempsAction($niveau)
    {
        $em = $this->getDoctrine()->getRepository('EnsahBundle:EmploiTemps');
        $emploi = $em->findOneByNiveau($niveau);
        if($emploi != null)
        {
            return $this->redirectToRoute("download_route",
                array(
                    "table" => "EmploiTemps",
                    "id" => $emploi->getId()
                )
            );
        }
        else
        {
            $msg = 'Il n\y a aucun niveau intitule '.$niveau;
            return new JsonResponse(
                array(
                    'reponse'=>$msg
                ),
                Response::HTTP_EXPECTATION_FAILED
            );
        }
    }

}
