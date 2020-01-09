<?php
namespace Me\EventBUndle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Me\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUsers implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUserName('darth');
        $user1->setPassword($this->encodePassword($user1, 'password'));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUserName('Rebellion');
        $user2->setPassword($this->encodePassword($user2, 'password'));
        $manager->persist($user2);

        //the queries are not done until now
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function encodePassword(User $user, $plainPassword)
    {
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);

        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }
}
?>