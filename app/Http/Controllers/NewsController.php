<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCommentRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Http;
use App\Models\Post;




class NewsController extends Controller
{


    public function getNews(){
        $news= Article::all();
        return response()->json(['news'=>$news],200);
    }

    public function getSingleNews($news){

        $news=Article::where('id','=',$news)->with('comments')->get();
        return response()->json(['news'=>$news],200);

    }

    public function update( Article  $news,UpdateNewsRequest $request){
        $news->update($request->all());

        if ($request->file('file')) {
           $news->addMediaFromRequest('file')->toMediaCollection();
        }

        return response()->json(['message'=>"News updated"],200);

    }

    public function delete( Article  $news){
        $news->delete();
        return response()->json(['message'=>"News has been deleted"],200);

    }




}

