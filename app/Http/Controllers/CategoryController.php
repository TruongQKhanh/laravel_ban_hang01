<?php

namespace App\Http\Controllers;

use App\Components\Recursive;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function create()
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecursive();
        return view('category.add', compact('htmlOption'));
    }

    public function index()
    {
        $categories = $this->category->latest()->paginate(5);
        return view('category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {}

    public function delete($id)
    {}
}
