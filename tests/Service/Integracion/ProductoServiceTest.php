<?php

namespace App\Tests\Service\Integracion;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductoServiceTest extends KernelTestCase
{
    //Prueba Unitaria
//    public function testCreateProducto(): void
//    {
//        self::bootKernel();
//
//        $productRepository = self::$container->get(ProductRepository::class);
//        $productRepository->save(new Product('1','productoPrueba',10,15,45));
//        $product = $productRepository->findOneByCod('1');
//        $this->assertInstanceOf(Product::class, $product);
//        $this->assertEquals('productoPrueba', $product->getName());
//        $this->assertEquals('1', $product->getCodigo());
//    }

    Prueba de Integracion
    public function testProductoPersistedInDatabase(): void
    {
        self::bootKernel();

        $productRepo = self::$container->get(ProductRepository::class);
        $producto = $productRepo->findOneByCod( '1234567');

        $this->assertNotNull($producto);
        $this->assertEquals('productoPrueba', $producto->getName());
    }
}