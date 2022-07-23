<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    
    public function activityLog(Request $request)
    {
        $notifications = DB::table('notifications')
        ->select(
            'notifications.id',
            'notifications.type',
            'notifications.notifiable_type',
            'notifications.notifiable_id',
            'notifications.data',
            'notifications.read_at',
            'notifications.created_at',
        )
        ->orderBy('created_at', 'desc')
        ->paginate(50);

        return view('activity.activity_log', compact('notifications'));
    }

    public function activityDelete(Request $request){
        $validated = $request->validate([
            'start' => 'required',
            'end' => 'required',
        ]
        ,[
            'start.required' => 'Start Date ထည့်ပေးရန်လိုအပ်သည်။',
            'end.required' => 'End Date ထည့်ပေးရန်လိုအပ်သည်။',
        ]
        );
        $notifications = DB::table('notifications')->whereBetween('created_at', [$request->start, $request->end])->delete();
        
        return redirect()->back()->with('success', 'Log များပယ်ဖျက်ပြီးပါပြီ။');
    }

    public function index()
    {
        switch (Auth::user()->utype) {
            case 'ADM':
                $user = User::find(Auth::user()->id);
                $projects = Project::all();
                $clients = Client::all();
                $tasks = Task::all();
                $users = User::all();
                return view('dashboard.admin', compact('user', 'projects', 'clients', 'tasks', 'users'));
                break;

            case 'MAN':

                $user = User::find(Auth::user()->id);
                $clients = Client::all();
                return view('dashboard.manager', compact('user', 'clients'));
                break;

            case 'EMP':

                $user = User::find(Auth::user()->id);
                return view('dashboard.employee', compact('user'));
                break;
        }
        
    }

    public function welcome(){
        
        return redirect()->route('home');
    }

    public function shareTask($id){
        $task = Task::find($id);
        return view('share_task', compact( 'task'));
    }

    public function deleteNoti($id)
    {
        if($id = Auth::user()->id){
            Auth::user()->unreadNotifications()->update(['read_at' => now()]);
            return redirect()->back()->with('success', 'Notification များပယ်ဖျက်ပြီးပါပြီ။');
        }
        return redirect()->back();
    }
}
