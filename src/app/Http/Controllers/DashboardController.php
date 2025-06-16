<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $orders = $user->orders()
                      ->with('orderItems.product')
                      ->orderBy('created_at', 'desc') // Optional: order by newest first
                      ->paginate(10); // You can adjust the number per page

        return view('dashboard', compact('orders'));
    }
}