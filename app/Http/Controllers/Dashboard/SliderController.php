<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Slider;
use App\Models\NewsLetter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreSliderRequest;
use App\Http\Requests\Dashboard\UpdateSliderRequest;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_sliders');

        if ($request->ajax())
        {
            $slider = getModelData(model: new Slider());

            return response()->json($slider);
        }

        return view('dashboard.sliders.index');
    }

    public function show(Slider $slider)
    {
        $this->authorize('show_sliders');
        return view('dashboard.sliders.show', compact('slider'));
    }
    public function create()
    {
        $this->authorize('create_sliders');
        return view('dashboard.sliders.create');
    }



    public function store(StoreSliderRequest $request)
    {
        $this->authorize('create_sliders');
        $data           = $request->validated();
        $data['status'] = $request->has('status') ? $request->status : 0;

        $data['background'] = uploadImageToDirectory($request->file('background'), "Sliders");

        Slider::create($data);

        return response(["slider created successfully"]);
    }

    public function edit(Slider $slider)
    {
        $this->authorize('update_sliders');

        return view('dashboard.sliders.edit', compact('slider'));
    }


    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $this->authorize('update_sliders');
        $data           = $request->validated();
        $data['status'] = $request->has('status') ? $request->status : 0;
        if ($request->hasFile('background'))
        {
            deleteImageFromDirectory($request->background, 'Sliders');
            $data['background'] = uploadImageToDirectory($request->file('background'), "Sliders");
        }
        $slider->update($data);
        return response(["Slider update successfully"]);
    }

    public function destroy(Slider $slider)
    {
        $this->authorize('delete_sliders');

        $slider->delete();

        return response(["Slider deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_sliders');

        Slider::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected slider deleted successfully"]);
    }
}
