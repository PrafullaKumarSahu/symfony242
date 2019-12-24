<?php
namespace Me\EventBUndle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Me\EventBundle\Entity\Event;

class LoadEvents implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $event1 = new Event();
        $event1->setName('Darth\'s Birthday Party!');
        $event1->setDescription('Deathstar is the event location, please comeand join us.');
        $manager->persist($event1);

        $event2 = new Event();
        $event2->setName('Rebellion Fundraiser Bake Sale!');
        $event2->setDescription('SAle is on Endor location.');
        $manager->persist($event2);

        //the queries are not done until now
        $manager->flush();
    }
}
?>