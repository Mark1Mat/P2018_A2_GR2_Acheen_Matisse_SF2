<?php

namespace Blog\AdminBundle\Listener;


use Blog\AdminBundle\Entity\Article;
use Doctrine\ORM\Event\LifecycleEventArgs;

class articleListener
{
    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Article)
        {
            $entity->setCreatedAt(new \DateTime());
            $entity->setUpdatedAt(new \DateTime());
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public  function  preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if($entity instanceof Article)
        {
            $entity->setUpdatedAt(new \DateTime());
        }
    }
}