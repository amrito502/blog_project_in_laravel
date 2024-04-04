<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add_category');
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
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imgEXT = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/images');
            $image->move($path, $imgEXT);
        }

        $category = new Category;
        $category->title = $request->title;
        $category->details = $request->details;
        $category->image = $imgEXT;
        $category->save();

        return redirect()->route('category.create')->with('message', 'Category Successfully Created!');
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
        $category = Category::findOrFail($id);
        return view('admin.category.edit_category', compact('category'));
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

        if ($request->hasFile('image')) {
            $category = Category::findOrFail($id);
            if (file_exists(public_path('images/'.$category->image))) {
                unlink(public_path('images/'.$category->image));
            } else {
                dd('File does not exists.');
            }
            $image = $request->file('image');
            $imgEXT = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/images');
            $image->move($path, $imgEXT);
        } else {
            $imgEXT = $request->image;
        }

        $category = Category::find($id);
        $category->title = $request->title;
        $category->details = $request->details;
        $category->image = $imgEXT;
        $category->update();

        return redirect()->back()->with('message', 'Category Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if (file_exists(public_path('images/'.$category->image))) {
            unlink(public_path('images/'.$category->image));
        } else {
            dd('File does not exists.');
        }
        $category->delete();

        return redirect()->route('category.index')->with('message', 'Category Successfully Deleted!');
    }
}
