<?php

namespace Tests\Unit;

use App\Services\DistanceService;
use Tests\TestCase;

class DistanceServiceTest extends TestCase
{
    private DistanceService $service;

    protected function setUp(): void
    {
        parent::setUp();
        // Store location: Dalung, Bali (-8.6577, 115.2254)
        $this->service = new DistanceService(-8.6577, 115.2254);
    }

    public function test_calculates_distance_within_5km(): void
    {
        // Location approximately 3km from store
        $distance = $this->service->calculate(-8.6420, 115.2350);
        $this->assertLessThanOrEqual(5, $distance);
    }

    public function test_calculates_distance_beyond_5km(): void
    {
        // Location approximately 8km from store
        $distance = $this->service->calculate(-8.5800, 115.2800);
        $this->assertGreaterThan(5, $distance);
    }

    public function test_rejects_invalid_latitude(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->calculate(91, 115.2254);
    }

    public function test_rejects_invalid_longitude(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->service->calculate(-8.6577, 181);
    }

    public function test_is_within_delivery_radius_returns_true(): void
    {
        $this->assertTrue($this->service->isWithinRadius(-8.6420, 115.2350, 5));
    }

    public function test_is_within_delivery_radius_returns_false(): void
    {
        $this->assertFalse($this->service->isWithinRadius(-8.5800, 115.2800, 5));
    }

    public function test_zero_distance_for_same_location(): void
    {
        $distance = $this->service->calculate(-8.6577, 115.2254);
        $this->assertEquals(0, $distance);
    }
}