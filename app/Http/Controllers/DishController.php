<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Http\Requests\DishRequest;
use Illuminate\Http\Request;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::paginate(2);

        return view('dish.index', ['dishes' => $dishes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dish.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DishRequest $request)
    {
        // $dish = new Dish();
        // $dish->name = $request->name;
        // $dish->description = $request->description;
        // $dish->ingredients = implode(',', $request->ingredients);
        // $dish->price = $request->price;
        // $dish->image = $request->image;

        
        // $dish->save();
        
        $request->merge(['ingredients' => implode(',', $request->ingredients)]); 
        // $request->ingredients 
        
        Dish::create($request->all());

        return redirect()->route('dish.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dish $dish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        //
    }
}
