<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function list(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/list.html.twig', [
            'categories' => $categoryRepository ->findAll(),
        ]);
    }

    #[Route('/categories/{slug}', name: 'app_category')]
    public function show(Category $category): Response
    {
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/titles/{id}', name: 'app_title')]
    public function showTitle(CategoryRepository $categoryRepository, ManagerRegistry $doctrine, int $id): Response
    {
        $arr = $categoryRepository->findByIdNew($id);

        $entityManager = $doctrine->getManager();

        $category1 = new Category();
        $category1->setTitle('vetements');
        $category1->setImagePath('ane-en-peluche.jpg');

        $entityManager->persist($category1);

        $category2 = new Category();
        $category2->setTitle('outils');
        $category2->setImagePath('ane-en-peluche.jpg');

        $entityManager->persist($category2);

        $entityManager->flush();

        $category3Array = $categoryRepository->findByTitle('outils');
        foreach ($category3Array as $element) {
            $entityManager->remove($element);
        }
        $entityManager->flush();


        return $this->render('category/title.html.twig', [
            'categories_idpage' => $arr[0],
            'categories_id' => $categoryRepository->findByIdNew(3),
        ]);


    }
}
