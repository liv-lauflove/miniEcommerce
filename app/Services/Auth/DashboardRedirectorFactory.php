<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Http\RedirectResponse;

/**
 * Factory Method Pattern — Creator (Abstract)
 * Tipe: Creational (Pembuatan Objek)
 *
 * Penjelasan:
 * Factory Method adalah design pattern yang menyediakan interface atau abstract class
 * untuk membuat objek di superclass, namun mengizinkan subclass untuk mengubah tipe
 * objek yang akan dibuat.
 *
 * Class abstrak ini mendefinisikan Factory Method (createRedirector) yang harus
 * diimplementasikan oleh subclass. Method redirect() adalah operasi utama yang
 * menggunakan product tanpa perlu tahu jenisnya.
 *
 * Referensi: humadev/design_pattern - gof/02_factory_method.ts
 * Setara dengan: abstract class Logistics {
 *     abstract createTransport(): Transport;
 *     public planDelivery(): void { ... }
 * }
 */
abstract class DashboardRedirectorFactory
{
    // Factory method (metode pembuatan) yang harus diimplementasikan oleh subclass
    abstract public function createRedirector(string $role): DashboardRedirectorInterface;

    // Operasi utama yang menggunakan redirector tanpa perlu tahu jenisnya
    public function redirect(User $user): RedirectResponse
    {
        // Memanggil factory method untuk membuat redirector sesuai role
        $redirector = $this->createRedirector($user->role);

        return $redirector->redirect($user);
    }
}
