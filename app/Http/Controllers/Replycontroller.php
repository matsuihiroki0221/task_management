<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Replycontroller extends Controller
{
    public function index($commentid)
    {
        Log::info('Showing the  commentid for getreply:'.$commentid);
        $replies = Reply::where('reply_comment_parent',$commentid)
                    ->get();
        return $replies;
    }
    public function store(Request $request)
    {
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
}
