<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories_data = Category::all();
        return view('categories.index', compact('categories_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
        ]
        ,[
            'name.required' => 'Category နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]);
    
        $categories = new Category();
        $categories->name = $request->name;
        $categories->description = $request->description;
        $categories->save();

        return redirect()->back()->with('success', 'Category အသစ်တစ်ခုထပ်မံထည့်သွင်းပြီးပါပြီ။');
    }

    
    public function show(Category $category)
    {
        //
    }

    
    public function edit(Category $category)
    {
        $category_data = Category::find($category->id);
            
        return view('categories.update', compact('category_data'));
    }

    
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
        ]
        ,[
            'name.required' => 'Category နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]);
    
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->back()->with('success', 'Category - '. $request->name .' - ကိုပြင်ဆင်ပြီးပါပြီ။');
    }

    
    public function destroy(Category $category)
    {
        if(count($category->projects)){
            return redirect()->back()->with('error', "This Category has projects, You can't Delete.");
        }
        $category->delete();
        return redirect()->back()->with('success', 'Category - ပယ်ဖျက်ပြီးပါပြီ။');
    }
}
