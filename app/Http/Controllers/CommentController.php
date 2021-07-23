<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function index($taskid)
    {
        Log::info('Showing the  taskid for getcomment:'.$taskid);
        $comments = Comment::join('users', 'comments.user_id','=','users.id')
                    ->where('task_id',$taskid)
                    ->get(["comments.id as commentid","comment_body",'comments.created_at as comment_created_at','name']);
        return $comments;
    }
    public function store(Request $request)
    {
        return Comment::create($request->all());
    }
    public function update(Request $request, Comment $comment)
    {
        $comment->update($request->all());

        return $comment;
    }
    public function delete(Comment $comment)
    {
        $comment->delete();

        return $comment;
    }
}
