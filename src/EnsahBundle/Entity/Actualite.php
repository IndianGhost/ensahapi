<?php

namespace EnsahBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actualite
 *
 * @ORM\Table(name="actualite")
 * @ORM\Entity(repositoryClass="EnsahBundle\Repository\ActualiteRepository")
 */
class Actualite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="fichier_attache", type="string", length=255)
     */
    private $fichierAttache;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    public function __construct(){}

    public function __construct1($fichier_attache, $titre, $contenu)
    {
        $this->setFichierAttache($fichier_attache);
        $this->setTitre($titre);
        $this->setContenu($contenu);
    }

    //Ce constructeur doit etre utilise dans un bloc try{}catch(Exception $e){}
    public function __construct2($actualite)
    {
        /*
         * Pour verifier que l'objet $actualite est une instance de la classe Actualite
         * La fonction strcmp(string, string) retourne 0 si les deux chaines de caracteres sont identiques
         * La fonction get_class(object) retourne le nom de la classe de l'objet en parametre ;)string !
        */
        if (strcmp(get_class($this), get_class($actualite)) == 0) {
            $this->id = $actualite->getId();

            $this->setContenu(
                $actualite->getContenu()
            );

            $this->setTitre(
                $actualite->getTitre()
            );

            $this->setFichierAttache(
                $actualite->getFichierAttache()
            );
        }
        else
        {
            throw new Exception("Une erreur est survenue au niveau du constructeur par objet de la classe Actualite");
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
     * Set fichierAttache
     *
     * @param string $fichierAttache
     *
     * @return Actualite
     */
    public function setFichierAttache($fichierAttache)
    {
        $this->fichierAttache = $fichierAttache;

        return $this;
    }

    /**
     * Get fichierAttache
     *
     * @return string
     */
    public function getFichierAttache()
    {
        return $this->fichierAttache;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Actualite
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Actualite
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }
}

