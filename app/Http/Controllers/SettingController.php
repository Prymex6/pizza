<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use App\Models\Setting;

use Illuminate\Http\Request;

use App\Services\SettingService;

class SettingController extends Controller
{
    protected $settingService;

    public function __construct(settingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = settings();

        return view('setting.index', ['settings' => $settings]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(String $code)
    {
        $dishes = Dish::all();
        $categories = Category::all();
        $settings = settings();

        return view('setting.edit', ['code' => $code, 'dishes' => $dishes, 'categories' => $categories, 'settings' => $settings]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $code)
    {
        $this->settingService->update($request->input($code), $code);

        return redirect()->route('setting.index');
    }
}
