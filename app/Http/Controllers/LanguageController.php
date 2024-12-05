<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        // dump($lang);
        if (array_key_exists($lang, LaravelLocalization::getSupportedLocales())) {
            // dd($lang);
            LaravelLocalization::setLocale($lang);
            session(['locale' => $lang]);
        }

        // redirect to current page with new locale
        Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
