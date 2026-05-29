<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // GET SESSION ID OR CREATE ONE
    private function getSessionId()
    {
        return session()->getId();
    }

    // ADD TO CART
    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
        ]);

        $product = Product::findOrFail($data['product_id']);

        // Check stock
        if ($product->quantity < $data['quantity']) {
            return back()->with('error', 'Insufficient stock available! ❌');
        }

        $sessionId = $this->getSessionId();

        // Check if item already in cart
        $existingCart = Cart::where('product_id', $data['product_id'])
            ->where('session_id', $sessionId)
            ->where('size', $data['size'] ?? null)
            ->where('color', $data['color'] ?? null)
            ->first();

        if ($existingCart) {
            $existingCart->quantity += $data['quantity'];
            $existingCart->save();
        } else {
            Cart::create([
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'size' => $data['size'] ?? null,
                'color' => $data['color'] ?? null,
                'price' => $product->selling_price,
                'session_id' => $sessionId,
            ]);
        }

        return back()->with('success', 'Added to cart! ✅');
    }

    // VIEW CART
    public function view()
    {
        $cartItems = Cart::where('session_id', $this->getSessionId())
            ->with('product')
            ->get();

        $total = $cartItems->sum(fn($item) => $item->getTotalPrice());

        return view('cart.index', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    // REMOVE FROM CART
    public function remove($id)
    {
        Cart::findOrFail($id)->delete();
        return back()->with('success', 'Item removed from cart! ✅');
    }

    // UPDATE QUANTITY
    public function updateQuantity(Request $request, $id)
    {
        $data = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($id);
        $product = $cartItem->product;

        if ($product->quantity < $data['quantity']) {
            return back()->with('error', 'Insufficient stock! ❌');
        }

        $cartItem->quantity = $data['quantity'];
        $cartItem->save();

        return back()->with('success', 'Quantity updated! ✅');
    }

    // CLEAR CART
    public function clear()
    {
        Cart::where('session_id', $this->getSessionId())->delete();
        return redirect('/cart')->with('success', 'Cart cleared! ✅');
    }
}