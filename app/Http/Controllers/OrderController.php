<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Dish;
use App\Models\Cart;

use Carbon\Carbon;

use App\Services\cartService;

class OrderController extends Controller
{
    protected $cartService;

    public function __construct(cartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(20);

        return view('order.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dishes = Dish::all();

        return view('order.create', ['dishes' => $dishes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $full_name = explode(' ', $request->full_name);

        $firstname = array_values($full_name);
        $firstname = array_shift($firstname);
        $request->merge(['firstname' => $firstname, 'lastname' => end($full_name), 'status_id' => setting('statuses._default')['status_default']]);
        if (!$request->status_id) {
            $request->merge(['status_id' => setting('statuses._default')['status_default']]);
        }
        $order = Order::create($request->all());

        $dishes = $request->dishes;

        if (empty($dishes)) {
            $dishes = $this->cartService->getListDishesFromCart($request);
        }

        foreach ($dishes as $dish) {
            if (empty($dish['id'])) continue;
            $order->dishes()->attach($dish['id'], [
                'size'          => $dish['size']['name'] ?? '',
                'price'         => $dish['price'] ? $dish['price'] : $dish['size']['price'],
                'quantity'      => $dish['pivot']['quantity'],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }

        $this->cartService->clearCart($request);
        $cart = Cart::where('user_token', $request->cookie('user_token'))->first();
        if ($cart) {
            $cart->delete();
        }
        if (in_array(session('previous_route'), ['cart.index'])) {
            return redirect()->route('home.index')->with('success', 'Zamówienie zostało złożone!');
        }

        return redirect()->route('order.index')->with('success', 'Zamówienie zostało dodane!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showStatuses(Request $request)
    {
        $status_id = $request->input('status_id');

        return view('order.statuses-select', ['status_id' => $status_id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $dishes = Dish::all();

        return view('order.edit', ['order' => $order, 'dishes' => $dishes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatuses(Request $request)
    {
        $order_id = $request->input('order_id');
        $status_id = $request->input('status_id');

        $order = Order::find($order_id);

        if ($order) {
            $order->status_id = $status_id;
            $order->save();
        }

        return view('order.statuses', ['status_id' => $status_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
