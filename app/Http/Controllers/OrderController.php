<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Dish;
use App\Models\Order;

use App\Services\cartService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        if (Gate::allows('admin')) {
            $orders = Order::orderBy('id', 'desc')->paginate(20);
        } else {
            $orders = Auth::user()->orders()->paginate(20) ?? collect([]);
        }

        if ($orders) {
            $orders = OrderResource::collection($orders);
        }

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
        $request->merge(['firstname' => $firstname, 'lastname' => end($full_name)]);
        if (!$request->status_id) {
            $request->merge(['status_id' => setting('statuses._default')['status_default']]);
        }
        if (!$request->user_id) {
            $request->merge(['user_id' => Auth::user()->id ?? null]);
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
