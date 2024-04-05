<?php

namespace services;

use Exception;
use models\Category;
use PDO;
use Recipe;
use repositories\reciperepository;

require_once __DIR__ . '/../repositories/recipeRepository.php';

class recipeservice
{
    private $reciperepository;
    public function __construct()
    {
        $this->reciperepository = new reciperepository();
    }

    public function getAllRecipes()
    {
        return $this->reciperepository->getAllRecipes();
    }

    public function getRecipeByCategory( Category $category)
    {
        return $this->reciperepository->getRecipeByCategory($category);
    }

    public function createRecipe($title, $ingredients, $steps, $image, $category)
    {
        return $this->reciperepository->createRecipe($title, $ingredients, $steps, $image, $category);
    }
    public function getRecipeById($recipeId)
    {
        return $this->reciperepository->getRecipeById($recipeId);
    }
    public function getLatestRecipe()
    {
        return $this->reciperepository->getLatestRecipe();
    }
    public function deleteRecipe($recipeID): ?bool
    {
        return $this->reciperepository->deleteRecipe($recipeID);
    }
    public function updateRecipe($recipeId, $title, $ingredients, $steps, $image, $category){
        return $this->reciperepository->editRecipe($recipeId, $title, $ingredients, $steps, $image, $category);
    }
    public function getImagePath($recipeId){
        return $this->reciperepository->getImagePath($recipeId);
    }
}