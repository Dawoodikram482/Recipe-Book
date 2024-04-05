<?php

namespace routers;

use controllers\api\deleteApi;
use controllers\api\editApi;
use controllers\api\fetchApi;
use controllers\recipecontroller;
use controllers\usercontroller;
use controllers\api\createRecipeApi;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../controllers/usercontroller.php';
require_once __DIR__ . '/../controllers/recipecontroller.php';
require_once __DIR__ . '/../controllers/api/createRecipeApi.php';
require_once __DIR__ . '/../controllers/api/fetchApi.php';
require_once __DIR__ . '/../controllers/api/deleteApi.php';
require_once __DIR__ . '/../controllers/api/editApi.php';

class router
{
    public function route($uri)
    {
        $uri = $this->stripParameters($uri);

        switch ($uri) {
            case '':
            case 'logout':
            case 'login':
                $controller = new usercontroller();
                $controller->showLoginPage();
                break;
            case 'homepage':
                $controller = new usercontroller();
                $controller->showHomePage();
                break;
            case 'breakfastpage':
                $controller = new recipecontroller();
                $controller->showbreakfastPage();
                break;
            case 'lunchpage':
                $controller = new recipecontroller();
                $controller->showlunchPage();
                break;
            case 'dinnerpage':
                $controller = new recipecontroller();
                $controller->showdinnerPage();
                break;
            case 'createrecipepage':
                $controller = new recipecontroller();
                $controller->showCreateRecipePage();
                break;
            case 'editrecipe':
                $controller = new recipecontroller();
                $controller->showEditRecipePage();
                break;
            case 'loginAction':
                $controller = new usercontroller();
                $controller->login();
                break;
            case'api/createRecipeApi/create':
                $controller = new createRecipeApi();
                $controller->create();
                break;
            case 'api/fetchApi/fetch':
                $controller = new fetchApi();
                $controller->fetch();
                break;
            case 'api/deleteApi/delete':
                $controller = new deleteApi();
                $controller->delete();
                break;
            case 'api/editApi/update':
                $controller = new editApi();
                $controller->edit();
                break;
        }
    }

    private function stripParameters($uri)
    {
        if (str_contains($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        return $uri;
    }
//    public function addRoute($uri, $controllerMethod)
//    {
//        $this->routes[$uri] = $controllerMethod;
//    }
//    public function handleRequest()
//    {
//        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//
//        if (array_key_exists($requestUri, $this->routes) &&
//            $_SERVER['REQUEST_METHOD'] == (strpos($requestUri, 'Action') ? 'POST' : 'GET')) {
//            $controllerMethod = $this->routes[$requestUri];
//            $controller = new $controllerMethod[0]();
//            $action = $controllerMethod[1];
//            $controller->$action();
//        } else {
//            http_response_code(404);
//            echo "404 Not Found";
//        }
//    }

}
