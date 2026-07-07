<?php

namespace App\Services\Auth\Redirectors;

use App\Models\User;
use App\Services\Auth\DashboardRedirectorInterface;
use Illuminate\Http\RedirectResponse;

/**
 * Factory Method Pattern — Concrete Product
 *
 * Implementasi spesifik untuk redirect User biasa.
 *
 * Referensi: humadev/design_pattern - gof/02_factory_method.ts
 * Setara dengan concrete product tambahan
 */
class UserRedirector implements DashboardRedirectorInterface
{
    public function redirect(User $user): RedirectResponse
    {
        return redirect()->intended('/user/dashboard');
    }
}
