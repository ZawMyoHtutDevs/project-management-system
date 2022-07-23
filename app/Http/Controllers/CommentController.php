<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use App\Notifications\Comment as NotificationsComment;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Notifications\Notification;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'comment' => 'required',
            'id' => 'required',
            'type' => 'required',
        ]
        ,[
            'comment.required' => 'Comment ထည့်ပေးရန် လိုအပ်ပါသည်။',
        ]
        );

    

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->commentable_id = $request->id;
        $comment->commentable_type = $request->type;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        if($request->type == "App\Models\Project") {
            $user = Project::find($request->id);
            foreach ($user->users as $item) {
                $details = [
    
                    'greeting' => 'Hi'.'-'.$item->name,
        
                    'body' => $comment->comment,
                    
                    'data' => $item->name ." wrote a comment in"." Project ".$user->name,
                    
                    'url' => route('projects.index').'/'.$user->id.'/comments'
        
                ];
        
                $item->notify(new NotificationsComment($details));
            }
        }elseif($request->type == "App\Models\Task"){
            $user = Task::find($request->id);
            foreach ($user->users as $item) {
                $details = [
    
                    'greeting' => 'Hi'.'-'.$item->name,
        
                    'body' => $comment->comment,
                    
                    'data' => $item->name ." wrote a comment in"." Task ".$user->name,

                    'url' => route('tasks.index').'/'.$user->id.'/comments'
        
                ];
        
                $item->notify(new NotificationsComment($details));
            }
        }

        return redirect()->back()->with('success', 'Comment ရေးသားပြီးပါပြီ။');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
