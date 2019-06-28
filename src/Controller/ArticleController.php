<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\ArticleType;
use App\Service\Slugger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/new", name="article_new")
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, Slugger $slugger)
    {
        /*soit dans la route @IsGranted ou bien la ligne suivante ici :
         * $this->denyAccessUnlessGranted('ROLE_ADMIN');*/

        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $pictureFile */
            $pictureFile = $form["pictureFile"]->getData();

            if ($pictureFile){
                $filename = uniqid() . "." . $pictureFile->guessClientExtension();
                $pictureFile->move($this->getParameter("upload_dir"), $filename);
                $article->setPicture($filename);
            }

            $article->setSlug($slugger->slugify($article->getTitle()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute("article_show", ["slug" => $article->getSlug()]);
        }

        return $this->render('article/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/article/{slug}", name="article_show", methods={"GET"})
     */
    public function show(Article $article)
    {
        $comments = $this->getDoctrine()->getRepository(Comment::class)->findBy(['article' => $article], ['createdAt' => 'DESC']);

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'comments' => $comments
        ]);
    }
}
