<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function index($taskid)
    {
        Log::info('Showing the  taskid for getcomment:'.$taskid);
        $comments = Comment::where('task_id',$taskid)
                    ->get();
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
