<?php
/**
 * Created by PhpStorm.
 * User: Steeve Jerent
 * Date: 04/04/2015
 * Time: 19:45
 */

namespace Blog\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ArticleController extends Controller
{
    /**
     * @Route("/{id}", name="homePage", defaults={"id" = null}, requirements={"id" = "\d+"})
     *
     * @Method("GET")
     */
    public function indexAction($id)
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
        $articles = $em->getRepository('BlogAdminBundle:Article')->findby([],['updatedAt' => 'DESC']);
        return $this->render('BlogAppBundle:Article:index.html.twig', [
            'articles' => $articles,
            'min' => $min,
            'max' => $max,
        ]);
    }
    /**
     * @Route("/article/{id}", name="article")
     *
     * @Method("GET")
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('BlogAdminBundle:Article')->findOneById($id);

        return $this->render('BlogAppBundle:Article:showArticle.html.twig', [
            'article' => $article,
        ]);
    }
}