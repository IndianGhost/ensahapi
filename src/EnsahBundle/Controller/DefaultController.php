<?php

namespace EnsahBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('Main/index.html.twig');
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
                    if($object->getFichierAttache())
                    {
                        $path = realpath(__DIR__ . '/../../../web/news/' . $object->getLien());
                        $file = new File($path);
                        return $this->file($file);
                    }
                    else
                    {
                        $msg = 'Il n\'y a aucun fichier attache a cette actualite !';
                        return new JsonResponse(
                            array(
                                'reponse'=>$msg
                            ),
                            Response::HTTP_EXPECTATION_FAILED
                        );
                    }
                }
                else
                {
                    $msg = 'le fichier demande n\'existe pas !';
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
            $msg = 'Il n\'y a aucun fichier a telecharger !';
            return new JsonResponse(
                array(
                    'reponse'=>$msg
                ),
                Response::HTTP_EXPECTATION_FAILED
            );
        }
    }
}
