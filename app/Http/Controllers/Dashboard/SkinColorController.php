<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreSkinColorRequest;
use App\Http\Requests\Dashboard\UpdateSkinColorRequest;
use App\Models\SkinColor;
use Illuminate\Http\Request;

class SkinColorController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_colors');

        if ($request->ajax())
        {
            $skinColors = getModelData(model: new SkinColor());

            return response()->json($skinColors);
        }

        return view('dashboard.skin-colors.index');
    }

    public function store(StoreSkinColorRequest $request)
    {
        SkinColor::create($request->validated());

        return response(["skin color created successfully"]);
    }

    public function update(UpdateSkinColorRequest $request, SkinColor $skinColor)
    {
        $skinColor->update($request->validated());

        return response(["skin color updated successfully"]);
    }

    public function destroy(SkinColor $skinColor)
    {
        $this->authorize('delete_colors');

        $skinColor->delete();

        return response(["skin color deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_colors');

        SkinColor::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected skin colors deleted successfully"]);
    }

    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_colors');

        SkinColor::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected skin colors restored successfully"]);
    }
}
