<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function getCategoryIdByName($name)
    {
        $existingCategory = Category::where('name', $name)->first();

        if ($existingCategory) {
            return $existingCategory->id;
        }

        return null;
    }
}
