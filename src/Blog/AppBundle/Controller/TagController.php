<?php
/**
 * Created by PhpStorm.
 * User: Steeve Jerent
 * Date: 04/04/2015
 * Time: 19:55
 */

namespace Blog\AppBundle\Controller;

use Blog\AdminBundle\Entity\ArticleRepository;
use Blog\AdminBundle\Entity\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TagController extends Controller{
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