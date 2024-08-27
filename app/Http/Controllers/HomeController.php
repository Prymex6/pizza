<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;

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
}
