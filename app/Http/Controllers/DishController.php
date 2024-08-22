<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Category;
use App\Http\Requests\DishRequest;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::with('category')->paginate(2);

        return view('dish.index', ['dishes' => $dishes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('dish.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DishRequest $request)
    {
        $request->merge(['ingredients' => implode(',', array_filter($request->ingredients))]);

        Dish::create($request->all());

        return redirect()->route('dish.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        $categories = Category::all();

        $dish->ingredients = explode(',', $dish->ingredients);

        return view('dish.edit', ['dish' => $dish, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DishRequest $request, Dish $dish)
    {
        $request->merge(['ingredients' => implode(',', array_filter($request->ingredients))]);

        $dish->update($request->all());

        return redirect()->route('dish.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();

        return redirect()->route('dish.index');
    }
}
