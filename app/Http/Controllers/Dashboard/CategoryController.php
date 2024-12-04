<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CategorySubCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCategoryRequest;
use App\Http\Requests\Dashboard\UpdateCategoryRequest;

use function PHPSTORM_META\type;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_categories');
        $params = request()->all();

        if ($request->ajax()) {
            if ($request['type'] == 'parent') {
                $data = getModelData(model: new Category());
            } else {
                $data = getModelData(model: new SubCategory(), relations: ['categories' => ['id', 'name_ar', 'name_en', 'description_ar', 'description_en', 'created_at']]);
            }
            return response()->json($data);
        }

        return view('dashboard.categories.index');
    }

    public function store(StoreCategoryRequest $request)
    {
         $this->authorize('create_categories');
        if($request->type=='parent'){
             $data          = $request->except('parent_id', 'category_type', 'type');
             if (!$request->show_in_home) {
                $data['show_in_home'] = 0;
            }
            $data['image'] = uploadImageToDirectory($request->file('image'), "Categories");
            $category = Category::create($data); 
        }
        else{
            $data          = $request->except('parent_id', 'category_type', 'type','show_in_home');
    
            $data['image'] = uploadImageToDirectory($request->file('image'), "Categories");
            $subCategory = SubCategory::create($data);
            $subCategory->categories()->attach($request['parent_id']);
        }
  
        return response(["Category created successfully"]);
    }

    public function update(UpdateCategoryRequest $request, $subCategory)
    {
        $this->authorize('update_categories');
        if($request->type=='parent'){
            $data          = $request->except('parent_id', 'category_type', 'type');
            if (!$request->show_in_home) {
               $data['show_in_home'] = 0;
           }
           if ($request->has('image'))
           $data['image'] = uploadImageToDirectory($request->file('image'), "Categories");
           $Category = Category::find($subCategory);
           $Category->update($data);
         }
        else{
            $data          = $request->except('parent_id', 'category_type', 'type');
        
            if ($request->has('image'))
                $data['image'] = uploadImageToDirectory($request->file('image'), "Categories");
            $subCategory = SubCategory::find($subCategory);
            $subCategory->update($data);
            $subCategory->categories()->sync($request['parent_id']);
    
        }

        return response(["Category updated successfully"]);
    }

    public function destroy(SubCategory $category)
    {
        dd($category);
        $this->authorize('delete_categories');

        // if ($category->products()->count() > 0) {
        //     $products = $category->products->map(function ($product) {
        //         return [
        //             'name' => $product->name
        //         ];
        //     });

        //     return response()->json([
        //         'message' => __('This category cannot be deleted because it has products') . '( ' . $products . ' )'
        //     ], 422);
        // }
        $category->delete();

        return response(["Category deleted successfully"]);
    }

    public function parentCategories()
    {
        $parentCategories = Category::whereNull('parent_id')->get();

        return response()->json([
            'parentCategories' => $parentCategories
        ]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_categories');

        SubCategory::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected categories deleted successfully"]);
    }

    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_categories');

        SubCategory::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected categories restored successfully"]);
    }
}
