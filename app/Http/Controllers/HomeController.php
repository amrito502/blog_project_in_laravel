<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
class HomeController extends Controller
{
    public function home(Request $request)
    {
        if ($request->has('q')) {
            $q = $request->q;
            $posts = Post::where('title', 'like', '%' . $q . '%')->orderBy('id', 'desc')->paginate(1);
        } else {
            $posts = Post::orderBy('id', 'desc')->paginate(1);
        }

        return view('home', compact('posts'));
    }


    // post details
    public function details(Request $request , $postId)
    {
        $detail = Post::find($postId);
        return view('detail', compact('detail'));
    }
    // comment
    public function save_comment(Request $request, $id){
        $request->validate([
            'comment' => 'required'
        ]);
        $data = new Comment;
        $data->user_id = $request->user()->id;
        $data->post_id = $id;
        $data->comment = $request->comment;
        $data->save();

        return redirect()->back()->with('message','Comment Successfully Added!');


    }
}
