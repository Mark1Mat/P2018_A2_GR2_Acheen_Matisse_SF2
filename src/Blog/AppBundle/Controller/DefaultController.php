<?php

namespace Blog\AppBundle\Controller;

use Blog\AdminBundle\Entity\ArticleRepository;
use Blog\AdminBundle\Entity\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class DefaultController extends Controller
{
    /**
     * @Route("/{id}", name="homePage", defaults={"id" = null}, requirements={"id" = "\d+"})
     *
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

    /**
     * @Route("/tag/{name}/{id}", name="tag", defaults={"id" = null}, requirements={"id" = "\d+"})
     *
     * @Method("GET")
     *
     */
    public function tagAction($name, $id)
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
        /** @var TagRepository $repo */
        $repo = $em->getRepository('BlogAdminBundle:Tag')->findOneBy(['name' => $name]);
        $idtag = $repo->getId();
        /** @var ArticleRepository $tagrepo */
        $tagrepo = $em->getRepository('BlogAdminBundle:Article');

        $tag = $tagrepo->findbyTag($idtag);

        return $this->render('BlogAppBundle:Article:showTag.html.twig', [
            'tags' => $tag,
            'name' => $name,
            'min' => $min,
            'max' => $max,
        ]);
    }
}
