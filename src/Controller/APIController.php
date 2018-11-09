<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\Routing\Annotation\Route;
    use FOS\RestBundle\Controller\Annotations as REST;
    use FOS\RestBundle\Controller\FOSRestController;
    use Symfony\Component\Config\Definition\Exception\Exception;
    use Swagger\Annotations as SWAG;
    use GuzzleHttp\Client;
    
    /**
     * @Route("/api")
     */
    class APIController extends FOSRestController{
        /**
         * @Route("/", name="welcome_API")
         */
        public function welcome() {
            return new Response('<p>Welcome to recipe API</p>');
        }
        
        /**
         * @REST\Get("/recipe/search/{query}", name="recipe_search_query_API", defaults={"_format": "json"})
         *
         * @SWAG\Parameter(name="query", in="path", type="string")
         */
        public function searchRecipeQuery($query) {
            $urlAPI = 'http://www.recipepuppy.com/api/?q=' . $query;
            $guzClient = new Client;
            $queryStatus = 200;
            $queryMessage = 'Results for query: - ' . $query . ' -';
            $recipes = [];
            try {
                $guzRequest = $guzClient->request('GET', $urlAPI);
                $serviceResponse = json_decode($guzRequest->getBody()->getContents(), true);
                $recipes = $serviceResponse['results'];
            } catch(Exception $queryException) {
                $queryStatus = 500;
                $queryMessage = 'Request error';
            }
            $searchResponse = [
                'status' => $queryStatus,
                'message' => $queryMessage,
                'data' => $recipes
                
            ];
            return new JsonResponse($searchResponse);
        }
    }
