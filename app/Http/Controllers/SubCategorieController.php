<?php

namespace App\Http\Controllers;

use App\Models\ParentCategorie;
use App\Models\SubCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Str;
class SubCategorieController extends Controller
{
    public function index (){
        $pageName = "Sub-CategorieS";
        $parent_categories = DB::table('parent_categories')->select('id','parent_categorie_name')->get();
        $sub_categories = DB::table('sub_categories')
        ->join('parent_categories','parent_categorie_id','=','parent_categories.id')
        ->select('parent_categories.parent_categorie_name','sub_categories.*')->get();
        return view('admin.categories.subcategories.sub_categorie',compact('pageName','parent_categories','sub_categories'));
    }







    public function store (Request $request){
        $request->validate([
            'parent_categorie_id'=>'required',
            'sub_categorie_name'=>'required',
            'sub_categorie_image'=>'required|image|mimes:jpg,jpeg,png,svg'
        ]);

        
      
        $originalImage= $request->file('sub_categorie_image');
        $thumbnailImage = Image::make($originalImage);
        $originalPath = public_path().'/sub_categorie_imgaes/';
        $thumbnailImage->resize(200,200);
        $imageName = time().$originalImage->getClientOriginalName();
        $thumbnailImage->save($originalPath. $imageName);


        $sub_categorie = new SubCategorie();
        $sub_categorie->parent_categorie_id = $request->parent_categorie_id;
        $sub_categorie->sub_categorie_name = $request->sub_categorie_name;
        $sub_categorie->sub_categorie_slug = Str::slug($request->sub_categorie_name);
        $sub_categorie->sub_categorie_description = $request->sub_categorie_description;
        $sub_categorie->sub_categorie_image = $imageName;
        $sub_categorie->save();

        return redirect()->back()->with('message','Sub-Categorie created successfully.');

     

    }
    


    public function edit ($id){
        $pageName = "Sub-Categorie-Edit";
        $parent_categories = ParentCategorie::all();
        $sub_categorie = DB::table('sub_categories')
        ->join('parent_categories','sub_categories.parent_categorie_id','=','parent_categories.id')
        ->select('parent_categories.id','parent_categories.parent_categorie_name','sub_categories.*')
        ->where('sub_categories.id','=',$id)
        ->first();
        return view ('admin.categories.subcategories.edit_sub_categorie',compact('pageName','sub_categorie','parent_categories'));
    }






    public function update (Request $request,$id){
        $request->validate([
            'parent_categorie_id'=>'required',
            'sub_categorie_name'=>'required',
            'sub_categorie_image'=>'image|mimes:jpg,jpeg,png,svg'
        ]);
        
        $sub_categorie = SubCategorie::find($id);

        if($request->file('sub_categorie_image')){
           
            if (file_exists(public_path('sub_categorie_imgaes/' . $sub_categorie->sub_categorie_image))) {
                unlink(public_path('sub_categorie_imgaes/' . $sub_categorie->sub_categorie_image));
            }
            

            $originalImage= $request->file('sub_categorie_image');
            $thumbnailImage = Image::make($originalImage);
            $originalPath = public_path().'/sub_categorie_imgaes/';
            $thumbnailImage->resize(200,200);
            $imageName = time().$originalImage->getClientOriginalName();
            $thumbnailImage->save($originalPath. $imageName);
    
            $sub_categorie->parent_categorie_id = $request->parent_categorie_id;
            $sub_categorie->sub_categorie_name = $request->sub_categorie_name;
            $sub_categorie->sub_categorie_slug = Str::slug($request->sub_categorie_name);
            $sub_categorie->sub_categorie_description = $request->sub_categorie_description;
            $sub_categorie->sub_categorie_image = $imageName;
            $sub_categorie->save();
    
            return redirect()->route('sub_categories')->with('message','Sub-Categorie Updated successfully.');


        }else{  
            $sub_categorie->parent_categorie_id = $request->parent_categorie_id;
            $sub_categorie->sub_categorie_name = $request->sub_categorie_name;
            $sub_categorie->sub_categorie_slug = Str::slug($request->sub_categorie_name);
            $sub_categorie->sub_categorie_description = $request->sub_categorie_description;
            $sub_categorie->sub_categorie_image = $request->sub_categorie_image_old;
            $sub_categorie->save();
    
            return redirect()->route('sub_categories')->with('message','Sub-Categorie Updated successfully.');
        }
    }













    public function delete ($id){
        $sub_categorie = SubCategorie::find($id);

        if (file_exists(public_path('sub_categorie_imgaes/' . $sub_categorie->sub_categorie_image))) {
            unlink(public_path('sub_categorie_imgaes/' . $sub_categorie->sub_categorie_image));
        }

        $sub_categorie->delete();


        return redirect()->back()->with('message','Successfully Sub categorie deleted.');
    }










}
