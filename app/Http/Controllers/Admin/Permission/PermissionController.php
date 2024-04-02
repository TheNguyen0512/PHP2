<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
    private $permission;
    public function __construct(Permission $permission){
        $this->permission = $permission;
    }
    public function index(){
        return view('Admin.Permission.add');
    }

    public function create(Request $request){
        try {
            DB::beginTransaction();
                $permission = $this->permission::create([
                    'per_name'=> $request->module_parent,
                    'per_display_name'=> $request->module_parent,
                    'per_parent_id'=>0
                ]);
                foreach ($request->module_childrent as $value){
                    $this->permission::create([
                        'per_name'=> $value,
                        'per_display_name'=> $value,
                        'per_parent_id'=>$permission->per_id,
                    ]);
                }
            DB::commit();
            Alert::success('Create Success', 'Permission Created Successfully');
            return redirect()->route('admin-permission');
        }catch (\Exception $exception){
            DB::rollBack();
            Alert::error('Create error', 'Permission Created Error !');
            Log::channel('daily')->error('Message Permission: '.$exception->getMessage().' Line :'.$exception->getLine());
            return redirect()->route('admin-permission');
        }
    }
}
