<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class OrdersController extends Controller
{
    public function index()
    {
        return view('tenants.store.orders.index', [
            'orders' => Order::where('user_id', '=', auth()->user()->id)->latest('id')->paginate(6),
        ]);
    }

    public function store()
    {
        Order::create([
            'user_id' => auth()->user()->id,
            'hash' => substr(time() . auth()->user()->id . mt_rand(), 0, 15),
            'order_details' => json_encode(Cart::getContent()),
            'total' => Cart::getTotal() + 18.32,
            'card_number' => request('card_number'),
            'expiration_date' => request('expiration_date'),
            'cvc' => request('cvc'),
            'address' => request('address'),
            'city' => request('city'),
            'region' => request('region'),
        ]);

        Cart::getContent()->map(function ($item) {
            $product = Product::find($item->id);
            $product->decrement('stock', $item->quantity);
        });

        Cart::clear();

        session()->flash('success', 'Your Order placed Successfully !');

        return redirect()->route('tenant.orders.index');
    }
}
