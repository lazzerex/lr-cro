<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Menu::make('MainMenu', function ($menu) {
            $menu->add('Trang chủ', ['route' => 'home']);
            $menu->add('Quản trị', ['route' => ['category', 'category' => 'quan-tri']]);
            $menu->add('Marketing', ['route' => ['category', 'category' => 'marketing']]);
            $menu->add('CRM', ['route' => ['category', 'category' => 'crm']]);
            $menu->add('Bán hàng', ['route' => ['category', 'category' => 'ban-hang']]);
            $menu->add('Công nghệ', ['route' => ['category', 'category' => 'cong-nghe']]);
        });

        return $next($request);
    }
}
