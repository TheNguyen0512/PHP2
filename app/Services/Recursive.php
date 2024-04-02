<?php

namespace App\Services;

use App\Category;
use App\Models\Categories;

class Recursive
{
    private $htmlSelect;
    public function __construct()
    {
        $this->htmlSelect = '';
    }

    public function categoryRecursive($id = 0, $text = '')
    {
        $data = Categories::where('cate_parent_id',$id)->get();
        foreach ($data as $item){
            $this->htmlSelect .= '<option value="'.$item->cate_id .'">'.$text.$item->cate_name.'</option>';
            $this->categoryRecursive($item->cate_id , $text.'--');
        }
        return $this->htmlSelect;
    }

    public function categoryRecursiveEdit($idparentEdit,$id = 0, $text= '')
    {
        $data = Categories::where('cate_parent_id',$id)->get();
        foreach ($data as $item){
            if ($idparentEdit == $item->cate_id )
            {
                $this->htmlSelect .= '<option selected value="'.$item->cate_id .'">'.$text.$item->cate_name.'</option>';
            }else{
                $this->htmlSelect .= '<option value="'.$item->cate_id .'">'.$text.$item->cate_name.'</option>';
            }
            $this->categoryRecursiveEdit($idparentEdit, $item->cate_id , $text.'--');
        }
        return  $this->htmlSelect;
    }


}
