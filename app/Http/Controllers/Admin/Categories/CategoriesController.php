<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryAddRequets;
use App\Http\Requests\CategoryUpdateResquest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use App\Services\Recursive as Recursive;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriesController extends Controller
{

    private $categories;
    private $products;
    private $recursive;


    public function __construct(Categories $categories, Products $products, Recursive $recursive)
    {
        $this->categories = $categories;
        $this->products = $products;
        $this->recursive = $recursive;
    }

    public function index(Request $request)
    {
        try {
            if ($request->search != null) {
                $categories = $this->categories::withoutTrashed()->where('cate_name', 'like', '%' . $request->search . '%')->latest('created_at')->paginate(15);
            } else {
                $categories = $this->categories::withoutTrashed()->latest('created_at')->paginate(15);
            }
            return view('Admin.Category.category', compact('categories'));
        } catch (\Throwable $exception) {
            $categories = [];
            DB::rollBack();
            Log::channel('daily')->error('Message: ' . $exception->getMessage() . ' Line :' . $exception->getLine());
            Alert::error('Error', 'Connection failed !');
            return view('Admin.Category.category', compact('categories'));
        }
    }

    public function add()
    {
        $htmlOptions = $this->recursive->categoryRecursive();
        return view('Admin.Category.add', compact('htmlOptions'));
    }

    public function edit($id, Recursive $recursive)
    {
        $category = $this->categories::withoutTrashed()->find($id);
        $htmlOptions = $this->recursive->categoryRecursiveEdit($category->cate_parent_id, 0, '');
        return view('Admin.Category.edit', compact('category', 'htmlOptions'));
    }

    public function create(CategoryAddRequets $request)
    {
        try {
            DB::beginTransaction();
            if ($request->file('image')) {
                $file = $request->file('image');
                $imageData = file_get_contents($file->getRealPath());
                $this->categories->create([
                    'cate_name' => $request->cate_name,
                    'cate_parent_id' => $request->id_parent,
                    'cate_img' => $imageData,
                ]);
            } else {
                $this->categories->create([
                    'cate_name' => $request->cate_name,
                    'cate_parent_id' => $request->id_parent
                ]);
            }

            DB::commit();
            Alert::success('Create Success', 'Category Created Successfully');
            return redirect()->route('admin-categories');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::channel('daily')->error('Message: ' . $exception->getMessage() . ' Line :' . $exception->getLine());
            Alert::error('Create error', 'Category Created Error !');
            return redirect()->route('admin-categories');
        }
    }



    public function update($id, CategoryUpdateResquest $request)
    {
        try {
            DB::beginTransaction();
            $category = $this->categories::withoutTrashed()->find($id);
            if (!$category) {
                Alert::error('Update Error', 'Updated Status Error !');
                return redirect()->route('admin-products');
            }
            $isActive =  $request->radio_img; 
            if ($isActive === 'true') {
                if($request->hasFile('image')){
                    $file = $request->file('image');
                    $imageData = file_get_contents($file->getRealPath());
                    $category->update([
                        'cate_name' => $request->cate_name,
                        'cate_parent_id	' => $request->id_parent,
                        'cate_img' =>  $imageData,
                    ]);
                }else{
                    $category->update([
                        'cate_name' => $request->cate_name,
                        'cate_parent_id	' => $request->id_parent,
                    ]);
                }         
            }else{
                $category->update([
                    'cate_name' => $request->cate_name,
                    'cate_parent_id	' => $request->id_parent,
                    'cate_img' =>  null,
                ]);
            }
            Db::commit();
            Alert::success('Update Success', 'Category Updated Successfully');
            return redirect()->route('admin-categories');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::channel('daily')->error('Message: ' . $exception->getMessage() . ' Line :' . $exception->getLine());
            Alert::error('Update error', 'Category Updated Error !');
            return redirect()->route('admin-categories');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $category = $this->categories::withoutTrashed()->find($id);
            if (!$category) {
                Alert::error('Delete error', 'Category Delete Error');
                return redirect()->route('admin-categories');
            }
            $category_childent = $this->categories::withoutTrashed()->where('cate_parent_id', $id)->first();
            if ($category_childent !== null) {
                Alert::error('Delete error', 'There are still sub-items that cannot be deleted!');
                return redirect()->route('admin-categories');
            } else {
                $product_childent =  $this->products::withoutTrashed()->where('category_id', $id)->first();
                if ($product_childent !== null) {
                    Alert::error('Delete error', 'This category still has many products that cannot be deleted');
                    return redirect()->route('admin-categories');
                } else {
                    $category->delete();
                    DB::commit();
                    Alert::success('Delete Success', 'Category Delete Successfully');
                    return redirect()->route('admin-categories');
                }
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::channel('daily')->error('Message: ' . $exception->getMessage() . ' Line :' . $exception->getLine());
            Alert::error('Delete error', 'Category Delete Error');
            return redirect()->route('admin-categories');
        }
    }
}
