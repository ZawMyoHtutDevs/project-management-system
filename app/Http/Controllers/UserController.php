<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 
use Auth;

class UserController extends Controller
{
    
    public function index(){
        $users_data = User::select('id','name','email','utype', 'department_id', 'dob')->get();
        $department_data = Department::all();
        return view('auth.user', compact('users_data', 'department_data'));
    }


    public function create_user(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'utype' => 'required',
            'phone' => 'regex:/(0)[0-9]/|not_regex:/[a-z]/|unique:users',
            'bio' => 'max:255',
            'password' => 'required|string|min:6`|confirmed',
            'password_confirmation' => 'required|same:password',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'email.required' => 'အီးမေးလိပ်စာထည့်ပေးရန် လိုအပ်ပါသည်။',
            'email.email' => 'သင်ထည့်ထားသော အီးမေးကို ပြန်စစ်ပေးပါ။',
            'email.unique' => 'သင်ထည့်ထားသော အီးမေးကို အသုံးပြုပြီးဖြစ်သည်။',
            'phone.required' => 'Phone ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'phone.not_regex' => 'Phone အမှန် ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'password.required' => 'စကားဝှက်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'password_confirmation.required' => 'အတည်ပြုစကားဝှက်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'password_confirmation.same' => 'စကားဝှက် နှင့် အတည်ပြုစကားဝှက် ထပ်တူကျရန် လိုအပ်ပါသည်။',
            
        ]
    );


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->department_id = $request->department_id;
        $user->bio = $request->bio;
        $user->password = Hash::make($request->password_confirmation);
        $user->utype = $request->utype;
        $user->save();

        return redirect()->back()->with('success', 'အကောင့် အသစ်ကိုထည့်သွင်းပြီးပါပြီ။');

    }


    // update Detail
    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'phone' => 'regex:/(0)[0-9]/|not_regex:/[a-z]/|unique:users,phone,'.$id,
            'description' => 'max:255',
            'utype' => 'required',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'email.required' => 'အီးမေးလိပ်စာထည့်ပေးရန် လိုအပ်ပါသည်။',
            'email.email' => 'သင်ထည့်ထားသော အီးမေးကို ပြန်စစ်ပေးပါ။',
        ]);


        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->bio = $request->bio;
        $user->dob = $request->dob;
        $user->department_id = $request->department_id;
        $user->utype = $request->utype;
        $user->save();

        return redirect()->back()->with('success', $request->name .'- ၏ အချက်အလက်များကို ပြင်ဆင်ပြီးပါပြီ။');

    }

    // show account detail
    public function show($id){
        $user_data = User::find($id);
        $department_data = Department::all();
        return view('auth.detail', compact('user_data', 'department_data'));
        
    }

    public function change_password(Request $request, $id){

        $user = User::find($id);

        if (!(Hash::check($request->current_password, $user->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->current_password, $request->new_password) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        //Change Password
        
        $user->password = Hash::make($request->new_password_confirmation);
       
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }


    // Delete User
    public function delete_user($id){

        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', "Deleted account successfully !");

    }
}
