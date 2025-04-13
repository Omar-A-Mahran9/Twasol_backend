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


    public function store(StoreAddonRequest $request)
    {
        $data = $request->validated();
         if ($request->hasFile('image')) {
            $data['image'] = uploadImageToDirectory($request->file('image'), "Services");
        }

        if ($request->hasFile('icon')) {
            $data['icon'] = uploadImageToDirectory($request->file('icon'), "Services");
        }

        $data['is_publish'] = $request->has('is_publish') ? 1 : 0;

        $addon = AddonService::create($data);


    }



    public function update(UpdateAddonRequest $request, AddonService $addon)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = uploadImageToDirectory($request->file('image'), "Services");
        }

        if ($request->hasFile('icon')) {
            $data['icon'] = uploadImageToDirectory($request->file('icon'), "Services");
        }

        $data['is_publish'] = $request->has('is_publish') ? 1 : 0;

        $addon->update($data);

  
    }




    public function destroy($id)
    {
$addonService=AddonService::find($id);
        $this->authorize('delete_addonService');
        $addonService->delete();
        return response(["sec deleted successfully"]);

    }
}
