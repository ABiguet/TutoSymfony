<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RecipeController extends AbstractController
{
    #[Route('/recette', name: 'recipe.index')]
    public function index(RecipeRepository $recipeRepository): Response
    {
        $recipeList = $recipeRepository->findAll();
        return $this->render('recipe/index.html.twig', [
            'controller_name' => 'RecipeController',
            'recipes' => $recipeList,
        ]);
    }

    #[Route('/recette/{slug}-{id}', name: 'recipe.show', requirements: ['id' => '\d+', 'slug' => '[a-z0-9-]+'])]
    public function show(RecipeRepository $recipeRepository, int $id): Response
    {
        $recipe = $recipeRepository->find($id);
        if (!$recipe) {
            throw $this->createNotFoundException('La recette demandée n\'existe pas');
        }
        return $this->render('recipe/show.html.twig', [
            'controller_name' => 'RecipeController',
            'recipe' => $recipe,
        ]);
    }
}
