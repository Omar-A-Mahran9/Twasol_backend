<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCommonQuestionRequest;
use App\Http\Requests\Dashboard\UpdateCommonQuestionRequest;
use App\Models\CommonQuestion;
use Illuminate\Http\Request;

class CommonQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $count_CommonQuestion = CommonQuestion::count(); // Get the count of blogs
         $visited_site=10000;
         if ($request->ajax())
            return response(getModelData(model: new CommonQuestion()));
        else
            return view('dashboard.CommonQuestion.index',compact('count_CommonQuestion','visited_site'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommonQuestionRequest $request)
    {
        $data = $request->validated();

        $CommonQuestion = CommonQuestion::create($data);

        return response(["Common Question created successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CommonQuestion $commonQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommonQuestion $commonQuestion)
    {
        //
    }

    public function update(UpdateCommonQuestionRequest $request, CommonQuestion $CommonQuestion)
    {
        $this->authorize('update_CommonQuestion');

         $data = $request->validated();
       
        $CommonQuestion->update($data);

        return response(["CommonQuestion updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommonQuestion $CommonQuestion)
    {
        $this->authorize('delete_CommonQuestion');
        $CommonQuestion->delete();
        return response(["Common Question deleted successfully"]);
    }
}
