<?php

namespace App\Tests\Service\Solds;

use App\Entity\Sold;
use App\Repository\SoldRepository;
use App\Service\Solds\GetSoldService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetSoldServiceTest extends TestCase
{
    public function testInvoke(): void
    {
        $soldRepository = $this->createMock(SoldRepository::class);
        $soldRepository->method('findAll')->willReturn([]);

        $service = new GetSoldService($soldRepository);
        $response = $service->__invoke();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('success', $data);
        $this->assertTrue($data['success']);
        $this->assertArrayHasKey('data', $data);
        $this->assertIsArray($data['data']);
    }

    public function testInvokeWithEmptyData(): void
    {
        $soldRepository = $this->createMock(SoldRepository::class);
        $soldRepository->method('findAll')->willReturn([]);

        $service = new GetSoldService($soldRepository);
        $response = $service->__invoke();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('success', $data);
        $this->assertTrue($data['success']);
        $this->assertArrayHasKey('data', $data);
        $this->assertIsArray($data['data']);
        $this->assertEmpty($data['data']);
    }

    public function testInvokeWithData(): void
    {
        $soldMock = $this->createMock(Sold::class);
        $soldMock->method('toArray')->willReturn(['id' => 1, 'product' => 'Test Product']);

        $soldRepository = $this->createMock(SoldRepository::class);
        $soldRepository->method('findAll')->willReturn([$soldMock]);

        $service = new GetSoldService($soldRepository);
        $response = $service->__invoke();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('success', $data);
        $this->assertTrue($data['success']);
        $this->assertArrayHasKey('data', $data);
        $this->assertIsArray($data['data']);
        $this->assertNotEmpty($data['data']);
        $this->assertEquals([[['id' => 1, 'product' => 'Test Product']]], $data['data']);
    }

    public function testInvokeWithException(): void
    {
        $soldRepository = $this->createMock(SoldRepository::class);
        $soldRepository->method('findAll')->willThrowException(new \Exception('Database error'));

        $service = new GetSoldService($soldRepository);

        $this->expectException(\Exception::class);
        $service->__invoke();
    }


}