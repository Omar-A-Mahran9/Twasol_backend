<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
 use App\Http\Requests\Dashboard\StoreHowuseRequest;
use App\Http\Requests\Dashboard\UpdateHowuseRequest;
 use App\Models\Howuse;
 use Illuminate\Http\Request;

class HowuseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $howuseCount = Howuse::count();

          if ($request->ajax())
            return response(getModelData(model: new Howuse()));
        else
            return view('dashboard.howuse.index',compact('howuseCount'));
    }


    public function store(StoreHowuseRequest $request)
    {
        if (Howuse::count() > 4) {
            return redirect()->back()->with('error', __('You can only add up to 3 Howuse records.'));
        }

        $data          = $request->validated();
        $data['image'] = uploadImageToDirectory($request->file('image'), "Howuse");

         Howuse::create($data);

     }

    public function update(UpdateHowuseRequest $request,  $id)
    {
        $howuse = Howuse::findOrFail($id);

         $data = $request->validated();
        if ($request->has('image'))
            $data['image'] = uploadImageToDirectory($request->file('image'), "Howuse");

        $howuse->update($data);

     }


     public function destroy($id)
     {
         $this->authorize('delete_howuse');

         $howuse = Howuse::findOrFail($id);
         $howuse->delete();

         return response(["message" => "howuse deleted successfully"], 200);
     }

     public function deleteSelected(Request $request)
     {
         $this->authorize('delete_howuse');

         $ids = $request->selected_items_ids;

         if (empty($ids)) {
             return response(["message" => "No items selected for deletion"], 400);
         }

         Howuse::whereIn('id', $ids)->delete();

         return response(["message" => "Selected services deleted successfully"], 200);
     }

     public function restoreSelected(Request $request)
     {
         $this->authorize('delete_howuse');

         $ids = $request->selected_items_ids;

         if (empty($ids)) {
             return response(["message" => "No items selected for restoration"], 400);
         }

         Howuse::withTrashed()->whereIn('id', $ids)->restore();

         return response(["message" => "Selected services restored successfully"], 200);
     }

}
