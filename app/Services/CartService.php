<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Models\Cart;

use App\Http\Resources\DishesFromCart;
use App\Http\Resources\DishesFromCartsResource;

class CartService
{
    private function getDishes(Request $request)
    {
        $cart = Cart::with('dishes')->where('user_token', $request->cookie('user_token'))->first();

        return !empty($cart) ? $cart->dishes()->withPivot('quantity')->get() : [];
    }

    public function getCarts(Request $request)
    {
        $dishes = $this->getDishes($request);

        return DishesFromCartsResource::collection($dishes);
    }

    public function getListDishesFromCart(Request $request)
    {
        $dishes = $this->getDishes($request);

        return DishesFromCart::collection($dishes);
    }

    public function clearCart(Request $request)
    {
        $cart = Cart::with('dishes')->where('user_token', $request->cookie('user_token'))->first();

        if ($cart) {
            $cart->dishes()->detach();
        }
    }

    public function getTotal(Request $request): int
    {
        $dishes = $this->getDishes($request);

        $total = 0;

        foreach ($dishes ?? [] as $key => $value) {
            $total += $value['price'] * $value['pivot']['quantity'];
        }

        return $total;
    }
}
