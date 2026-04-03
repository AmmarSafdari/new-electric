<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    public function home()
    {
        $categories = Category::withCount('products')->get();
        $featured   = Product::where('is_featured', true)->with('category')->take(4)->get();
        $flashSale  = Product::where('is_on_sale', true)
            ->where(function ($q) {
                $q->whereNull('sale_ends_at')->orWhere('sale_ends_at', '>', now());
            })
            ->with('category')
            ->take(4)
            ->get();
        $flashSaleEnd = \Carbon\Carbon::parse(
            Product::where('is_on_sale', true)
                ->whereNotNull('sale_ends_at')
                ->where('sale_ends_at', '>', now())
                ->min('sale_ends_at') ?? now()->addHours(24)
        );
        return view('storefront.home', compact('categories', 'featured', 'flashSale', 'flashSaleEnd'));
    }

    public function category(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $brands   = Brand::has('products')->get();
        $query    = Product::where('category_id', $category->id)->with('brand', 'category');
        if (request('brand')) {
            $query->whereIn('brand_id', (array) request('brand'));
        }
        $products = $query->paginate(12)->withQueryString();
        return view('storefront.category', compact('category', 'products', 'brands'));
    }

    public function product(string $slug)
    {
        $product = Product::where('slug', $slug)->with(['category', 'brand'])->firstOrFail();
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)->with('category')->take(4)->get();
        return view('storefront.product', compact('product', 'related'));
    }

    public function search(Request $request)
    {
        $q = $request->input('q', '');
        $products = Product::where(function ($q2) use ($q) {
            $q2->where('title', 'like', "%{$q}%")
               ->orWhere('description', 'like', "%{$q}%")
               ->orWhere('sku', 'like', "%{$q}%");
        })->with('category')->paginate(12)->withQueryString();
        return view('storefront.search', compact('products', 'q'));
    }

    public function about()    { return view('storefront.about'); }
    public function contact()  { return view('storefront.contact'); }
    public function shipping() { return view('storefront.shipping'); }
    public function returns()  { return view('storefront.returns'); }
    public function privacy()  { return view('storefront.privacy'); }
}
