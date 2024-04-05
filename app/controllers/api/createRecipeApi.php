<?php
namespace controllers\api;
use controllers\recipecontroller;
use services\recipeservice;

require_once __DIR__ . '/../../controllers/recipecontroller.php';
require_once __DIR__ . '/../../services/recipeservice.php';
class createRecipeApi
{
    private $recipeController;
    private $recipeservice;

    public function __construct()
    {
        $this->recipeController = new recipecontroller();
        $this->recipeservice = new recipeservice();
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $recipeDetails = json_decode($_POST['recipeDetails'], true);

            $title = htmlspecialchars($recipeDetails['title']);
            $ingredients = htmlspecialchars($recipeDetails['ingredients']);
            $steps = htmlspecialchars($recipeDetails['preparationSteps']);
            $category = htmlspecialchars($recipeDetails['category']);

            $image = $_FILES['image'];
            $responseData = $this->recipeController->processImage($image);

            if ($responseData['success']) {
                $imagetempname = $image['tmp_name'];
                $imagename = $image['name'];
                $targetDirectory = "images/";
                $imageExtension = pathinfo($imagename, PATHINFO_EXTENSION);
                $imageNewName =  "recipe_book_" . uniqid() . "." . $imageExtension;

                $result = $this->recipeservice->createRecipe($title, $ingredients, $steps, $imageNewName, $category);

                if ($result) {
                    $uploadSuccess = move_uploaded_file($imagetempname, $targetDirectory. $imageNewName);
                    if (!$uploadSuccess) {
                        $responseData = array(
                            "success" => false,
                            "message" => "Something went Wrong while processing your uploaded image"
                        );
                    }
                } else {
                    $responseData = array(
                        "success" => false,
                        "message" => "Something went Wrong while creating recipe"
                    );
                }
            }
            $resultjson = json_encode($responseData);
            echo $resultjson;
        }
    }
}