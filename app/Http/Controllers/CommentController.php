<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCommentRequest;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function addComment(Article $news, AddCommentRequest $request){

        $comment=$news->comments()->create($request->all());
        return response()->json(['comment'=>$request->all()],200);

    }

}
