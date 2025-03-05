<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreGallaryRequest;
use App\Http\Requests\Dashboard\UpdateGallaryRequest;
use App\Models\AddonService;
use App\Models\Gallary;
use Illuminate\Http\Request;

class GallaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('view_gallary');
        $Services    = AddonService::select('id', 'name_ar', 'name_en','description_en','description_ar')->get();

        if ($request->ajax()){


            return response(getModelData(model: new Gallary()));
        }
        else
            return view('dashboard.gallary.index', compact('Services' ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(StoreGallaryRequest $request)
    {
        $data = $request->validated();

        // Ensure images exist
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = uploadImageToDirectory($image, "gallary");
      // Generate unique name_ar and name_en values
      $name_ar = 'ar_' . time() . '_' . uniqid();
      $name_en = 'en_' . time() . '_' . uniqid();
                // Create a record for each image
                Gallary::create([
                    'image'   => $imagePath,
                    'name_ar' =>      $name_ar,
                    'name_en' =>      $name_en,
                ]);
            }
        }

        return response(["message" => "Gallery images uploaded successfully"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallary $gallary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallary $gallary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGallaryRequest $request, Gallary $gallary)
    {
        $data = $request->validated();
        if ($request->has('image'))
            $data['image'] = uploadImageToDirectory($request->file('image'), "gallary");

        $gallary->update($data);

        return response(["gallary updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Gallary $gallary)
    {

        $this->authorize('delete_gallary');
        $gallary->delete();
        return response(["Gallary deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {  dd($request);
         $this->authorize('delete_gallary');
       $parteners= Gallary::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected partener deleted successfully"]);
    }
}
