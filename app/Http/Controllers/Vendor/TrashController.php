<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;

class TrashController extends Controller
{
    private static array $relations = [
        'Admin' => ['roles' => ['id', 'name_ar', 'name_en']],
    ];

    public function index($modelName = 'Admin')
    {
        $this->authorize('view_recycle_bin');

        if (request()->ajax())
        {

            $model = app('App\\Models\\' . $modelName);
            $data  = getModelData(model: $model, relations: TrashController::$relations[$modelName], onlyTrashed: true);

            return response()->json($data);
        }

        return view('dashboard.settings.trash');
    }


    public function forceDelete($modelName, $id)
    {
        $this->authorize('delete_recycle_bin');

        $model = app('App\\Models\\' . $modelName);
        $model->onlyTrashed()->find($id)->forceDelete();
    }

    public function restore($modelName, $id)
    {
        // $this->authorize('restore_recycle_bin');
        $model = app('App\\Models\\' . $modelName);
        $model->onlyTrashed()->find($id)->restore();

        // return response()->json($model->find($id));

    }

}