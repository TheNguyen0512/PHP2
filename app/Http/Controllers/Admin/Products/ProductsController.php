<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdcutAddRequest;
use App\Http\Requests\ProductUpdateResquest;
use App\Models\Orders;
use App\Models\ProductImage;
use App\Models\Products;
use App\Services\Recursive as Recursive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProductsController extends Controller
{
    private $products;
    private $recursive;
    private $productImage;
    private $order;
    public function __construct(Products $products, Recursive $recursive, ProductImage $productImage, Orders $order)
    {
        $this->products = $products;
        $this->recursive = $recursive;
        $this->productImage = $productImage;
        $this->order = $order;
    }
    public function index(Request $request)
    {
        try {
            if ($request->search != null) {
                $products = $this->products::withoutTrashed()->select('pro_id', 'pro_name', 'pro_price', 'pro_img', 'category_id', 'pro_status')->where('pro_name', 'like', '%' . $request->search . '%')->latest('created_at')->paginate(20);
            } else {
                $products = $this->products::withoutTrashed()->select('pro_id', 'pro_name', 'pro_price', 'pro_img', 'category_id', 'pro_status')->latest('created_at')->paginate(20);
            }
            return view('Admin.Product.product', compact('products'));
        } catch (\Throwable $exception) {
            $products = [];
            DB::rollBack();
            Log::channel('daily')->error('Message: ' . $exception->getMessage() . ' Line :' . $exception->getLine());
            Alert::error('Error', 'Connection failed !');
            return view('Admin.Product.product', compact('products'));;
        }
    }

    public function add()
    {
        $htmlOptions = $this->recursive->categoryRecursive();
        return view('Admin.Product.add', compact('htmlOptions'));
    }

    public function create(ProdcutAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $file = $request->file('image');
            $imageData = file_get_contents($file->getRealPath());
            $product = $this->products::create([
                'pro_name' => $request->pro_name,
                'pro_price' => $request->pro_price,
                'pro_brand' => $request->pro_brand,
                'pro_description' => $request->pro_description,
                'category_id' => $request->category_id,
                'pro_img' =>  $imageData,
            ]);
            if ($request->hasFile('img_childent')) {
                $count = 1;
                foreach ($request->img_childent as $item) {
                    $imageChildentData = file_get_contents($item->getRealPath());
                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'proImg_img' => $imageChildentData,
                        'proImg_order' => $count,
                    ]);
                    $count++;
                }
            }
            DB::commit();
            Alert::success('Create Success', 'Product Created Successfully');
            return redirect()->route('admin-products');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::channel('daily')->error('Message: ' . $exception->getMessage() . ' Line :' . $exception->getLine());
            Alert::error('Create error', 'Product Created Error !');
            return redirect()->route('admin-products')->with('toast_error', 'Product Created Error !');
        }
    }

    public function edit($id, Recursive $recursive)
    {
        $product = $this->products::withoutTrashed()->find($id);
        $htmlOptions = $this->recursive->categoryRecursiveEdit($product->category_id);
        return view('Admin.product.edit', compact('htmlOptions', 'product'));
    }

    public function update($id, ProductUpdateResquest $request)
    {
        try {
            DB::beginTransaction();
            $product = $this->products::withoutTrashed()->find($id);
            if (!$product) {
                Alert::error('Update Error', 'Updated Status Error !');
                return redirect()->route('admin-products');
            }
            $isFeatured =  $request->is_featured;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageData = file_get_contents($file->getRealPath());
                $product->update([
                    'pro_name' => $request->pro_name,
                    'pro_price' => $request->pro_price,
                    'pro_quantity' => $request->pro_quantity,
                    'is_featured' => $isFeatured == 'true' ? true : false,
                    'pro_brand' => $request->pro_brand,
                    'pro_description' => $request->pro_description,
                    'category_id' => $request->category_id,
                    'pro_img' =>  $imageData,
                    
                ]);
            } else {
                $product->update([
                    'pro_name' => $request->pro_name,
                    'pro_price' => $request->pro_price,
                    'pro_quantity' => $request->pro_quantity,
                    'is_featured' => $isFeatured == 'true' ? true : false,
                    'pro_brand' => $request->pro_brand,
                    'pro_description' => $request->pro_description,
                    'category_id' => $request->category_id,
                ]);
            }
            for ($i = 1; $i < 6; $i++) {
                if ($request->hasFile('img_' . $i)) {
                    $imgId = $request->input('img_id_' . $i);
                    $file = $request->file('img_' . $i);
                    $imageData = file_get_contents($file->getRealPath());
                    if ($this->productImage->find($imgId)) {
                        $this->productImage->find($imgId)->update([
                            'proImg_img' => $imageData,
                        ]);
                    } else {
                        $this->productImage->create([
                            'product_id' => $id,
                            'proImg_img' => $imageData,
                            'proImg_order' => $i,
                        ]);
                    }
                }
            }

            DB::commit();
            Alert::success('Update Success', 'Product Updated Successfully');
            return redirect()->route('admin-products');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::channel('daily')->error('Message: ' . $exception->getMessage() . ' Line :' . $exception->getLine());
            Alert::error('Update error', 'Product Updated Error !');
            return redirect()->route('admin-products');
        }
    }

    public function changeStatus($id)
    {
        try {
            DB::beginTransaction();
                $product = $this->products::withoutTrashed()->find($id);
                if (!$product) {
                    Alert::error('Update Error', 'Updated Status Error !');
                    return redirect()->route('admin-products');
                }
                if($product->pro_quantity <= 0){
                    Alert::error('Update Error', 'Updated Status Error !');
                    return redirect()->route('admin-products');
                }
                $product->update([
                    'pro_status' => !$product->pro_status,
                ]);
            DB::commit();
            Alert::success('Update Success', 'Updated Status Successfully');
            return redirect()->route('admin-products');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::channel('daily')->error('Message: ' . $exception->getMessage() . ' Line :' . $exception->getLine());
            Alert::error('Update error', 'Updated Status Error !');
            return redirect()->route('admin-products');
        }
    }

    public function delete($id){
        try {
            DB::beginTransaction();
            $hasDeliveringOrders = Orders::whereHas('order_detail', function ($query) use ($id) {
                $query->where('ordd_product_id', $id)
                      ->where('ord_status', 'delivering');
            })->exists();
    
            if ($hasDeliveringOrders) {
                Alert::error('Delete error', 'Product Delete Error');
                return redirect()->route('admin-products');
            }
            $this->products::find($id)->delete();
    
            DB::commit();
            Alert::success('Delete Success', 'Product Delete Successfully');
            return redirect()->route('admin-products');
        } catch (\Exception $exception){
            DB::rollBack();
            Log::channel('daily')->error('Message: '.$exception->getMessage().' Line :'.$exception->getLine());
            Alert::error('Delete error', 'Product Delete Error');
            return redirect()->route('admin-products');
        }
    }
}
