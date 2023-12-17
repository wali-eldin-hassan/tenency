<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        if (count(Cart::getContent()) === 0) {
            return redirect('/cart');
        }

        return view('tenants.store.checkout', [
            'items' => Cart::getContent(),
        ]);
    }
}
