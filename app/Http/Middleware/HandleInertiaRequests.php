<?php

namespace App\Http\Middleware;

use App\Http\Resources\UserResource;
use App\Models\User;
use Inertia\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user() ? UserResource::make($request->user()) : null,
                'isLoggedIn' => $request->user() !== null,
                'roles' => $request->user()?->roles->pluck('name'),
            ],
            'flash' => [
                'success' => fn() => $request->session()->get('success'),
                'error' => fn() => $request->session()->get('error'),
            ],
            'app' => [
                'name' => config('app.name'),
                'url' => config('app.url'),
            ],
            'settings' => [
                // spatie settings
            ],
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'currentLocale' => LaravelLocalization::getCurrentLocale(),
            'locales' => LaravelLocalization::getSupportedLocales(),
            'dir' => LaravelLocalization::getCurrentLocaleDirection(),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ];
    }
}
