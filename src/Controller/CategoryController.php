<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;

class CategoryController extends AbstractController
{
    /**
 * @Route("/category/{id}", name="category_show", requirements={"id"="\d+"}, methods={"GET"})
 */
    public function show(Category $category)
    {
        return $this->render('category/show.html.twig', [
            'category' => $category
        ]);
    }
}
