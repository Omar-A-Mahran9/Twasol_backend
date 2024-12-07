<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorePartnerRequest;
use App\Http\Requests\Dashboard\UpdatePrtnerRequest;
use App\Models\partener;
use Illuminate\Http\Request;

class PartenerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('view_partener');
        if ($request->ajax()){
      

            return response(getModelData(model: new partener()));
        }
        else
            return view('dashboard.partner.index');
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
    public function store(StorePartnerRequest $request)
    {

        $data          = $request->validated();
        $data['image'] = uploadImageToDirectory($request->file('image'), "partner");

         partener::create($data);

        return response(["aware created successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(partener $partener)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(partener $partener)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
 
     public function update(UpdatePrtnerRequest $request, partener $partener)
     {
         $data = $request->validated();
         $partener = request()->route('partner');

    $partenerData=partener::find($partener);

         if ($request->has('image'))
             $data['image'] = uploadImageToDirectory($request->file('image'), "partner");
 
         $partenerData->update($data);
 
         return response(["partner updated successfully"]);
     }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(partener $brand)
    {
        $partener = request()->route('partner');
        $partenerData=partener::find($partener);

        $this->authorize('delete_partener');
        $partenerData->delete();
        return response(["partener deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
         $this->authorize('delete_partener');
       $parteners= partener::whereIn('id', $request->selected_items_ids)->delete();
        return response(["selected partener deleted successfully"]);
    }
}
