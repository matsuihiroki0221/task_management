<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Log;

class ReplyController extends Controller
{
    public function index($commentid)
    {
        Log::info('Showing the  commentid for getreply:'.$commentid);
        $replies = Reply::join('users','replies.reply_user_id', '=','users.id')
                ->where('reply_comment_parent',$commentid)
                ->get(["replies.id as replyid","reply_body","reply_user_id","reply_comment_parent",'name']);
        return $replies;
    }
    public function store(Request $request)
    {
        Log::info('Showing the reply:'.$request);
        return Reply::create($request->all());
    }
    public function update(Request $request, Reply $reply)
    {
        $reply->update($request->all());

        return $reply;
    }
    public function delete(Reply $reply)
    {
        $reply->delete();

        return  $reply;
    }
    public function getsumofcomment($commentid)
    {
        $count = Reply::where('reply_comment_parent',$commentid)->count();
        return $count;
    }
}
