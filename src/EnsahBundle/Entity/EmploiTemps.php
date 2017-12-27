<?php

namespace EnsahBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmploiTemps
 *
 * @ORM\Table(name="emploi_temps")
 * @ORM\Entity(repositoryClass="EnsahBundle\Repository\EmploiTempsRepository")
 */
class EmploiTemps
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
     * @ORM\Column(name="lien", type="string", length=255)
     */
    private $lien;

    public function __construct(){}

    public function __construct1($lien)
    {
        $this->setLien($lien);
    }

    //Ce constructeur doit etre utilise dans un bloc try{}catch(Exception $e){}
    public function __construct2($emploiTemps)
    {
        /*
         * Pour verifier que l'objet $actualite est une instance de la classe EmploiTemps
         * La fonction strcmp(string, string) retourne 0 si les deux chaines de caracteres sont identiques
         * La fonction get_class(object) retourne le nom de la classe de l'objet en parametre ;)string !
        */
        if (strcmp(get_class($this), get_class($emploiTemps)) == 0)
        {
            $this->id = $emploiTemps->getId();

            $this->setLien(
                $emploiTemps->getLien()
            );
        }
        else
        {
            throw new Exception("Une erreur est survenue au niveau du constructeur par objet de la classe EmploiTemps");
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
     * Set lien
     *
     * @param string $lien
     *
     * @return EmploiTemps
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }
}

