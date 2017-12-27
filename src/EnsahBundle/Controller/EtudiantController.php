<?php

namespace EnsahBundle\Controller;

use EnsahBundle\Entity\Etudiant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JMS\SerializerBundle\JMSSerializerBundle;

class EtudiantController extends Controller
{
    public function signupAction(Request $request)
    {
        $cne = $request->get('cne');
        $motPasse = $request->get('motPasse');
        $nom = $request->get('nom');
        $prenom = $request->get('prenom');
        $dateNaissance = $request->get('dateNaissance');
        $niveau = $request->get('niveau');
        $numInscription = $request->get('numInscription');

        $donnees_valides = validation_signup($cne, $motPasse, $prenom, $dateNaissance, $niveau, $numInscription);

        if($donnees_valides)
        {
            //code
        }
        else
        {
            //code
        }
    }

    //Fonctionne tres bien
    public function loginAction(Request $request)
    {
        $cne = $request->get('cne');
        $motPasse = $request->get('motPasse');

        $etudiant = new Etudiant();

        $etudiant->setCne($cne);
        $etudiant->setMotPasse($motPasse);

        $em = $this->getDoctrine()->getManager();

        $etd_db = $em->getRepository('EnsahBundle:Etudiant')->findOneByCne($etudiant->getCne());

        $succes = false;
        $mot_passe_correct = false;
        if(strcmp(get_class($etudiant), get_class($etd_db)) == 0)
        {
            $succes = true;
            $mot_passe_correct = $etd_db->authentification(
                $etudiant->getCne(),
                $etudiant->getMotPasse()
            );
        }
        if($succes)
        {
            if($mot_passe_correct)
            {
                $data = $this->get('jms_serializer')->serialize($etd_db, 'json');

                $response = new Response($data);
                $response->headers->set('Content-Type', 'application/json');

                return $response;
            }
            else
            {
                return new Response('Mot de passe incorrect !', Response::HTTP_ACCEPTED);
            }
        }
        else
        {
            return new Response('Erreur: parametres ou requete inappropriee !', Response::HTTP_EXPECTATION_FAILED);
        }
    }

    public function passwordForgottenAction()
    {
        //code
    }

    function validation_signup($cne, $motPasse, $prenom, $dateNaissance, $niveau, $numInscription)
    {
        $donnees_valides = false;
        if($numInscription)//regex \d+
        {
            //code
        }
    }
}
