<?php

namespace App\Http\Controllers\Tenants;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('tenants.store.cart', [
            'items' => Cart::getContent(),
        ]);
    }

    public function store(Request $request)
    {
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => [
                'color' => $request->color,
                'image' => $request->image,
                'path' => $request->path,
            ],
        ]);

        session()->flash('success', 'Product is Added to Cart Successfully !');

        return back();
    }

    public function update(Request $request)
    {
        Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity,
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return back();
    }

    public function delete(Request $request)
    {
        Cart::remove($request->id);

        session()->flash('success', 'Item Cart Remove Successfully !');

        return back();
    }

    public function clear()
    {
        Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('tenant.cart.index');
    }
}
