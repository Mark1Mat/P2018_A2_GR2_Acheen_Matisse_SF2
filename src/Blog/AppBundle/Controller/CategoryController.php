<?php
/**
 * Created by PhpStorm.
 * User: Steeve Jerent
 * Date: 04/04/2015
 * Time: 19:53
 */

namespace Blog\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CategoryController extends Controller{
    /**
     * @Route("/category/{name}/{id}", name="category", defaults={"id" = null}, requirements={"id" = "\d+"})
     *
     * @Method("GET")
     *
     */
    public function categoryAction($name, $id)
    {
        $min = 0;
        $max = 4;
        if($id != null){
            if($id > 1){
                $max = ($max * $id);
                $min = $max - 4;
            }
        }
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository('BlogAdminBundle:Category')->findOneBy(['name' => $name]);

        $category = $em->getRepository('BlogAdminBundle:Article')->findBy(['category' => $repo]);

        return $this->render('BlogAppBundle:Article:showCategory.html.twig', [
            'category' => $category,
            'name' => $name,
            'min' => $min,
            'max' => $max,
        ]);
    }
}