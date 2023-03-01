<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $htmlSelect;

    public function __construct()
    {
        $this->htmlSelect = '';
    }

    public function create()
    {
        // $data = Category::all();
        // foreach ($data as $value) {
        //     if ($value['parent_id'] == 0) {
        //         echo "<option>" . $value['name'] . "</option>";
        //     }
        // }

        $htmlOption = $this->categoryRecursive(0);

        return view('category.add', compact('htmlOption'));
    }

    public function categoryRecursive($id)
    {
        $data = Category::all();
        foreach ($data as $value) {
            if ($value['parent_id'] == $id) {
                $this->htmlSelect .= "<option>" . $value['name'] . "</option>";

                $this->categoryRecursive($value['id']);
            }
        }

        return $this->htmlSelect;
    }

    public function index()
    {
        return view('category.index');
    }
}
