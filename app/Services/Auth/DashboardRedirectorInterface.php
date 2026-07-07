<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Http\RedirectResponse;

/**
 * Factory Method Pattern — Product Interface
 *
 * Interface dari produk (Product) yang akan dibuat oleh Factory.
 * Setiap redirector harus mengimplementasikan method redirect().
 *
 * Referensi: humadev/design_pattern - gof/02_factory_method.ts
 * Setara dengan: interface Transport { deliver(): void; }
 */
interface DashboardRedirectorInterface
{
    public function redirect(User $user): RedirectResponse;
}
