<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;

class CustomerController extends Controller
{
    public function home()
    {
        $featuredProducts = Product::where('is_visible', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $featuredArtisans = \App\Models\User::where('role', 'artisan')
            ->take(3)
            ->get();

        $categories = \App\Models\Category::take(8)->get();

        $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');

        return view('customer.home', compact(
            'featuredProducts',
            'featuredArtisans',
            'categories',
            'cartCount'
        ));
    }
    
    public function shop(Request $request)
    {
        $query = Product::where('is_visible', true);

        // فلتر حسب التصنيف
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // ترتيب
        switch ($request->sort) {
            case 'price-low':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->orderBy('sales_count', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // بحث
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $products = $query->paginate(12);
        $categories = \App\Models\Category::all();
        $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');

        return view('customer.shop', compact('products', 'categories', 'cartCount'));
    }
    
    public function product($id)
    {
        $product = Product::with('artisan', 'category')->findOrFail($id);

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_visible', true)
            ->take(4)
            ->get();

        $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');

        return view('customer.product', compact('product', 'relatedProducts', 'cartCount'));
    }

    public function cart()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product.artisan')
            ->get();

        if ($cartItems->isEmpty()) {
            return view('customer.cart', [
                'cartItems' => $cartItems,
                'subtotal' => 0,
                'tax' => 0,
                'shipping' => 0,
                'total' => 0,
                'cartCount' => 0,
            ]);
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $shipping = 0;
        $tax = $subtotal * 0.05;
        $total = $subtotal + $shipping + $tax;
        $cartCount = $cartItems->sum('quantity');

        return view('customer.cart', compact(
            'cartItems',
            'subtotal',
            'tax',
            'shipping',
            'total',
            'cartCount'
        ));
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product.artisan')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('customer.cart')->with('error', 'سلة المشتريات فارغة');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $shipping = 0;
        $tax = $subtotal * 0.05;
        $total = $subtotal + $shipping + $tax;
        $cartCount = $cartItems->sum('quantity');

        return view('customer.checkout', compact(
            'cartItems',
            'subtotal',
            'tax',
            'shipping',
            'total',
            'cartCount'
        ));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'notes' => 'nullable|string|max:1000',
            'payment_method' => 'required|in:card,paypal,cod',
        ]);

        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('customer.cart')->with('error', 'سلة المشتريات فارغة');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $tax = $subtotal * 0.05;
        $total = $subtotal + $tax;

        // إنشاء الطلب
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'total' => $total,
            'status' => 'pending',
            'address' => $request->address . ', ' . $request->city,
            'phone' => $request->phone,
            'notes' => $request->notes,
        ]);

        // إضافة عناصر الطلب
        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);

            // خصم من المخزون
            $item->product->decrement('stock', $item->quantity);
            $item->product->increment('sales_count', $item->quantity);
        }

        // حذف السلة
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('customer.orders')->with('success', '✅ تم إنشاء الطلب بنجاح');
    }

    public function orders()
    {
        $userId = auth()->id();

        $orders = Order::where('user_id', $userId)
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalOrders = $orders->count();
        $pendingCount = $orders->where('status', 'pending')->count();
        $shippedCount = $orders->where('status', 'shipped')->count();
        $deliveredCount = $orders->where('status', 'delivered')->count();
        $cartCount = Cart::where('user_id', $userId)->sum('quantity');

        return view('customer.orders', compact(
            'orders',
            'totalOrders',
            'pendingCount',
            'shippedCount',
            'deliveredCount',
            'cartCount'
        ));
    }

    public function orderDetails($id)
    {
        $order = Order::where('user_id', auth()->id())
            ->with('items.product')
            ->findOrFail($id);

        $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');

        return view('customer.order-details', compact('order', 'cartCount'));
    }

    public function profile()
    {
        $user = auth()->user();
        $cartCount = Cart::where('user_id', $user->id)->sum('quantity');

        return view('customer.profile', compact('user', 'cartCount'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('success', '✅ تم تحديث الملف الشخصي بنجاح');
    }
    
    public function addToCart(Request $request)
    {
        // التحقق
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        $userId = auth()->id();

        // هل المنتج موجود في السلة؟
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // تحديث الكمية
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // إضافة جديد
            Cart::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        // إرجاع عدد المنتجات في السلة
        $cartCount = Cart::where('user_id', $userId)->sum('quantity');

        // إذا كان الطلب AJAX
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم إضافة المنتج إلى السلة',
                'cart_count' => $cartCount,
            ]);
        }

        return redirect()->back()->with('success', 'تم إضافة المنتج إلى السلة');
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::where('user_id', auth()->id())->findOrFail($id);
        $cartItem->delete();

        return redirect()->back()->with('success', '✅ تم إزالة المنتج من السلة');
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        $cartItem = Cart::where('user_id', auth()->id())
            ->findOrFail($request->cart_id);

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث الكمية',
        ]);
    }
}
