<?php

namespace App\Http\Controllers;

use App\Mail\Task as MailTask;
use Illuminate\Support\Facades\Mail;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Comment;
use App\Notifications\Comment as NotificationsComment;
use Illuminate\Http\Request;
use Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->utype == 'MAN' || Auth::user()->utype == 'EMP'){
            $user = User::find(Auth::user()->id);
            $projects_data = $user->projects()->when($request->has("name"),function($q)use($request){
                return $q->where("name","like","%".$request->get("name")."%");})
                ->when($request->has("status"),function($q)use($request){
                    return $q->where("status","like","%".$request->get("status")."%");})
                ->when($request->has("priority"),function($q)use($request){
                    return $q->where("priority","like","%".$request->get("priority")."%");})
                ->when($request->has("start_date"),function($q)use($request){
                    return $q->where("start_date","like","%".$request->get("start_date")."%");})
                ->when($request->has("end_date"),function($q)use($request){
                    return $q->where("end_date","like","%".$request->get("end_date")."%");})
                ->when($request->has("category_id"),function($q)use($request){
                    return $q->where("category_id","like","%".$request->get("category_id")."%");})
                ->when($request->has("client_id"),function($q)use($request){
                    return $q->where("client_id","like","%".$request->get("client_id")."%");})
                ->when($request->has("end_date_orderby"),function($q)use($request){
                    return $q->orderby("end_date",$request->get("end_date_orderby"));})
                ->paginate(16);
        }else{
            $projects_data = Project::when($request->has("name"),function($q)use($request){
                return $q->where("name","like","%".$request->get("name")."%");})
                ->when($request->has("status"),function($q)use($request){
                    return $q->where("status","like","%".$request->get("status")."%");})
                ->when($request->has("priority"),function($q)use($request){
                    return $q->where("priority","like","%".$request->get("priority")."%");})
                ->when($request->has("start_date"),function($q)use($request){
                    return $q->where("start_date","like","%".$request->get("start_date")."%");})
                ->when($request->has("end_date"),function($q)use($request){
                    return $q->where("end_date","like","%".$request->get("end_date")."%");})
                ->when($request->has("category_id"),function($q)use($request){
                    return $q->where("category_id","like","%".$request->get("category_id")."%");})
                ->when($request->has("client_id"),function($q)use($request){
                    return $q->where("client_id","like","%".$request->get("client_id")."%");})
                ->when($request->has("end_date_orderby"),function($q)use($request){
                    return $q->orderby("end_date",$request->get("end_date_orderby"));})
                ->paginate(16);
        }

        $categories = Category::all();
        $clients = Client::all();
        return view('projects.index', compact('projects_data', 'categories', 'clients'));
    }

    public function viewStyle($styleDetail){
        session()->put('projectstyle', $styleDetail);
        return redirect()->back();
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $clients = Client::all();
        $users = User::all();
        return view('projects.create', compact('categories', 'clients', 'users'));
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
            'status' => 'required',
            'priority' => 'required',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'start_date.required' => 'Project စတင်သည့် ရက်စွဲ ထည့်ပေးရန်လိုအပ်သည်။',
            'status.required' => 'Project Status ထည့်ပေးရန်လိုအပ်သည်။',
            'priority.required' => 'Project Priority ထည့်ပေးရန်လိုအပ်သည်။',
            
        ]
        );

    

        $project = new Project();
        $project->name = $request->name;
        $project->category_id = $request->category_id;
        $project->client_id = $request->client_id;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->status = $request->status;
        $project->priority = $request->priority;
        $project->description = $request->description;
        $project->save();

        // User
        $project->users()->sync($request->users);

        // Sent Mail
        if(count($project->users)){

            foreach ($project->users as $value) {
                
                $email_data = array(
                    'userName'=>$value->name, 
                    'name'=>$project->name, 
                    'end_date'=>$project->end_date,
                );
                Mail::to($value->email)->send(new MailTask($email_data));
            }
            foreach ($project->users as $item) {
                $details = [
        
                    'greeting' => 'Hi'.'-'.$item->name,
                        
                    'data' => $item->name ." created a Project - ".$project->name,
    
                    'url' => route('projects.show', $project->id)
            
                ];
            
            $item->notify(new NotificationsComment($details));
            }

        }

        

        return redirect()->route('projects.show', $project->id)->with('success', 'Project အသစ်ကိုထည့်သွင်းပြီးပါပြီ။');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show.index', compact('project'));
    }

    public function showField($id, $field)
    {
        $project = Project::find($id);
        switch ($field) {
            case 'tasks':
                $tasks = Task::where('project_id', '=', $id)->orderby('created_at', 'asc')->paginate(12);
                return view('projects.show.tasks', compact('project', 'tasks'));
                break;

            case 'comments':
                $comments = Comment::where('commentable_id', $project->id)
                ->where('commentable_type', 'App\Models\Project')
                ->orderBy('created_at', 'asc')->get();
                return view('projects.show.comments', compact('project', 'comments'));
                break;

            case 'attachments':
                $attachments = Attachment::where('attachmentable_id', $project->id)
                ->where('attachmentable_type', 'App\Models\Project')
                ->orderBy('created_at', 'asc')->get();
                return view('projects.show.attachments', compact('project', 'attachments'));
                break;
            default:
                return redirect()->route('projects.show', $project->id);
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $categories = Category::all();
        $clients = Client::all();
        $users = User::all();
        return view('projects.update', compact('project','categories', 'clients', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'start_date' => 'required|max:255',
            'status' => 'required',
            'priority' => 'required',
        ]
        ,[
            'name.required' => 'နာမည်ထည့်ပေးရန် လိုအပ်ပါသည်။',
            'start_date.required' => 'Project စတင်သည့် ရက်စွဲ ထည့်ပေးရန်လိုအပ်သည်။',
            'status.required' => 'Project Status ထည့်ပေးရန်လိုအပ်သည်။',
            'priority.required' => 'Project Priority ထည့်ပေးရန်လိုအပ်သည်။',
            
        ]
        );

        $project->name = $request->name;
        $project->category_id = $request->category_id;
        $project->client_id = $request->client_id;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->status = $request->status;
        $project->priority = $request->priority;
        $project->description = $request->description;
        $project->save();

        // User
        $project->users()->sync($request->users);

        return redirect()->route('projects.index')->with('success', 'Project ကိုပြင်ဆင်ပြီးပါပြီ။');
    }


    public function storeAttachment(Request $request, $id){

        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg,zip,pdf,txt,ppt,docx,xlsx,psd,ps,eps,prn,xls,pptx,doc,ai|max:51200',
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
                
        $request->file('file')->move(public_path('/backend/images/projects/'), $fileName);

        $attachment = new Attachment();
        $attachment->asset = $fileName;
        $attachment->size = $size;
        $attachment->extension = $extension;
        $attachment->attachmentable_id = $id;
        $attachment->attachmentable_type = 'App\Models\Project';
        $attachment->user_id = Auth::user()->id;
  
        $attachment->save();
  
        return response()->json([
          'id' => $attachment->id
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if(count($project->tasks)){
            foreach ($project->tasks as $item) {
                if(count($item->comments)){
                    foreach ($item->comments as $value) {
                        Comment::where('id', '=', $value->id)->delete();
                    }
                }
                if(count($item->attachments)){
                    foreach ($item->attachments as $value) {
                        $attachmentTask = Attachment::find($value->id);
                        $del_main_image_path = public_path().'/backend/images/tasks/'.$attachmentTask->asset;
                        unlink($del_main_image_path);
                        $attachmentTask->delete();
                    }
                }
                $item->delete();
            }
        }

        if(count($project->comments)){
            foreach ($project->comments as $value) {
                Comment::where('id', '=', $value->id)->delete();
            }
        }
        if(count($project->attachments)){
            foreach ($project->attachments as $value) {
                $attachment = Attachment::find($value->id);
                $del_main_image_path = public_path().'/backend/images/projects/'.$attachment->asset;
                unlink($del_main_image_path);
                $attachment->delete();
            }
        }
        $project->delete();
        return redirect()->route('projects.index')->with('success','Project ကိုပယ်ဖျက်ပြီးပါပြီ။');
    }

    public function destroyAttachment($id){
        $attachment = Attachment::find($id);

        if($attachment->attachmentable_type == "App\Models\Project"){
            
            $del_main_image_path = public_path().'/backend/images/projects/'.$attachment->asset;
        }else{
            $del_main_image_path = public_path().'/backend/images/tasks/'.$attachment->asset;
        }
        
        unlink($del_main_image_path);
        $attachment->delete();

        return redirect()->back()->with('success', 'ပယ်ဖျက်ပြီးပါပြီ။');
    }
}
