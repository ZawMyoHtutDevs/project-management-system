<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments_data = Department::all();
        return view('departments.index', compact('departments_data'));
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
            'name.required' => 'Department နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]);
    
        $departments = new Department();
        $departments->name = $request->name;
        $departments->description = $request->description;
        $departments->save();

        return redirect()->back()->with('success', 'Department အသစ်တစ်ခုထပ်မံထည့်သွင်းပြီးပါပြီ။');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $department_data = Department::find($department->id);
            
        return view('departments.update', compact('department_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
        ]
        ,[
            'name.required' => 'Department နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]);
    
        $department->name = $request->name;
        $department->description = $request->description;
        $department->save();

        return redirect()->back()->with('success', 'Department - '. $request->name .' - ကိုပြင်ဆင်ပြီးပါပြီ။');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->back()->with('success', 'Department - ပယ်ဖျက်ပြီးပါပြီ။');
    }
}
