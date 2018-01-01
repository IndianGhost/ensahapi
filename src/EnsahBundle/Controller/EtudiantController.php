<?php

namespace EnsahBundle\Controller;

use EnsahBundle\Entity\Etudiant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JMS\SerializerBundle\JMSSerializerBundle;

class EtudiantController extends Controller
{
    //Fonctionne. Mais, avec des probleme au type date a resoudre ulterieurement !
    public function signupAction(Request $request)
    {
        $cne = $request->request->get('cne');
        $motPasse = $request->request->get('motPasse');
        $nom = $request->request->get('nom');
        $prenom = $request->request->get('prenom');
        $email = $request->request->get('email');
        $dateNaissance = $request->request->get('dateNaissance');
        $niveau = $request->request->get('niveau');
        $numInscription = $request->request->get('numInscription');

        //Conversion necessaire
        $numInscription = intval($numInscription);
        $dateNaissance = strtotime($dateNaissance);

        //creation d'un objet Etudiant
        $etudiant = new Etudiant();

        $etudiant->setCne($cne);
        $etudiant->setMotPasse($motPasse);
        $etudiant->setNom($nom);
        $etudiant->setPrenom($prenom);
        $etudiant->setEmail($email);
//        $etudiant->setDateNaissance($dateNaissance);
        $etudiant->setNiveau($niveau);
        $etudiant->setNumInscription($numInscription);

        //Injetion de l'objet dans la base de donnees
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('EnsahBundle:Etudiant');
        $em->persist($etudiant);
        $em->flush();

        //verification de la saisie
        if(null != $etudiant->getId())
        {
            $msg = 'Compte cree avec succes !';
            $response = new JsonResponse(
                array(
                    'response' => $msg,
                ),
                Response::HTTP_ACCEPTED
            );
        }
        else
        {
            $msg = 'Compte n est pas cree !';
            $response = new JsonResponse(
                array(
                    'response' => $msg,
                ),
                Response::HTTP_EXPECTATION_FAILED
            );
        }
        return $response;
    }

    //Fonctionne tres bien
    public function loginAction(Request $request)
    {
        $cne = $request->request->get('cne');
        $motPasse = $request->request->get('motPasse');

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
            $mot_passe_correct = $this->authentification(
                $etd_db,
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
            }
            else
            {
                $msg = 'Mot de passe incorrect !';
                $response = new JsonResponse(
                    array(
                        'reponse'=>$msg
                    ),
                    Response::HTTP_EXPECTATION_FAILED
                );
            }
        }
        else
        {
            $msg = 'CNE incorrect !';
            $response = new JsonResponse(
                array(
                    'reponse'=>$msg
                ),
                Response::HTTP_EXPECTATION_FAILED
            );
        }
        return $response;
    }

    //Developpement de ce cas d'utilisation sera le dernier travail a faire !
    public function passwordForgottenAction()
    {
        //code
    }

    /*
     *  Pas de validation de donnees jusqu'a maintenant.
     * La validation des donnees se fait au niveau du front-end pendant la duree du developpement !
     */
//    function validation_signup($email, $motPasse, $dateNaissance, $niveau, $numInscription)
//    {
//        $donnees_valides = false;
//        /*
//         * niveau appartient a l'ensemble suivant :
//         * {cp1, cp2, gi1, gi2, gi3, gc1, gc2, gc3, geer1, geer2, geer3, gee1, gee2, gee3}
//         *
//        */
//        $niveaux = [
//            'cp1', 'cp2',
//            'gi1', 'gi2', 'gi3',
//            'gc1', 'gc2', 'gc3',
//            'geer1', 'geer2', 'geer3',
//            'gee1', 'gee2', 'gee3'
//        ];
//        /*
//         * #[^0-9]# retourne true si la phrase contient autre chose que des chiffres
//         * numInscription est valide au cas contraire, c'est pour cela qu'on fait la negation
//        */
//        if(
//            preg_match('/^\d+$/', $numInscription)
//        )//Regex pour format de la date a ajouter ulterieurement !
//        {
//            foreach($niveaux as $value)//Ou bien for($i=0; $i<count($niveau); $i++)
//            {
//                if(strtoupper($niveau)==strtoupper($value))
//                {
//                    $donnees_valides = true;
//                    break;
//                }
//            }
//            if($donnees_valides && $this->isValidEmail($email)==1)
//            {
//                $donnees_valides = true;
//            }
//            else
//            {
//                $donnees_valides = false;
//            }
//        }
//        return $donnees_valides;
//    }
//
//    function isValidEmail($email) {
//        return filter_var($email, FILTER_VALIDATE_EMAIL)
//        && preg_match('/@.+\./', $email);
//    }*/

    public function confirmerMotPasse(Etudiant $etudiant, $motPasseSaisi)
    {
        if(strcmp($etudiant->getMotPasse(), $motPasseSaisi)==0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function confirmerCne(Etudiant $etudiant, $cne)
    {
        if(strcmp($etudiant->getCne(), $cne)==0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function authentification(Etudiant $etudiant, $cne, $motPass)
    {
        if($this->confirmerCne($etudiant, $cne) && $this->confirmerMotPasse($etudiant, $motPass))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}