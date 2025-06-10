<?php 
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use Illuminate\Http\Request;



class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', ['cart' => $cart]);
    }

    public function add(Request $request, Product $product)
    {
        $quantity = $request->input('min_aantal', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'product' => $product,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product toegevoegd aan winkelwagen!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('store.index')->with('error', 'Winkelwagen is leeg.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['product']->price * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => null, // change for login
            'totaal_prijs' => $total,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product']->id,
                'amount' => $item['quantity'],
                'prijs' => $item['product']->price,
            ]);
        }

        session()->forget('cart');
        session()->flash('order_success', true);

        return redirect()->route('store.index');
    }
}
