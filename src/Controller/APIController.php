<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    
    /**
     * @Route("/api")
     */
    class APIController extends Controller{
        /**
         * @Route("/", name="welcome_API")
         */
        public function welcome() {
            return new Response('<p>Welcome to recipe API</p>');
        }
    }
