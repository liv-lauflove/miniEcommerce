<?php

namespace App\Services;

/**
 * Pattern: Singleton
 * Tipe: Creational (Pembuatan Objek)
 *
 * Penjelasan:
 * Singleton memastikan bahwa class ini hanya memiliki satu instance (objek) tunggal
 * dan menyediakan titik akses global ke instance tersebut melalui getInstance().
 * DistanceService cocok menggunakan Singleton karena:
 * - Koordinat toko tidak berubah selama runtime
 * - Kalkulasi Haversine adalah fungsi pure (stateless setelah inisialisasi)
 * - Menghemat memory — tidak perlu instance baru di setiap controller
 *
 * Referensi: humadev/design_pattern - gof/01_singleton.ts
 */
class DistanceService
{
    // 1. Simpan instance tunggal secara private dan static
    private static ?DistanceService $instance = null;

    private float $storeLat;

    private float $storeLng;

    // 2. Buat constructor menjadi private agar tidak bisa di-instantiate dari luar class
    private function __construct(float $storeLat, float $storeLng)
    {
        $this->storeLat = $storeLat;
        $this->storeLng = $storeLng;
    }

    // Prevent cloning of the instance
    private function __clone() {}

    // Prevent unserialization of the instance
    public function __wakeup()
    {
        throw new \RuntimeException('Cannot unserialize a singleton.');
    }

    // 3. Sediakan method static untuk mendapatkan instance tunggal
    // Jika instance belum ada, buat baru. Jika sudah, kembalikan yang ada.
    public static function getInstance(): DistanceService
    {
        if (self::$instance === null) {
            $storeLat = config('store.latitude');
            $storeLng = config('store.longitude');

            if ($storeLat === null || $storeLng === null) {
                throw new \RuntimeException(
                    'Store coordinates not configured. Set STORE_LATITUDE and STORE_LONGITUDE in .env'
                );
            }

            self::$instance = new self((float) $storeLat, (float) $storeLng);
        }

        return self::$instance;
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
