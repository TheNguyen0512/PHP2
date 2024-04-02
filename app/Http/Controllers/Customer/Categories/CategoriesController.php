<?php

namespace App\Http\Controllers\Customer\Categories;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    private $categories;
    private $products;

    public function __construct(Categories $categories, Products $products)
    {
        $this->categories = $categories;
        $this->products = $products;
    }

    public function showAll(Request $request)
    {
        try {
            $categories = $this->categories->withoutTrashed()->get();
            $products = $this->products->paginate(21);
            return view('Customer.Products.products', compact('categories', 'products'));
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function show(Request $request, $category_id)
    {
        try {
            $category = $this->categories->findOrFail($category_id);
            $categories = $this->categories->withoutTrashed()->get();
            $products = $this->products->where('category_id', $category_id)->paginate(21);

            return view('Customer.Products.products', compact('category', 'categories', 'products'));

        } catch (ModelNotFoundException $e) {
            return back()->withError("Category not found")->withInput();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
