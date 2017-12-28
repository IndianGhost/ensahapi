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
        //request is equal to $_POST[], e.g : $_POST['cne'] equivalents $request->request->get('cne')
        //query is equal to $_GET[], e.g : $_GET['cne'] equivalents $request->query->get('cne')
        $cne = $request->request->get('cne');
        $motPasse = $request->request->get('motPasse');
        $nom = $request->request->get('nom');
        $prenom = $request->request->get('prenom');
        $email = $request->request->get('email');
        $dateNaissance = $request->request->get('dateNaissance');
        $niveau = $request->request->get('niveau');
        $numInscription = $request->request->get('numInscription');

        $donnees_valides = $this->validation_signup($email, $motPasse, $dateNaissance, $niveau, $numInscription);

        if($donnees_valides)
        {
            //Convertion du type
            $numInscription = intval($numInscription);
            $etudiant = new Etudiant($cne, $nom, $prenom, $email, $dateNaissance, $niveau, $numInscription, $motPasse);

            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();
            return new Response('Compte crée avec succès !', Response::HTTP_ACCEPTED);
        }
        else
        {
            return new Response('Données saisies non valides !', Response::HTTP_EXPECTATION_FAILED);
        }
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

    /**
     *
     */
    function validation_signup($email, $motPasse, $dateNaissance, $niveau, $numInscription)
    {
        $donnees_valides = false;
        /*
         * niveau appartient a l'ensemble suivant :
         * {cp1, cp2, gi1, gi2, gi3, gc1, gc2, gc3, geer1, geer2, geer3, gee1, gee2, gee3}
         *
        */
        $niveaux = [
            'cp1', 'cp2',
            'gi1', 'gi2', 'gi3',
            'gc1', 'gc2', 'gc3',
            'geer1', 'geer2', 'geer3',
            'gee1', 'gee2', 'gee3'
        ];
        /*
         * #[^0-9]# retourne true si la phrase contient autre chose que des chiffres
         * numInscription est valide au cas contraire, c'est pour cela qu'on fait la negation
        */
        if(
            preg_match('/^\d+$/', $numInscription)
        &&  strlen($motPasse)>=6 && strlen($motPasse)<=16
        )//Regex pour format de la date a ajouter ulterieurement !
        {
            foreach($niveaux as $value)//Ou bien for($i=0; $i<count($niveau); $i++)
            {
                if(strtoupper($niveau)==strtoupper($value))
                {
                    $donnees_valides = true;
                    break;
                }
            }
            if($donnees_valides && $this->isValidEmail($email)==1)
            {
                $donnees_valides = true;
            }
            else
            {
                $donnees_valides = false;
            }
        }
        return $donnees_valides;
    }

    function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL)
        && preg_match('/@.+\./', $email);
    }
}
