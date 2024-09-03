<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Dish;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with(['dishes' => function ($query) {
            $query->limit(10);
        }])->get();

        $dishes = Dish::limit(20)->get();

        $settings = settings();

        return view('home.index', ['categories' => $categories, 'dishes' => $dishes, 'settings' => $settings]);
    }

    /**
     * Display a listing of the resource.
     */
    public function menu()
    {
        $categories = Category::with(['dishes' => function ($query) {
            $query->limit(10);
        }])->get();

        $dishes = Dish::limit(20)->get();

        $settings = settings();

        return view('home.menu', ['categories' => $categories, 'dishes' => $dishes, 'settings' => $settings]);
    }

    /**
     * Display a listing of the resource.
     */
    public function about()
    {
        $settings = settings();

        return view('home.about', ['settings' => $settings]);
    }

    /**
     * Display a listing of the resource.
     */
    public function reservation()
    {
        $settings = settings();

        return view('home.reservation', ['settings' => $settings]);
    }

    public function size(Request $request)
    {
        $dish = Dish::with(['category', 'sizes'])->findOrFail($request->dish_id);

        dd($dish);
    }
}
