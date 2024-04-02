<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    // protected $slider;
    // protected $category;
    // protected $product;
    // protected $settings;
    protected $user;
    public function __construct(User $user,)
    {
        $this->user = $user;
        $this->middleware('cumstomer.page:Customer');
    }
    public function index(){
        $categories = Categories::withoutTrashed()->get();
        $featuredProducts = Products::withoutTrashed()->where('is_featured', true)->get();
        $newestProducts = Products::withoutTrashed()->orderBy('pro_id', 'desc')->take(6)->get();
        return view('Customer.index', compact('categories', 'featuredProducts','newestProducts'));
    }

}