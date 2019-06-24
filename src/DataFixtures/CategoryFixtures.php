<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $devweb = new Category();
        $devweb->setLabel("Développement web");
        $manager->persist($devweb);

        $design = new Category();
        $design->setLabel("Design");
        $manager->persist($design);

        $bdd = new Category();
        $bdd->setLabel("Base de données");
        $manager->persist($bdd);

        $manager->flush();
    }
}
