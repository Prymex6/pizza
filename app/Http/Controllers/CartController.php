<?php

namespace App\Http\Controllers;

use App\Models\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Services\cartService;

use Carbon\Carbon;


class CartController extends Controller
{
    protected $cartService;

    public function __construct(cartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dishes = $this->cartService->getListDishesFromCart($request);
        $total = $this->cartService->getTotal($request);

        return view('cart.index', ['dishes' => $dishes, 'total' => $total]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function addDish(Request $request)
    {
        $user_token = $request->cookie('user_token');

        if (!$user_token) {
            $user_token = Str::random(40);
            cookie()->queue(cookie()->forever('user_token', $user_token));
        }

        $dishes = $this->cartService->getCarts($request)->toArray($request);

        $dishes = flattenArray($dishes);

        if (isset($dishes[$request->get('dish_id')])) {

            $request->merge(['quantity' => $dishes[$request->get('dish_id')] += $request->get('quantity')]);

            $cart = Cart::where('user_token', $request->cookie('user_token'))->first();

            $cart->dishes()->updateExistingPivot($request->get('dish_id'), ['quantity' => $request->get('quantity')]);
        } else {
            $cart = Cart::create([
                'user_token'    => $request->cookie('user_token'),
            ]);

            $cart->dishes()->attach($request->get('dish_id'), [
                'quantity' => $request->get('quantity'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Produkt został dodany do koszyka!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function removeDish(Request $request)
    {
        //
    }
}
