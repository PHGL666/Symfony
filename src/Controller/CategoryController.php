<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/new", name="category_new")
     */
    public function new(Request $request)
    {
        // Créer un nouvel objet Category
        $category = new Category();
        $category->setLabel("test");

        // Créer le formulaire pour ajouter une nouvelle Category
        $form = $this->createForm(CategoryType::class, $category);

        // Mettre à jour le formulaire si celui-ci a été envoyé
        $form->handleRequest($request);

        // Vérifier si le formulaire a été envoyé et s'il est valide
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData(); // Récupérer les données du formulaire dans l'objet Category

            // Enregistrer en base de données
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this ->redirectToRoute('homepage');
        }

        $categories = $this->getDoctrine()->getRepository(Category::class)->findBy([], ['label' => 'ASC']);

        return $this->render("category/new.html.twig", [
            'form' => $form->createView(),
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/{id}", name="category_show")
     */
    public function show(Category $category)
    {
        return $this->render('category/show.html.twig', [
            'category' => $category
        ]);
    }
    /**
     * @Route("/{id}/edit", name="category_edit", methods={"GET", "POST"})
     */
    public function edit(Category $category, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();// Récupérer les données du formulaire dans l'objet Category

            // Enregister en base de données
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('category_new');
        }

        return $this->render("category/edit.html.twig", [
            'form' => $form->createView(),
            'category' => $category
        ]);
    }
}