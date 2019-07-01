<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Service\Slugger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{

    private $slugger;

    /**
     * ArticleFixtures constructor.
     * @param $slugger
     */
    public function __construct(Slugger $slugger)
    {
        $this->slugger = $slugger;
    }


    public function load(ObjectManager $manager)
    {
        $article1 = new Article();
        $article1->setTitle("Nouvelle version de PHP");
        $article1->setSlug($this->slugger->slugify($article1->getTitle()));
        $article1->setPicture("php.png");
        $article1->setContent("Lorem ipsum...");
        $article1->setCategory($this->getReference("cat-devweb"));
        $article1->addTag($this->getReference("tag-PHP"));
        $article1->setUser($this->getReference("user-admin"));
        $manager->persist($article1);
        $this->setReference("article-1", $article1);

        $article2 = new Article();
        $article2->setTitle("Créer un site en PHP");
        $article2->setSlug($this->slugger->slugify($article2->getTitle()));
        $article2->setPicture("siteweb.png");
        $article2->setContent("Tuto pour créer un site en PHP...");
        $article2->setCategory($this->getReference("cat-devweb"));
        $article2->addTag($this->getReference("tag-PHP"));
        $article2->addTag($this->getReference("tag-CSS"));
        $article2->addTag($this->getReference("tag-HTML"));
        $article2->addTag($this->getReference("tag-MySQL"));
        $article2->setUser($this->getReference("user-john"));
        $manager->persist($article2);
        $this->setReference("article-2", $article2);

        $article3 = new Article();
        $article3->setTitle("Tuto Photoshop");
        $article3->setSlug($this->slugger->slugify($article3->getTitle()));
        $article3->setPicture("photoshop.png");
        $article3->setContent("Ouvrir le logiciel Photoshop...");
        $article3->setCategory($this->getReference("cat-design"));
        $article3->setUser($this->getReference("user-john"));
        $manager->persist($article3);
        $this->setReference("article-3", $article3);

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            TagFixtures::class,
            UserFixtures::class
        ];
    }
}