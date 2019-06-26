<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/new", name="category_new")
     */
    public function new(Request $request)
    {
        // Créer un nouvel objet Category
        $category = new Category();
        $category->setLabel("test");

        // Créer le formualaire pour ajouter une nouvelle Category
        $form = $this->createForm(CategoryType::class, $category);

        // Mettre à jour le formulaire si celui-ci a été envoyé
        $form->handleRequest($request);

        // Vérifier si le formulaire a été envoyé et si il est valide
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData(); // Récupérer les données du formulaire dans l'objet Category

            // Enregistrer en base de données
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this ->redirectToRoute('homepage');
        }

        return $this->render("category/new.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_show")
     */
    public function show(Category $category)
    {
        return $this->render('category/show.html.twig', [
            'category' => $category
        ]);
    }

}