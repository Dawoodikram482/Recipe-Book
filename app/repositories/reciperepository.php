<?php
namespace repositories;

use models\Category;
use PDOException;
use PDO;
use Recipe;

require_once __DIR__ . '/../config/dbconfig.php';
require_once __DIR__ . '/../models/Recipe.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/repository.php';
class reciperepository extends repository{
    public function getAllRecipes()
    {
        try {
            $sql = "SELECT * FROM Recipe";
            $stmt = $this->database->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Recipe::class);
            $recipes = $stmt->fetchAll();
            return $recipes;
        }catch (PDOException $e){
            echo "Error getting recipes: " . $e->getMessage();
        }
    }
    public function getRecipeById($recipeId)
    {
        try{
            $sql = "SELECT * FROM Recipe WHERE RecipeID = :recipeId";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':recipeId', $recipeId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Recipe::class);
            $recipe = $stmt->fetch();
            return $recipe;
        }catch (PDOException $e){
            error_log($e->getMessage());
            echo "Error getting recipe: " . $e->getMessage();
        }
    }
    public function getRecipeByCategory(Category $category)
    {
        try{
            $sql = "SELECT * FROM Recipe WHERE Category = :category";
            $stmt = $this->database->prepare($sql);
            $categoryValue = $category->getCategoryType();
            $stmt->bindParam(':category', $categoryValue);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Recipe::class);

            // Fetch the results and return
            $recipes = $stmt->fetchAll();
            return $recipes;
        }catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }


    public function createRecipe($title, $ingredients, $instructions, $image, $category){
        try{

            $sql = "INSERT INTO Recipe (RecipeTitle, Ingredients, Instructions, Image, Category) VALUES (:RecipeTitle, :Ingredients, :Instructions, :Image, :Category)";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':RecipeTitle', $title);
            $stmt->bindParam(':Ingredients', $ingredients);
            $stmt->bindParam(':Instructions', $instructions);
            $stmt->bindParam(':Image', $image);
            $stmt->bindParam(':Category', $category);
            return $stmt->execute();
        } catch(PDOException $e){
            error_log($e->getMessage());
            echo "Error adding recipe: " . $e->getMessage();
        }
    }
    public function getLatestRecipe()
    {
        $sql = "SELECT * FROM Recipe ORDER BY RecipeID DESC LIMIT 1";
        $stmt = $this->database->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Recipe::class);
        $recipe = $stmt->fetch();
        return $recipe;
    }
    public function deleteRecipe($recipeId)
    {
        try{
            $query = "DELETE FROM Recipe WHERE RecipeId = :recipeId";
            $stmt = $this->database->prepare($query);
            $stmt->bindParam(':recipeId', $recipeId);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            error_log($e->getMessage());
            echo "Error deleting recipe: " . $e->getMessage();
        }
    }
    public function editRecipe($recipeId, $title, $ingredients, $instructions, $image, $category){
        try{
            $sql = "UPDATE Recipe SET RecipeTitle = :RecipeTitle, Ingredients = :Ingredients, Instructions = :Instructions, Image = :Image, Category = :Category WHERE RecipeId = :RecipeId";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':RecipeTitle', $title);
            $stmt->bindParam(':Ingredients', $ingredients);
            $stmt->bindParam(':Instructions', $instructions);
            $stmt->bindParam(':Image', $image);
            $stmt->bindParam(':Category', $category);
            $stmt->bindParam(':RecipeId', $recipeId);
            return $stmt->execute();
        }catch(PDOException $e){
            error_log($e->getMessage());
            echo "Error editing recipe: " . $e->getMessage();
        }
    }
    public function getImagePath($recipeId)
    {
        try{
            $sql = "SELECT Image FROM Recipe WHERE RecipeId = :recipeId";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(':recipeId', $recipeId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $image = $stmt->fetch();
            return $image['Image'] ?? null;
        }catch (PDOException $e){
            error_log($e->getMessage());
            echo "Error getting image path: " . $e->getMessage();
        }
    }
}