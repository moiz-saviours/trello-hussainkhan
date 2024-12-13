<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class BrandController extends Controller
{


    public function index(Request $request)
    {
        $brandKey = $request->input('brandKey');


        $brands = $brandKey
            //? Brand::where('code', $brandKey)->with('getLogs')->get() 
            ? Brand::where('code', $brandKey)
            : Brand::with('getLogs')->get();
        //return response()->json(['data'=>$brands],200);

       if ($request->expectsJson())
       {
        return response()->json(['brands'=>$brands,'brandsKey'=>$brandKey]);
       }
        return view('brands.index', compact('brands', 'brandKey'));
    }


    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        $brand = Brand::create([
            'name' => $request->name,
            'code' => $request->code,
            'url' => $request->url,
            'image' => $imageName,
            'is_active' => $request->is_active ?? true,  // Default to active

        ]);



        return response()->json($brand);
    }
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($brand->image && file_exists(public_path('images/' . $brand->image))) {
                unlink(public_path('images/' . $brand->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = $brand->image;
        }

        $brand->update([
            'name' => $request->name,
            'code' => $request->code,
            'url' => $request->url,
            'image' => $imageName,
            'is_active' => $request->is_active ?? $brand->is_active,

        ]);


        return response()->json($brand);
    }


    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return response()->json(['success' => 'Brand deleted successfully']);
    }

    public function toggleStatus(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->is_active = $request->is_active;
        $brand->save();

        return response()->json(['success' => 'Status updated successfully']);
    }
}
