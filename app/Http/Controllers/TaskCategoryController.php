<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\TaskCategory;
use Illuminate\Http\Request;

class TaskCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskCategory = TaskCategory::all();
        $departments = Department::all();
        return view('tasks.categories.index', compact('taskCategory', 'departments'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
        ]
        ,[
            'name.required' => 'Category နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]);
    
        $taskCategory = new TaskCategory();
        $taskCategory->name = $request->name;
        $taskCategory->description = $request->description;
        $taskCategory->save();

        return redirect()->back()->with('success', 'Category အသစ်တစ်ခုထပ်မံထည့်သွင်းပြီးပါပြီ။');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TaskCategory $taskCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskCategory $taskCategory)
    {           
        $departments = Department::all(); 
        return view('tasks.categories.update', compact('taskCategory', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskCategory $taskCategory)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
        ]
        ,[
            'name.required' => 'Category နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]);
    
        $taskCategory->name = $request->name;
        $taskCategory->description = $request->description;
        $taskCategory->save();
        
        return redirect()->route('task-categories.index')->with('success', 'Category - '. $request->name .' - ကိုပြင်ဆင်ပြီးပါပြီ။');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskCategory $taskCategory)
    {
        if(count($taskCategory->tasks)){
            return redirect()->back()->with('error', "This Category has tasks, You can't Delete.");
        }
        $taskCategory->delete();
        return redirect()->back()->with('success', 'Category - ပယ်ဖျက်ပြီးပါပြီ။');
    }
}
