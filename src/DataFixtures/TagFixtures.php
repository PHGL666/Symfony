<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Tag;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tags = ["PHP", "Javascript", "CSS", "HTML", "MySQL", "MongoDB"];

        foreach ($tags as $tagName) {
            $tag = new Tag();
            $tag->setLabel($tagName);
            $manager->persist($tag);
        }

        $manager->flush();
    }
}
