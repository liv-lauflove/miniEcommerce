<?php

namespace App\Services\Auth;

use App\Services\Auth\Redirectors\AdminRedirector;
use App\Services\Auth\Redirectors\OwnerRedirector;
use App\Services\Auth\Redirectors\UserRedirector;
use InvalidArgumentException;

/**
 * Factory Method Pattern — Concrete Creator
 *
 * Subclass yang menentukan objek (redirector) apa yang akan dibuat
 * berdasarkan role user. Menambah role baru cukup tambahkan entry
 * di array $redirectors dan buat class Redirector baru.
 *
 * Referensi: humadev/design_pattern - gof/02_factory_method.ts
 * Setara dengan: class RoadLogistics extends Logistics {
 *     createTransport(): Transport { return new Truck(); }
 * }
 */
class RoleBasedRedirectorFactory extends DashboardRedirectorFactory
{
    /**
     * Registry role => redirector class
     * Menambah role baru cukup tambahkan entry di sini + buat class baru.
     */
    private array $redirectors = [
        'super_admin' => OwnerRedirector::class,
        'admin' => AdminRedirector::class,
        'user' => UserRedirector::class,
        'customer' => UserRedirector::class,
    ];

    // Implementasi factory method — membuat redirector sesuai role
    public function createRedirector(string $role): DashboardRedirectorInterface
    {
        if (! isset($this->redirectors[$role])) {
            throw new InvalidArgumentException(
                "No redirector registered for role: {$role}"
            );
        }

        $class = $this->redirectors[$role];

        return new $class;
    }
}
