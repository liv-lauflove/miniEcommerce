<?php

namespace App\Services;

class DistanceService
{
    private ?float $storeLat = null;
    private ?float $storeLng = null;

    public function __construct(?float $storeLat = null, ?float $storeLng = null)
    {
        $this->storeLat = $storeLat ?? config('store.latitude');
        $this->storeLng = $storeLng ?? config('store.longitude');

        if ($this->storeLat === null || $this->storeLng === null) {
            throw new \RuntimeException('Store coordinates not configured. Set STORE_LATITUDE and STORE_LONGITUDE in .env');
        }

        $this->storeLat = (float) $this->storeLat;
        $this->storeLng = (float) $this->storeLng;
    }

    /**
     * Calculate distance using Haversine formula
     * Returns distance in kilometers
     */
    public function calculate(float $lat, float $lng): float
    {
        $this->validateCoordinates($lat, $lng);

        $earthRadius = 6371;

        $latFrom = deg2rad($this->storeLat);
        $lngFrom = deg2rad($this->storeLng);
        $latTo = deg2rad($lat);
        $lngTo = deg2rad($lng);

        $latDelta = $latTo - $latFrom;
        $lngDelta = $lngTo - $lngFrom;

        $a = sin($latDelta / 2) ** 2 +
             cos($latFrom) * cos($latTo) * sin($lngDelta / 2) ** 2;

        $c = 2 * asin(sqrt($a));

        return round($earthRadius * $c, 2);
    }

    /**
     * Check if coordinates are within delivery radius
     */
    public function isWithinRadius(float $lat, float $lng, ?float $radiusKm = null): bool
    {
        $radius = $radiusKm ?? config('store.delivery_radius_km', 5);
        return $this->calculate($lat, $lng) <= $radius;
    }

    private function validateCoordinates(float $lat, float $lng): void
    {
        if ($lat < -90 || $lat > 90) {
            throw new \InvalidArgumentException('Invalid latitude: must be between -90 and 90');
        }

        if ($lng < -180 || $lng > 180) {
            throw new \InvalidArgumentException('Invalid longitude: must be between -180 and 180');
        }
    }
}