<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductoControllerTest extends WebTestCase
{

    //Prueba funcional
    public function testGetProductos(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/product/list');

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());
    }


}