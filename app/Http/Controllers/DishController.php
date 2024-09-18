<?php

namespace App\Http\Controllers;

use App\Http\Requests\DishRequest;

use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::with(['category', 'sizes'])->paginate(20);

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

        if (!empty($request->sizes)) {
            $request->merge(['price' => null]);
        }

        $data = [
            'name'          => $request->name,
            'description'   => $request->description,
            'ingredients'   => $request->ingredients,
            'category_id'   => $request->category_id,
            'price'         => $request->price,
        ];

        if (!empty($request->image)) {
            $path = $request->file('image')->store('dishes', 'public');
            $data['image'] = $path;
        }

        $dish = Dish::create($data);

        if (!empty($request->sizes)) {
            $dish->sizes()->createMany($request->sizes);
        }

        return redirect()->route('dish.index')->with('success', 'Danie zostało dodane');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish) {}

    /**
     * Display the specified resource.
     */
    public function showSizes(Request $request)
    {
        $dish_id = $request->input('dish_id');

        $dish = Dish::with(['sizes'])->findOrFail($dish_id);

        return view('dish.sizes-select', ['dish' => $dish]);
    }

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

        if ($dish->sizes()) {
            $dish->sizes()->delete();
        }

        if (!empty($request->sizes)) {
            $request->merge(['price' => null]);
        }

        $data = [
            'name'          => $request->name,
            'description'   => $request->description,
            'ingredients'   => $request->ingredients,
            'category_id'   => $request->category_id,
            'price'         => $request->price,
        ];

        if (empty($request->path)) {
            $data['image'] = null;
        }

        if ($request->file('image')) {
            $path = $request->file('image')->store('dishes', 'public');
            $data['image'] = $path;
        }

        if ($dish->image && $dish->image != $data['image']) {
            Storage::disk('public')->delete($dish->image);
        }

        $dish->update($data);

        if (!empty($request->sizes)) {
            $dish->sizes()->createMany($request->sizes);
        }

        return redirect()->route('dish.index')->with('success', 'Danie zostało zaaktualizowane');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();

        return redirect()->route('dish.index')->with('success', 'Danie zostało usunięte');
    }
}
