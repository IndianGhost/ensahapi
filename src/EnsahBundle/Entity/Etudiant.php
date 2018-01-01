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
     * @ORM\Column(name="date_naissance", type="date")
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
}