<?php

namespace App\Http\Controllers;

use App\Mail\Task as MailTask;
use Illuminate\Support\Facades\Mail;
use App\Models\Attachment;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskCategory;
use Illuminate\Http\Request;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Task::when($request->has("name"),function($q)use($request){
            return $q->where("name","like","%".$request->get("name")."%");})
            ->when($request->has("status"),function($q)use($request){
                return $q->where("status","like","%".$request->get("status")."%");})
            ->when($request->has("priority"),function($q)use($request){
                return $q->where("priority","like","%".$request->get("priority")."%");})
            ->when($request->has("start_date"),function($q)use($request){
                return $q->where("start_date","like","%".$request->get("start_date")."%");})
            ->when($request->has("end_date"),function($q)use($request){
                return $q->where("end_date","like","%".$request->get("end_date")."%");})
            ->when($request->has("task_category_id"),function($q)use($request){
                return $q->where("task_category_id","like","%".$request->get("category_id")."%");})
            ->when($request->has("end_date_orderby"),function($q)use($request){
                return $q->orderby("end_date",$request->get("end_date_orderby"));})
            ->orderby('created_at', 'desc')
            ->paginate(16);
        $taskCategories = TaskCategory::all();
        return view('tasks.index', compact('tasks', 'taskCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStepOne()
    {
        $projects = Project::all();
        return view('tasks.create_one', compact('projects'));
    }

    public function createStepTwo($project_id)
    {
        $project = Project::find($project_id);
        $taskCategories = TaskCategory::all();
        return view('tasks.create_two', compact('project', 'taskCategories'));
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
            'start_date' => 'required|max:255',
            'project_id' => 'required',
            'status' => 'required',
            'priority' => 'required',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'start_date.required' => 'Task စတင်သည့် ရက်စွဲ ထည့်ပေးရန်လိုအပ်သည်။',
            'status.required' => 'Task Status ထည့်ပေးရန်လိုအပ်သည်။',
            'priority.required' => 'Task Priority ထည့်ပေးရန်လိုအပ်သည်။',
            
        ]
        );

    

        $task = new Task();
        $task->name = $request->name;
        $task->task_category_id = $request->task_category_id;
        $task->project_id = $request->project_id;
        $task->start_date = $request->start_date;
        $task->end_date = $request->end_date;
        $task->status = $request->status;
        $task->priority = $request->priority;
        $task->description = $request->description;
        $task->save();

        // User
        $task->users()->sync($request->users);

        // Sent Mail
        if(count($task->users)){

            foreach ($task->users as $value) {
                
                $email_data = array(
                    'userName'=>$value->name, 
                    'name'=>$task->name, 
                    'end_date'=>$task->end_date,
                );
                Mail::to($value->email)->send(new MailTask($email_data));
            }
            
        }
        

        return redirect()->route('tasks.index')->with('success', 'Task အသစ်ကိုထည့်သွင်းပြီးပါပြီ။');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show.index', compact('task'));
    }
    public function changeStatus($id){
        $task =  Task::find($id);
        if($task->status == 'incomplete'){
            $task->status = 'completed';
            $task->save();
        }else{
            $task->status = 'incomplete';
            $task->save();
        }
        return redirect()->back()->with('success', 'Task Status ကိုပြင်ဆင်ပြီးပါပြီ။');
    }

    public function showField($id, $field)
    {
        $task = Task::find($id);
        switch ($field) {
            case 'timers':
                // $tasks = Task::where('project_id', '=', $id)->orderby('created_at', 'desc')->paginate(12);
                return view('tasks.show.timers', compact('task'));
                break;

            case 'comments':
                return view('tasks.show.comments', compact('task'));
                break;

            case 'attachments':
                return view('tasks.show.attachments', compact('task'));
                break;
            default:
                return redirect()->route('tasks.show', $task->id);
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $taskCategories = TaskCategory::all();
        return view('tasks.update', compact('task', 'taskCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'start_date' => 'required|max:255',
            'status' => 'required',
            'priority' => 'required',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'start_date.required' => 'Task စတင်သည့် ရက်စွဲ ထည့်ပေးရန်လိုအပ်သည်။',
            'status.required' => 'Task Status ထည့်ပေးရန်လိုအပ်သည်။',
            'priority.required' => 'Task Priority ထည့်ပေးရန်လိုအပ်သည်။',
            
        ]
        );

    
        $task->name = $request->name;
        $task->task_category_id = $request->task_category_id;
        $task->start_date = $request->start_date;
        $task->end_date = $request->end_date;
        $task->status = $request->status;
        $task->priority = $request->priority;
        $task->description = $request->description;
        $task->save();

        // User
        $task->users()->sync($request->users);

        return redirect()->route('tasks.index')->with('success', 'Task ကိုပြင်ဆင်ပြီးပါပြီ။');
    }

    public function storeAttachment(Request $request, $id){

        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg,zip,pdf,txt,ppt,docx,xlsx|max:51200',
        ]
        ,[
            'file.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            
        ]
        );


        $originName = $request->file('file')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $size = $request->file('file')->getSize();
        $fileName = $fileName.'_'.rand(1, 100).'.'.$extension;
                
        $request->file('file')->move(public_path('/backend/images/tasks/'), $fileName);

        $attachment = new Attachment();
        $attachment->asset = $fileName;
        $attachment->size = $size;
        $attachment->extension = $extension;
        $attachment->attachmentable_id = $id;
        $attachment->attachmentable_type = 'App\Models\Task';
        $attachment->user_id = Auth::user()->id;
  
        $attachment->save();
  
        return response()->json([
          'id' => $attachment->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
