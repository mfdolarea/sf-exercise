<?php
    namespace App\Tests;

    use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
    use GuzzleHttp\Client;

    class APIControllerTest extends TestCase {
        public function testSearchRecipeQuery() {
            $urlAPI = 'http://localhost:3000/api/recipe/search/tomato';
            $guzClient = new Client;
            $guzRequest = $guzClient->request('GET', $urlAPI);
            $serviceResponse = json_decode($guzRequest->getBody()->getContents(), true);
            $this->assertArrayHasKey('status', $serviceResponse);
            $this->assertEquals(200, $guzRequest->getStatusCode());
            $this->assertArrayHasKey('data', $serviceResponse);
            $this->assertGreaterThan(0, \count($serviceResponse['data']));
            $this->assertArrayHasKey('title', $serviceResponse['data'][0]);
            $this->assertArrayHasKey('href', $serviceResponse['data'][0]);
            $this->assertArrayHasKey('ingredients', $serviceResponse['data'][0]);
            $this->assertArrayHasKey('thumbnail', $serviceResponse['data'][0]);
        }
    
        public function testCategoryRecipeQuery() {
            $urlAPI = 'http://localhost:3000/api/recipe/category/vegetarian';
            $guzClient = new Client;
            $guzRequest = $guzClient->request('GET', $urlAPI);
            $serviceResponse = json_decode($guzRequest->getBody()->getContents(), true);
            $this->assertArrayHasKey('status', $serviceResponse);
            $this->assertEquals(200, $guzRequest->getStatusCode());
            $this->assertArrayHasKey('data', $serviceResponse);
            $this->assertGreaterThan(0, \count($serviceResponse['data']));
            $this->assertArrayHasKey('title', $serviceResponse['data'][0]);
            $this->assertArrayHasKey('href', $serviceResponse['data'][0]);
            $this->assertArrayHasKey('ingredients', $serviceResponse['data'][0]);
            $this->assertArrayHasKey('thumbnail', $serviceResponse['data'][0]);
        }
    }
