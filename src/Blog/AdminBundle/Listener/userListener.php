<?php

namespace Blog\AdminBundle\Listener;


use Blog\AdminBundle\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;

class userListener
{
    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User)
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

        if($entity instanceof User)
        {
            $entity->setUpdatedAt(new \DateTime());
        }
    }
}