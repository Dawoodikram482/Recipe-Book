<?php

namespace controllers\api;
use controllers\recipecontroller;
use Exception;
use models\Category;
use services\recipeservice;



require_once __DIR__ . '/../../controllers/recipecontroller.php';
require_once __DIR__ . '/../../services/recipeservice.php';

class fetchApi
{
    private $recipeservice;

    public function __construct()
    {
        $this->recipeservice = new recipeservice();
    }

    public function fetch()
    {
        try {
            $category = htmlspecialchars($_GET['category'], ENT_QUOTES, 'UTF-8');
            $categoryEnum = Category::createFrom($category);
            $recipes = $this->recipeservice->getRecipeByCategory($categoryEnum);

            echo json_encode($recipes);
        } catch
        (Exception $e) {
            echo json_encode($e->getMessage());
            error_log($e->getMessage(), __DIR__ . "/../Errors/error.log");
        }
    }
}
