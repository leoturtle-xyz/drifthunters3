<?php

namespace App\Http\Controllers\Admin;

use App\BasicExtended;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Pcategory;
use App\Language;
use App\Megamenu;
use Validator;
use Session;

class ProductCategory extends Controller
{
    public function index(Request $request)
    {
        $data['pcategories'] = Pcategory::orderBy('id', 'DESC')->paginate(10);

        return view('admin.product.category.index',$data);
    }


    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|max:255',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }


        $data = new Pcategory;
        $input = $request->all();
        $input['slug'] =  make_slug($request->name);
        $data->create($input);

        Session::flash('success', 'Category added successfully!');
        return "success";
    }


    public function edit($id)
    {
        $data = Pcategory::findOrFail($id);
        return view('admin.product.category.edit',compact('data'));
    }

    public function update(Request $request)
    {

        $rules = [
            'name' => 'required|max:255',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $data = Pcategory::findOrFail($request->category_id);
        $input = $request->all();
        $input['slug'] =  make_slug($request->name);
        $data->update($input);

        Session::flash('success', 'Category Update successfully!');
        return "success";
    }

    public function deleteFromMegaMenu($category) {
        $megamenu = Megamenu::where('category', 1)->where('type', 'products');
        if ($megamenu->count() > 0) {
            $megamenu = $megamenu->first();
            $menus = json_decode($megamenu->menus, true);
            $catId = $category->id;
            if (is_array($menus) && array_key_exists("$catId", $menus)) {
                unset($menus["$catId"]);
                $megamenu->menus = json_encode($menus);
                $megamenu->save();
            }
        }
    }


    public function feature(Request $request)
    {
        $category = Pcategory::findOrFail($request->category_id);
        $category->is_feature = $request->is_feature;
        $category->save();

        if ($request->is_feature == 1) {
            Session::flash('success', 'Category featured successfully!');
        } else {
            Session::flash('success', 'Category unfeatured successfully!');
        }
        return back();
    }


    public function home(Request $request)
    {
        $category = Pcategory::findOrFail($request->category_id);
        $category->products_in_home = $request->products_in_home;
        $category->save();

        if ($request->products_in_home == 1) {
            Session::flash('success', 'Products of this category will be available in Home Page!');
        } else {
            Session::flash('success', 'Products of this category will be unavailable in Home Page!');
        }

        
        return back();
    }


    public function delete(Request $request)
    {
        $category = Pcategory::findOrFail($request->category_id);
        if ($category->products()->count() > 0) {
            Session::flash('warning', 'First, delete all the product under the selected categories!');
            return back();
        }

        $this->deleteFromMegaMenu($category);

        $category->delete();

        Session::flash('success', 'Category deleted successfully!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $pcategory = Pcategory::findOrFail($id);
            if ($pcategory->products()->count() > 0) {
                Session::flash('warning', 'First, delete all the product under the selected categories!');
                return "success";
            }
        }

        foreach ($ids as $id) {
            $pcategory = Pcategory::findOrFail($id);

            $this->deleteFromMegaMenu($pcategory);

            $pcategory->delete();
        }

        Session::flash('success', 'product categories deleted successfully!');
        return "success";
    }

}
