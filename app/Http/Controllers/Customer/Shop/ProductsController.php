<?php

namespace App\Http\Controllers\Customer\Shop;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{

    private $categories;
    private $products;

    public function __construct(Categories $categories, Products $products)
    {
        $this->categories = $categories;
        $this->products = $products;
    }

    

    public function showproduct(Request $request, $product_id)
    {
        try {
            $categories = $this->categories->withoutTrashed()->get();
            // $product = $this->products->findOrFail($product_id);
            $product = $this->products->with('productImages')->findOrFail($product_id);
            return view('Customer.Products.productDetail', compact('categories', 'product'));
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }   
    }
}
