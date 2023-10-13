<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Tests\TestCase;

class ProductsControllerTest extends TestCase
{
    private $controller;

    protected function setUp():void{
        parent::setUp();

        $this->controller = $this->app->make('App\Http\Controllers\Api\ProductController');
    }
    /**
     * A basic unit test example.
     */
    public function test_product(): void
    {
        $request = Request::create('/api/products', 'GET');
      
        $response = $this->controller->getAllProducts($request);
        echo json_encode($response);
  
        $this->assertTrue(true);
    }

    // public function test_create_product(): void
    // { 
    //     $request = Request::create('/api/products/new', 'POST');
      
    //     $response = $this->controller->addNewProduct($request);
    //     echo json_encode($response);
  
    //     $this->assertTrue(true);
    // }

    
}
