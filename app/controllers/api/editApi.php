<?php

namespace controllers\api;

use controllers\recipecontroller;
use services\recipeservice;

require_once __DIR__ . '/../../controllers/recipecontroller.php';
require_once __DIR__ . '/../../services/recipeservice.php';

class editApi
{
    private $recipeservice;
    private $recipecontroller;

    public function __construct()
    {
        $this->recipeservice = new recipeservice();
        $this->recipecontroller = new recipecontroller();
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recipeDetails = json_decode($_POST['recipeDetails'], true);

            $title = htmlspecialchars($recipeDetails['title']);
            $ingredients = htmlspecialchars($recipeDetails['ingredients']);
            $steps = htmlspecialchars($recipeDetails['preparationSteps']);
            $category = htmlspecialchars($recipeDetails['category']);
            $recipeId = htmlspecialchars($recipeDetails['recipeId']);
            $responseData = [];

            if (isset($_FILES['recipeImage']) && !empty($_FILES['recipeImage']['name'])) {
                $image = $_FILES['recipeImage'];
                $responseData = $this->recipecontroller->processImage($image);

                if (!$responseData['success']) {
                    echo json_encode($responseData);
                    return;
                }

                $imagetempname = $image['tmp_name'];
                $imagename = $image['name'];
                $targetDirectory = "images/";
                $imageExtension = explode('.', $imagename);
                $imageNewName = "recipe_book" . end($imageExtension);

                $result = $this->recipeservice->updateRecipe($recipeId, $title, $ingredients, $steps, $imageNewName, $category);

                if ($result) {
                    $uploadSuccess = move_uploaded_file($imagetempname, $targetDirectory . $imageNewName);
                    if (!$uploadSuccess) {
                        $responseData = [
                            "success" => false,
                            "message" => "Something went wrong while processing your uploaded image"
                        ];
                    } else {
                        $responseData = [
                            "success" => true,
                            "message" => "Recipe edited successfully"
                        ];
                    }
                } else {
                    $responseData = [
                        "success" => false,
                        "message" => "Something went wrong while editing recipe"
                    ];
                }
            } else {

                $existingImagePath = $this->recipecontroller->getImagePath($recipeId);

                $result = $this->recipeservice->updateRecipe($recipeId, $title, $ingredients, $steps, $existingImagePath, $category);

                if ($result) {
                    $responseData = [
                        "success" => true,
                        "message" => "Recipe edited successfully"
                    ];
                } else {
                    $responseData = [
                        "success" => false,
                        "message" => "Something went wrong while editing recipe"
                    ];
                }
            }

            $resultjson = json_encode($responseData);
            echo $resultjson;
        }
    }

}

