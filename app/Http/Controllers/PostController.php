<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.all_post', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Category::all();

        return view('admin.post.add_post',['cats'=>$cats]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
        ]);

        // thumb
        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumbEXT = time() . '.' . $thumb->getClientOriginalExtension();
            $path = public_path('/images/thumb');
            $thumb->move($path, $thumbEXT);
        }else{
            $thumbEXT='na';
        }

           // full_img
        if ($request->hasFile('full_img')) {
            $full_img = $request->file('full_img');
            $full_imgEXT = time() . '.' . $full_img->getClientOriginalExtension();
            $path = public_path('/images/full_img');
            $full_img->move($path, $full_imgEXT);
        }else{
            $full_imgEXT='na';
        }


        $post = new Post;
        $post->user_id = 0;
        $post->cat_id = $request->category;
        $post->title = $request->title;
        $post->details = $request->details;
        $post->tag = $request->tag;
        $post->thumb = $thumbEXT;
        $post->full_img = $full_imgEXT;
        $post->save();

        return redirect()->route('post.create')->with('message', 'Post Successfully Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cats = Category::all();
        $post = Post::find($id);
        return view('admin.post.edit_post', compact('post','cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        // thumb
        if ($request->hasFile('thumb')) {
            $post = Post::findOrFail($id);
            if (file_exists(public_path('images/thumb/'.$post->thumb))) {
                unlink(public_path('images/thumb/'.$post->thumb));
            } else {
                $thumb = $request->file('thumb');
                $thumbEXT = time() . '.' . $thumb->getClientOriginalExtension();
                $path = public_path('/images/thumb');
                $thumb->move($path, $thumbEXT);
            }

        }else{
            $thumbEXT = $request->thumb;
        }

           // full_img
        if ($request->hasFile('full_img')) {
            $post = Post::findOrFail($id);
            if (file_exists(public_path('images/full_img/'.$post->full_img))) {
                unlink(public_path('images/full_img/'.$post->full_img));
            } else {
                $full_img = $request->file('full_img');
                $full_imgEXT = time() . '.' . $full_img->getClientOriginalExtension();
                $path = public_path('/images/full_img');
                $full_img->move($path, $full_imgEXT);
            }

        }else{
            $full_imgEXT = $request->full_img;
        }


        $post = Post::find($id);
        $post->user_id = 0;
        $post->cat_id = $request->category;
        $post->title = $request->title;
        $post->details = $request->details;
        $post->tag = $request->tag;
        $post->thumb = $thumbEXT;
        $post->full_img = $full_imgEXT;
        $post->update();

        return redirect()->back()->with('message', 'Post Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // thumb
        $post = Post::findOrFail($id);
        if (file_exists(public_path('images/thumb/'.$post->thumb))) {
            unlink(public_path('images/thumb/'.$post->thumb));
        } else {
            dd('File does not exists.');
        }
        // full_img
        $post = Post::findOrFail($id);
        if (file_exists(public_path('images/full_img/'.$post->full_img))) {
            unlink(public_path('images/full_img/'.$post->full_img));
        } else {
            dd('File does not exists.');
        }


        $post->delete();

        return redirect()->route('post.index')->with('message', 'Post Successfully Deleted!');
    }
}
