<?php

namespace controllers\api;

use controllers\recipecontroller;
use Exception;
use InvalidArgumentException;
use models\Category;
use services\recipeservice;

require __DIR__ . '/../../controllers/recipecontroller.php';
require __DIR__ . '/../../services/recipeservice.php';
require __DIR__ . '/../../models/Category.php';

class searchApi
{
    private $recipeService;

    public function __construct()
    {
        $this->recipeService = new recipeservice();
    }

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $searchQuery = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : '';
            if (!$searchQuery) {
                echo json_encode(['error' => 'Invalid search query']);
                return;
            }
            try {
                $searchQuery = Category::createFrom($searchQuery);
                $result = $this->recipeService->getRecipeByCategory($searchQuery);
                echo json_encode($result);
            } catch (InvalidArgumentException $e) {
                echo json_encode(['error' => $e->getMessage()]);
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        }
    }
}
