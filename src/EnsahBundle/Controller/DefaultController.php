<?php

namespace EnsahBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Kernel;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //code
    }

    public function downloadAction($table, $id)
    {
        if (strcmp($table, 'Actualite')==0 || strcmp($table, 'EmploiTemps')==0)
        {
            $myRepository = 'EnsahBundle:'.$table;
            $em = $this->getDoctrine()->getRepository($myRepository);
            $object = $em->findOneById($id);
            if($object != null)
            {
                if(strcmp(get_class($object), 'EnsahBundle\\Entity\\EmploiTemps')==0)
                {
                    $path = realpath(__DIR__.'/../../../web/emplois/'.$object->getNiveau().'.pdf');
                    $file = new File($path);
                    return $this->file($file);
                }
                elseif (strcmp(get_class($object), 'EnsahBundle\\Entity\\Actualite')==0)
                {
                    $msg = 'Il n\'y a aucun fichier a telecharger 1'.get_class($object);
                    return new JsonResponse(
                        array(
                            'reponse'=>$msg
                        ),
                        Response::HTTP_EXPECTATION_FAILED
                    );
                }
                else
                {
                    $msg = 'Il n\'y a aucun fichier a telecharger 2'.get_class($object);
                    return new JsonResponse(
                        array(
                            'reponse'=>$msg
                        ),
                        Response::HTTP_EXPECTATION_FAILED
                    );
                }
            }
        }
        else
        {
            $msg = 'Il n\'y a aucun fichier a telecharger else';
            return new JsonResponse(
                array(
                    'reponse'=>$msg
                ),
                Response::HTTP_EXPECTATION_FAILED
            );
        }
    }
}
