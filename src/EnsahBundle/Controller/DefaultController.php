<?php

namespace EnsahBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //code
    }

    public function downloadAction($table, $id)
    {
        //return new Response("Download a khoya");
    }
}
