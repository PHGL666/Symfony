<?php

namespace App\Controller;

use App\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{id}", name="article_show", requirements={"id"="\d+"}, methods={"GET"})
     */

/*
    public function show(int $id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

en utilisant le param converter on remplace (int $id) par (Article $article) et on supprime la ligne de code qui appelle doctrine.
*/
    public function show(Article $article)
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }
}
