<?php

namespace Palicao\Bundle\KeyValueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PalicaoKeyValueBundle:Default:index.html.twig', array('name' => $name));
    }
}
