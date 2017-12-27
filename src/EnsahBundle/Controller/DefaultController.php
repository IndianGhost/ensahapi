<?php

namespace EnsahBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return new Response("C'est un RESTFUL API développé par le binôme Abdellatif BAKAR et Achraf BELLAALI !");
    }

    public function downloadAction($table, $id)
    {
        return new Response("Download a khoya");
    }
}
