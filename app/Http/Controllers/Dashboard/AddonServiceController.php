<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreAddonRequest;
use App\Http\Requests\Dashboard\UpdateAddonRequest;
use App\Models\AddonService;
use Illuminate\Http\Request;

class AddonServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {        
         $count_addon = AddonService::count(); // Get the count of blogs
         $visited_site=10000;
         if ($request->ajax()){
             return response(getModelData(model: new AddonService()));
        }
        else
             return view('dashboard.addon.index',compact('count_addon','visited_site'));
    }

    /**view_addonService
     * Show the form for creating a new resource.
     */
    public function store(StoreAddonRequest $request)
    {
        dd($request);
        $data = $request->validated();
        $data['image'] = uploadImageToDirectory($request->file('image'), "Services");

        $addon = AddonService::create($data);

        return response(["services created successfully"]);
    }
 
    public function show(AddonService $addonService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AddonService $addonService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddonRequest $request, AddonService $addon)
    {
         $data = $request->validated();
         if ($request->has('image'))
            $data['image'] = uploadImageToDirectory($request->file('image'), "Services");
        $addon->update($data);

        return response(["brand updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AddonService $addonService)
    {
 
        $this->authorize('delete_addonService');
        $addonService->delete();
        return response(["sec deleted successfully"]);
 
    }
}
