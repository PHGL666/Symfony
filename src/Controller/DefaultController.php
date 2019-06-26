<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        /* dump($articles); */

        return $this->render("default/homepage.html.twig", [
            "articles" => $articles
        ]);
    }

    public function navCategory()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();

        return $this->render("default/_navcategory.html.twig", [
           "categories" => $categories
        ]);
    }

    public function navTag()
    {
        $tags = $this->getDoctrine()->getRepository(Tag::class)->findAll();

        return $this->render("default/_navtag.html.twig", [
            "tags" => $tags
        ]);
    }
}
