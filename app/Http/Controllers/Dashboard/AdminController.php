<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreAdminRequest;
use App\Http\Requests\Dashboard\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_admins');

        if ($request->ajax())
        {
            $data = getModelData(model: new Admin(), andsFilters: [['email', '!=', 'support@gmail.com']], relations: ['roles' => ['id', 'name_ar', 'name_en']]);
            return response()->json($data);
        }
        $roles = Role::get();

        return view('dashboard.admins.index', compact('roles'));
    }

    public function store(StoreAdminRequest $request)
    {
        $data = $request->validated();

        if ($request->has('image'))
            $data['image'] = uploadImageToDirectory($request->file('image'), "Admins");

        $admin = Admin::create($data);


        // $rolesAndDefaultOne = array_merge($request['roles'], ["2"]);

        $admin->roles()->attach($request['roles']);

    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $data = $request->validated();

        if ($request->has('image'))
            $data['image'] = updateModelImage($admin, $request->file('image'), "Admins");

        $admin->update($data);
        // $rolesAndDefaultOne = array_merge( $request['roles'] , [ "2" ] );
        $admin->roles()->sync($request['roles']);
    }

    public function destroy(Request $request, Admin $admin)
    {
        $this->authorize('delete_admins');

        if ($request->ajax())
            $admin->delete();
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_admins');
        abort_if(in_array(1, $request->selected_items_ids), '404', "!لا يمكن حذف الحساب الرئيسى");

        Admin::whereIn('id', $request->selected_items_ids)->delete();
        return response(["selected admins deleted successfully"]);
    }

    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_admins');
        Admin::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected admins restored successfully"]);
    }

}
