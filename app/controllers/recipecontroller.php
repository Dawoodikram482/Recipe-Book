<?php

namespace controllers;
session_start();
use config\dbconfig;
use Exception;
use models\Category;
use Recipe;
use services\recipeservice;
use services\userservice;
use user;
require_once __DIR__ . '/../services/userservice.php';
require_once __DIR__ . '/../services/recipeservice.php';
require_once __DIR__ . '/../models/Recipe.php';
require_once __DIR__ . '/../models/Category.php';

class recipecontroller
{
    private $databaseConnection;
    private $userservice;
    private $recipeservice;

    public function __construct()
    {
        $this->userservice = new userservice();
        $this->recipeservice = new recipeservice();
    }

    public function getRecipeByCategory(Category $category)
    {
        $recipes = $this->recipeservice->getRecipeByCategory($category);
        return $recipes;
    }

//    public function createRecipe($title, $ingredients, $steps, $image, $category)
//    {
//        try {
//            $result = $this->recipeservice->createRecipe($title, $ingredients, $steps, $image, $category);
//
//            if ($result) {
//                header('Location: /');
//                exit;
//            } else {
//                $errorMessage = "Failed to create recipe";
//                require __DIR__ . '/../views/createrecipepage.php';
//            }
//
//            return $result;
//        } catch (Exception $e) {
//            error_log("Error in createRecipe: " . $e->getMessage());
//            $errorMessage = "An unexpected error occurred";
//            require __DIR__ . '/../views/createrecipepage.php';
//            return false;
//        }
//    }
//    public function editRecipe($recipeId, $title, $ingredients, $steps, $image, $category)
//    {
//        try {
//            $result = $this->recipeservice->updateRecipe($recipeId, $title, $ingredients, $steps, $image, $category);
//
//            if ($result) {
//                header('Location: /');
//                exit;
//            } else {
//                $errorMessage = "Failed to update recipe";
//                require __DIR__ . '/../views/editrecipe.php';
//            }
//
//            return $result;
//        } catch (Exception $e) {
//            error_log("Error in editRecipe: " . $e->getMessage());
//            $errorMessage = "An unexpected error occurred";
//            require __DIR__ . '/../views/editrecipe.php';
//            return false;
//        }
//
//    }
    public function processImage($image)
    {
        if ($image['error'] == UPLOAD_ERR_OK) {
            $imageType = $image['type'];

            // Validate the image file
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($imageType, $allowedTypes)) {
                return array(
                    "success" => false,
                    "message" => "This type of image file are not accepted"
                );
            } else {
                return array(
                    "success" => true,
                    "message" => ""
                );
            }
        } else {
            return array(
                "success" => false,
                "message" => "Something went Wrong while uploading image"
            );
        }
    }
    public function getImagePath($recipeId)
    {
        $imagePath = $this->recipeservice->getImagePath($recipeId);
        return $imagePath;
    }
    public function showRecipes()
    {
        $recipes = $this->recipeservice->getAllRecipes();
        return $recipes;
    }

    public function showLatestRecipe()
    {
        $recipe = $this->recipeservice->getLatestRecipe();
        return $recipe;
    }

    public function showbreakfastPage(): void
    {
        $pageTitle = "Breakfast";
//        $recipes = $this->recipeservice->getRecipeByCategory(Category::Breakfast);
        require '../views/breakfastpage.php';
    }

    public function showlunchPage(): void
    {
        $pageTitle = "Lunch";
//        $recipes = $this->recipeservice->getRecipeByCategory(Category::Lunch);
        require '../views/lunchpage.php';
    }

    public function showdinnerPage(): void
    {
        $pageTitle = "Dinner";
//        $recipes = $this->recipeservice->getRecipeByCategory(Category::Dinner);
        require '../views/dinnerpage.php';
    }

    public function showCreateRecipePage(): void
    {
        $pageTitle = "Create Recipe";
        require '../views/createrecipepage.php';
    }

    public function showEditRecipePage(): void
    {
        $id = $_GET['id'];
        $recipe = $this->recipeservice->getRecipeById($id);
        $pageTitle = "Edit Recipe";
        require '../views/editrecipe.php';
    }

    public function getLatestRecipe($lastRecipeId)
    {
        $recipe = $this->recipeservice->getLatestRecipe($lastRecipeId);
        return $recipe;
    }


}