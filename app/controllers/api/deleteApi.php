<?php
namespace controllers\api;
use controllers\recipecontroller;
use Exception;
use services\recipeservice;

require_once __DIR__ . '/../../controllers/recipecontroller.php';
require_once __DIR__ . '/../../services/recipeservice.php';
class deleteApi
{
    private $recipeService;

    public function __construct()
    {
        $this->recipeService = new recipeservice();
    }
    public function delete(){
        $recipeId = filter_input(INPUT_GET, 'RecipeId', FILTER_SANITIZE_NUMBER_INT);

        try {
            $result = $this->recipeService->deleteRecipe($recipeId);

            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to delete recipe']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}

