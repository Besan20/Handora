<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;

class ArtisanController extends Controller
{
    /**
     * Artisan Dashboard Home
     */
    public function home()
    {
        $artisanId = auth()->id();

        $productsCount = Product::where('artisan_id', $artisanId)->count();
        $ordersCount = Order::whereHas('items.product', function ($query) use ($artisanId) {
            $query->where('artisan_id', $artisanId);
        })->count();

        $recentProducts = Product::where('artisan_id', $artisanId)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $recentOrders = Order::whereHas('items.product', function ($query) use ($artisanId) {
            $query->where('artisan_id', $artisanId);
        })->with('user')->orderBy('created_at', 'desc')->take(4)->get();

        return view('artisan.home', compact(
            'productsCount',
            'ordersCount',
            'recentProducts',
            'recentOrders'
        ));
    }

    /**
     * My Products Page
     */
    public function products()
    {
        $artisanId = auth()->id();

        $products = Product::where('artisan_id', $artisanId)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalProducts = $products->count();
        $publishedCount = $products->where('is_visible', true)->count();
        $draftCount = $products->where('is_visible', false)->count();
        $soldCount = $products->where('stock', 0)->count();

        return view('artisan.myProducts', compact(  // ✅ myProducts مش products
            'products',
            'totalProducts',
            'publishedCount',
            'draftCount',
            'soldCount'
        ));
    }

    /**
     * Add Product Form
     */
    public function addProduct()
    {
        $categories = Category::all();
        return view('artisan.addProduct', compact('categories'));  
    }

    /**
     * Store Product
     */
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
            'category_id' => 'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $images[] = $path;
            }
        }

        $categoryId = $request->category_id;
        if ($request->category_id === '__new__' && $request->new_category) {
            $newCategory = Category::create([
                'name' => $request->new_category,
                'slug' => \Str::slug($request->new_category),
            ]);
            $categoryId = $newCategory->id;
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $categoryId,
            'artisan_id' => auth()->id(),
            'images' => $images,
            'is_visible' => true,
        ]);

        return redirect()->route('artisan.products')->with('success', 'تم إضافة المنتج بنجاح');
    }

    /**
     * Edit Product Form
     */
    public function editProduct($id)
    {
        $product = Product::where('artisan_id', auth()->id())->findOrFail($id);
        $categories = Category::all();
        return view('artisan.editProduct', compact('product', 'categories'));  // ✅ editProduct
    }

    /**
     * Update Product
     */
    public function updateProduct(Request $request, $id)
    {
        $product = Product::where('artisan_id', auth()->id())->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update($request->only('name', 'description', 'price', 'stock', 'category_id'));

        return redirect()->route('artisan.products')->with('success', 'تم تحديث المنتج بنجاح');
    }

    /**
     * Delete Product
     */
    public function deleteProduct($id)
    {
        $product = Product::where('artisan_id', auth()->id())->findOrFail($id);
        $product->delete();
        return redirect()->route('artisan.products')->with('success', 'تم حذف المنتج بنجاح');
    }

    /**
     * Toggle Product Visibility
     */
    public function toggleProduct($id)
    {
        $product = Product::where('artisan_id', auth()->id())->findOrFail($id);
        $product->is_visible = !$product->is_visible;
        $product->save();
        return redirect()->back()->with('success', 'تم تغيير حالة المنتج');
    }

    /**
     * Orders Page
     */
    public function orders()
    {
        $orders = Order::whereHas('items.product', function ($query) {
            $query->where('artisan_id', auth()->id());
        })->with(['user', 'items.product.category'])
        ->orderBy('created_at', 'desc')
        ->get();
        
        return view('artisan.orders', compact('orders'));
    }

    /**
     * Update Order Status
     */
    public function updateOrderStatus(Request $request, $id)
    {
        return redirect()->back()->with('success', 'تم تحديث حالة الطلب');
    }

    /**
     * Analytics Page
     */
    public function analytics()
    {
        $artisanId = auth()->id();

        $totalSales = Order::whereHas('items.product', function ($query) use ($artisanId) {
            $query->where('artisan_id', $artisanId);
        })->where('status', 'delivered')->sum('total');

        $totalOrders = Order::whereHas('items.product', function ($query) use ($artisanId) {
            $query->where('artisan_id', $artisanId);
        })->count();

        $totalProducts = Product::where('artisan_id', $artisanId)->count();

        $topProducts = Product::where('artisan_id', $artisanId)
            ->orderBy('sales_count', 'desc')
            ->take(5)
            ->get();

        return view('artisan.analytics', compact(
            'totalSales',
            'totalOrders',
            'totalProducts',
            'topProducts'
        ));
    }

    /**
     * Edit Profile Page
     */
    public function editProfile()
    {
        $user = auth()->user();
        $products = Product::where('artisan_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('artisan.editProfile', compact('user', 'products'));
    }

    /**
     * Update Profile
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'specialty' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user = auth()->user();
        $user->update($request->only('name', 'bio', 'specialty', 'phone', 'address'));

        return redirect()->route('artisan.edit-profile')->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }

    /**
     * Shop Preview Page
     */
    public function shopPreview()
    {
        $artisan = auth()->user();
        $products = Product::where('artisan_id', auth()->id())
            ->where('is_visible', true)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('artisan.shopPreview', compact('artisan', 'products'));  // ✅ shopPreview
    }
}