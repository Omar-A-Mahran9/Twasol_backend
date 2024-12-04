<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreBlogRequest;
use App\Http\Requests\Dashboard\UpdateBlogRequest;
use App\Models\blogs;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $count_blogs = blogs::count(); // Get the count of blogs
         $visited_site=10000;
         if ($request->ajax())
            return response(getModelData(model: new blogs()));
        else
            return view('dashboard.blogs.index',compact('count_blogs','visited_site'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $data          = $request->validated();
        $data['image'] = uploadImageToDirectory($request->file('image'), "Brands");

        $brand = blogs::create($data);

        return response(["blog created successfully"]);
    }
    /**
     * Display the specified resource.
     */
    public function show(blogs $blogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(blogs $blogs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, blogs $blog)
    {
         $data = $request->validated();
        if ($request->has('image'))
            $data['image'] = uploadImageToDirectory($request->file('image'), "Brands");

        $blog->update($data);

        return response(["brand updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(blogs $blog)
    {
        $this->authorize('delete_blogs');
        $blog->delete();
        return response(["blog deleted successfully"]);
    }
}
