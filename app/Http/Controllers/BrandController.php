<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Str;
use DataTables;
class BrandController extends Controller
{
    public function index (Request $request){
        
        if($request->ajax()){
           $brand_image_path_directory = asset('brand_images');
           $brands = DB::table('brands')->get();

           return DataTables::of($brands)
                  ->addIndexColumn()
                  ->editColumn('brand_logo',function ($row) use($brand_image_path_directory){
                      return '<img src="'.$brand_image_path_directory.'/'.$row->brand_logo.'"  height="50px" width="50px">';
                  })
                  ->addColumn('action',function ($row){
                      $actionBtn = '
                        <a  class="btn btn-outline-info btn-sm brand_edit_button"  data-toggle="modal" data-target="#edit_brand_modal" data-id="' .$row->id. '"><i class="fa fa-pencil-square-o"></i></a>
                        <a  class="btn btn-outline-danger btn-sm brand_delete_button" data-id="' .$row->id. '"><i class="fa fa-trash"></i></a>
                      ';

                      return $actionBtn;
                  })
                  ->rawColumns(['action','brand_logo'])
                  ->make(true);
        }else{
            $pageName = "Brands";
            return view('admin.brands.brands',compact('pageName'));
        }

        
    }







    public function store (Request $request){
        $validation =$request->validate([
            'brand_name'=>'required|unique:brands',
            'brand_logo' => 'required|image|mimes:jpeg,png,jpg'
        ]);
        
        $originalImage= $request->file('brand_logo');
        $thumbnailImage = Image::make($originalImage);
        $originalPath = public_path().'/brand_images/';
        $thumbnailImage->resize(200,200);
        $imageName = time().$originalImage->getClientOriginalName();
        $thumbnailImage->save($originalPath. $imageName);



        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = Str::slug($request->brand_name);
        $brand->brand_logo = $imageName;

        $brand->save();

        return redirect()->back()->with('message','Brand created successfully.');
    }





    public function edit(Request $request){
        $brand = Brand::find($request->id);
        return response()->json($brand);
    }




    public function update (Request  $request){
        $request->validate([
           'brand_name_edit'=>'required'
        ]);

        $brand = Brand::find($request->brand_id);

        $old_brand_logo = $brand->brand_logo;

        


        if($request->brand_logo_edit){

            if (file_exists(public_path('brand_images/' . $old_brand_logo))) {
                unlink(public_path('brand_images/' . $old_brand_logo));
            }

            $originalImage= $request->brand_logo_edit;
            $thumbnailImage = Image::make($originalImage);
            $originalPath = public_path().'/brand_images/';
            $thumbnailImage->resize(200,200);
            $imageName = time().$originalImage->getClientOriginalName();
            $thumbnailImage->save($originalPath. $imageName);

            $brand->brand_name = $request->brand_name_edit;
            $brand->brand_slug = Str::slug($request->brand_name_edit);
            $brand->brand_logo = $imageName;
    
            $brand->save();
    
            return response()->json(['message'=>'Successfully brand updated']);

        }else{

            $brand->brand_name = $request->brand_name_edit;
            $brand->brand_slug = Str::slug($request->brand_name_edit);
            $brand->brand_logo = $old_brand_logo;
    
            $brand->save();
    
            return response()->json(['message'=>'Successfully brand updated']);
        }
        
    }










    public function delete (Request $request){
        $brand = Brand::find($request->id);

        if (file_exists(public_path('brand_images/' . $brand->brand_logo))) {
            unlink(public_path('brand_images/' . $brand->brand_logo));
        }

        $brand->delete();

        return response()->json(['message'=>'Brand deleted successfully']);
        
    }



}
