<?php

namespace EnsahBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EnsahBundle:default:index.html.twig');
    }

    public function downloadAction($table, $id)
    {
        return new Response("Download a khoya");
    }
}
