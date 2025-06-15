<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        //calculate total items
        $totalQuantity = 0;
        $totalPrice = 0;
        $detailedCart = [];

        foreach ($cart as $productId => $item) {
            // fetch product
            $product = Product::find($productId);
            if (!$product) {
                continue; //skip non existent products
            }

            $quantity = $item['quantity'];
            $totalQuantity += $quantity;

            // calculate total price
            $totalPrice += $product->price * $quantity;

            $detailedCart[$productId] = [
                'product' => $product,
                'quantity' => $quantity,
            ];
        }

        return view('cart.index', [
            'cart' => $detailedCart,
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function add(Request $request, Product $product)
    {
        //add product
        $quantity = (int) $request->input('min_aantal', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product toegevoegd aan winkelwagen!');
    }

    public function update(Request $request, Product $product)
    {
        //update quantity
        $quantity = max(1, (int) $request->input('quantity'));

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Aantal bijgewerkt.');
    }

    public function remove(Product $product)
    {
        //remove product
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Product verwijderd uit winkelwagen.');
    }

    public function checkout()
    {
        //if cart is empty
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('store.index')->with('error', 'Winkelwagen is leeg.');
        }

        //get total price for checkout
        $total = 0;
        $orderItems = [];

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if (!$product) {
                continue; // skip non existent products
            }

            $quantity = $item['quantity'];
            $price = $product->price;
            $total += $price * $quantity;

            $orderItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'price' => $price,
            ];
        }

        $order = Order::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'total_price' => $total,
        ]);

        foreach ($orderItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product']->id,
                'amount' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');
        session()->flash('order_success', true);

        return redirect()->route('store.index');
    }
}
