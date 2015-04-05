<?php

namespace Blog\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class DefaultController extends Controller
{
    /**
     * @Route("/about", name="about")
     *
     */
    public function showAction()
    {
        return $this->render('BlogAppBundle:About:index.html.twig');
    }
}
