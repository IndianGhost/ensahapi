<?php

namespace EnsahBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

/**
 * Etudiant
 *
 * @ORM\Table(name="etudiant")
 * @ORM\Entity(repositoryClass="EnsahBundle\Repository\EtudiantRepository")
 */
class Etudiant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Serializer\Annotation\Type("integer")
     */
    private $id;

    /**
     * @var string
     * @JMS\Serializer\Annotation\Type("string")
     * @ORM\Column(name="cne", type="string", length=255)
     */
    private $cne;

    /**
     * @var string
     * @JMS\Serializer\Annotation\Type("string")
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     * @JMS\Serializer\Annotation\Type("string")
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     * @JMS\Serializer\Annotation\Type("string")
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var \DateTime
     * @JMS\Serializer\Annotation\Type("DateTime")
     * @ORM\Column(name="date_naissance", type="datetime")
     */
    private $dateNaissance;

    /**
     * @var string
     * @JMS\Serializer\Annotation\Type("string")
     * @ORM\Column(name="niveau", type="string", length=255)
     */
    private $niveau;

    /**
     * @var int
     * @JMS\Serializer\Annotation\Type("integer")
     * @ORM\Column(name="num_inscription", type="integer")
     */
    private $numInscription;

    /**
     * @var string
     * @JMS\Serializer\Annotation\Type("string")
     * @ORM\Column(name="mot_passe", type="string", length=255)
     */
    private $motPasse;

    public function __construct(){}

    public function __construct2($cne, $nom, $prenom, $email, $dateNaissance, $niveau, $numInscription, $motPasse)
    {
        $this->cne = $cne;
        $this->dateNaissance = $dateNaissance;
        $this->numInscription = $numInscription;
        $this->motPasse = $motPasse;
        $this->niveau = $niveau;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->email = $email;
    }

    //Ce constructeur doit etre utilise dans un bloc try{}catch(Exception $e){}
    public function __construct3($etudiant)
    {
        /*
         * Pour verifier que l'objet $etudiant est une instance de la classe Etudiant
         * La fonction strcmp(string, string) retourne 0 si les deux chaines de caracteres sont identiques
         * La fonction get_class(object) retourne le nom de la classe de l'objet en parametre ;)string !
        */
        if(strcmp(get_class($this), get_class($etudiant))==0)
        {
            $this->id = $etudiant->getId();
            $this->cne = $etudiant->getCne();
            $this->dateNaissance = $etudiant->getDateNaissance();
            $this->numInscription = $etudiant->getNumInscription();
            $this->motPasse = $etudiant->getMotPasse();
            $this->niveau = $etudiant->getNiveau();
            $this->prenom = $etudiant->getPrenom();
            $this->nom = $etudiant->getNom();
        }
        else
        {
            throw new Exception("Une erreur est survenue au niveau du constructeur par objet de la classe Etudiant");
        }
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cne
     *
     * @param string $cne
     *
     * @return Etudiant
     */
    public function setCne($cne)
    {
        $this->cne = $cne;

        return $this;
    }

    /**
     * Get cne
     *
     * @return string
     */
    public function getCne()
    {
        return $this->cne;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Etudiant
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Etudiant
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Etudiant
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Etudiant
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set niveau
     *
     * @param string $niveau
     *
     * @return Etudiant
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set numInscription
     *
     * @param integer $numInscription
     *
     * @return Etudiant
     */
    public function setNumInscription($numInscription)
    {
        $this->numInscription = $numInscription;

        return $this;
    }

    /**
     * Get numInscription
     *
     * @return int
     */
    public function getNumInscription()
    {
        return $this->numInscription;
    }

    /**
     * Set motPasse
     *
     * @param string $motPasse
     *
     * @return Etudiant
     */
    public function setMotPasse($motPasse)
    {
        $this->motPasse = $motPasse;

        return $this;
    }

    /**
     * Get motPasse
     *
     * @return string
     */
    public function getMotPasse()
    {
        return $this->motPasse;
    }

    public function validerAnnee()
    {
        $this->niveau++;
    }

    public function confirmerMotPasse($motPasseSaisi)
    {
        if(strcmp($this->motPasse, $motPasseSaisi)==0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function confirmerCne($cne)
    {
        if(strcmp($this->cne, $cne)==0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function authentification($cne, $motPass)
    {
        if($this->confirmerCne($cne) && $this->confirmerMotPasse($motPass))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

