<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getImages($id){
        $obj= Product::find($id);
        $p1=$obj->path1;
        $p2=$obj->path2;
        $p3=$obj->path3;
        $p4=$obj->path4;
        $full=[
            'p1'=>$p1,
            'p2'=>$p2,
            'p3'=>$p3,
            'p4'=>$p4
        ];
        return $full;
    }
}
