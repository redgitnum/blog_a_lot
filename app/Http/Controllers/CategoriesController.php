<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')->get();
        return view('categories', [
            'categories' => $categories
        ]);
    }
}
