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

    public function update(UpdateWhyusRequest $request, Whyus $blog)
    {
         $data = $request->validated();
        if ($request->has('image'))
            $data['image'] = uploadImageToDirectory($request->file('image'), "Whyus");

        $blog->update($data);

     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Whyus $whyus)
    {
        $this->authorize('delete_whyus');
        $whyus->delete();
        return response(["whyus deleted successfully"]);
    }


    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_whyus');

        Whyus::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected services deleted successfully"]);
    }

    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_whyus');
        Whyus::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected services restored successfully"]);
    }
}
