<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreBlogRequest;
use App\Http\Requests\Dashboard\StoreWhyusRequest;
use App\Http\Requests\Dashboard\UpdateBlogRequest;
use App\Http\Requests\Dashboard\UpdateWhyusRequest;
use App\Models\Whyus;
use Illuminate\Http\Request;

class WhyusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
          if ($request->ajax())
            return response(getModelData(model: new Whyus()));
        else
            return view('dashboard.whyus.index');
    }


    public function store(StoreWhyusRequest $request)
    {
        $data          = $request->validated();
        $data['image'] = uploadImageToDirectory($request->file('image'), "Whyus");

        $brand = Whyus::create($data);

     }

    public function update(UpdateWhyusRequest $request,  $id)
    {
        $whyus = Whyus::findOrFail($id);

         $data = $request->validated();
        if ($request->has('image'))
            $data['image'] = uploadImageToDirectory($request->file('image'), "Whyus");

        $whyus->update($data);

     }


     public function destroy($id)
     {
         $this->authorize('delete_whyus');

         $whyus = Whyus::findOrFail($id);
         $whyus->delete();

         return response(["message" => "Whyus deleted successfully"], 200);
     }

     public function deleteSelected(Request $request)
     {
         $this->authorize('delete_whyus');

         $ids = $request->selected_items_ids;

         if (empty($ids)) {
             return response(["message" => "No items selected for deletion"], 400);
         }

         Whyus::whereIn('id', $ids)->delete();

         return response(["message" => "Selected services deleted successfully"], 200);
     }

     public function restoreSelected(Request $request)
     {
         $this->authorize('delete_whyus');

         $ids = $request->selected_items_ids;

         if (empty($ids)) {
             return response(["message" => "No items selected for restoration"], 400);
         }

         Whyus::withTrashed()->whereIn('id', $ids)->restore();

         return response(["message" => "Selected services restored successfully"], 200);
     }

}
