<?php

namespace Blog\AdminBundle\Controller;

use Blog\AdminBundle\Entity\ArticleRepository;
use Blog\AdminBundle\Entity\CategoryRepository;
use Blog\AdminBundle\Entity\TagRepository;
use Blog\AdminBundle\Entity\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends Controller
{
    /**
     * @Route("/article/{id}", name="api_pokemon", defaults={"id" = null}, requirements={"id" =  "\d+"})
     */
    public function articleAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        //var_dump($id);die;
        /** @var ArticleRepository $repo */
        $repo = $em->getRepository('BlogAdminBundle:Article');
        $article = $repo->findCatchThemAll($id);
        return new JsonResponse($article);
    }
    /**
     * @Route("/category/{id}", name="api_trainer", defaults={"id" = null}, requirements={"id" =  "\d+"})
     */
    public function trainerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        //var_dump($id);die;
        /** @var CategoryRepository $repo */
        $repo = $em->getRepository('BlogAdminBundle:Ctaegory');
        $category = $repo->findCatchThemAll($id);
        return new JsonResponse($category);
    }
    /**
     * @Route("/tag/{id}", name="api_tag", defaults={"id" = null}, requirements={"id" =  "\d+"})
     */
    public function tagAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        //var_dump($id);die;
        /** @var TagRepository $repo */
        $repo = $em->getRepository('BlogAdminBundle:Tag');
        $tag = $repo->findCatchThemAll($id);
        return new JsonResponse($tag);
    }
    /**
     * @Route("/user/{id}", name="api_tag", defaults={"id" = null}, requirements={"id" =  "\d+"})
     */
    public function userAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        //var_dump($id);die;
        /** @var UserRepository $repo */
        $repo = $em->getRepository('BlogAdminBundle:User');
        $tag = $repo->findCatchThemAll($id);
        return new JsonResponse($tag);
    }
}
