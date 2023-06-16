<?php

namespace App\Http\Controllers;

use App\Models\ChildCategorie;
use App\Models\ParentCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Str;
class ChildCategorieController extends Controller
{
    public function index (){
        $pageName = "Child-CategorieS";
        $parent_categories = DB::table('parent_categories')->select('parent_categories.id','parent_categories.parent_categorie_name')->get();
        $child_categories = DB::table('child_categories')
                            ->join('parent_categories','child_categories.parent_categorie_id','=','parent_categories.id')
                            ->join('sub_categories','child_categories.sub_categorie_id','=','sub_categories.id')
                            ->select('parent_categories.id','parent_categories.parent_categorie_name','sub_categories.id','sub_categories.sub_categorie_name','child_categories.*')
                            ->get();
                    
        return view('admin.categories.childcategories.child_categorie',compact('pageName','parent_categories','child_categories'));
    }



    public function getSubCategorie($parent_categorie_id){
         $sub_categories = DB::table('sub_categories')
                           ->join('parent_categories','sub_categories.parent_categorie_id','=','parent_categories.id')
                           ->select('sub_categories.*')
                           ->where('sub_categories.parent_categorie_id',$parent_categorie_id)
                           ->get();
         return response()->json([
            'sub_categories'=>$sub_categories
         ]);                  
    }





    public function store (Request $request){

        $request->validate([
            'parent_categorie_id'=>'required',
            'sub_categorie_id'=>'required',
            'child_categorie_name'=>'required',
            'child_categorie_image'=>'required|image|mimes:jpg,jpeg,png,svg'
        ]);


        $originalImage= $request->file('child_categorie_image');
        $thumbnailImage = Image::make($originalImage);
        $originalPath = public_path().'/child_categorie_images/';
        $thumbnailImage->resize(200,200);
        $imageName = time().$originalImage->getClientOriginalName();
        $thumbnailImage->save($originalPath. $imageName);


        $child_categorie = new ChildCategorie();
        $child_categorie->parent_categorie_id = $request->parent_categorie_id;
        $child_categorie->sub_categorie_id = $request->sub_categorie_id;
        $child_categorie->child_categorie_name = $request->child_categorie_name;
        $child_categorie->child_categorie_slug = Str::slug($request->child_categorie_name);
        $child_categorie->child_categorie_description = $request->child_categorie_description;
        $child_categorie->child_categorie_image = $imageName;
        $child_categorie->save();

        return redirect()->back()->with('message','Child-Categorie created successfully.');


    }


    public function edit ($id){
        $pageName = "Edit-Child-Categorie";

        $child_categorie = DB::table('child_categories')
                           ->join('parent_categories','child_categories.parent_categorie_id','=','parent_categories.id')
                           ->join('sub_categories','child_categories.sub_categorie_id','=','sub_categories.id')
                           ->select('parent_categories.id','parent_categories.parent_categorie_name','sub_categories.id','sub_categories.sub_categorie_name','child_categories.*')
                           ->where('child_categories.id',$id)
                           ->first();

        $parent_categories = DB::table('parent_categories')->get();                   
        
        $parent_categorie_id = DB::table('child_categories')
                         ->join('parent_categories','child_categories.parent_categorie_id','=','parent_categories.id')
                         ->select('parent_categories.id','parent_categories.parent_categorie_name')
                         ->where('child_categories.id',$id)
                         ->first();

        $sub_categories = DB::table('sub_categories')->where('parent_categorie_id',$parent_categorie_id->id)->get();
                                                           
        return view('admin.categories.childcategories.edit_child_categorie',compact('pageName','child_categorie','parent_categories','sub_categories'));
    }



    public function getSubCategoriesForEdit (Request $request) {
        $sub_categories = DB::table('sub_categories')
        ->join('parent_categories','sub_categories.parent_categorie_id','=','parent_categories.id')
        ->select('sub_categories.*')
        ->where('sub_categories.parent_categorie_id',$request->parent_categorie_id)
        ->get();

        return response()->json([
            'sub_categories'=>$sub_categories
        ]);
    }




    public function update (Request $request,$id) {
        $request->validate([
            'parent_categorie_id'=>'required',
            'sub_categorie_id'=>'required',
            'child_categorie_name'=>'required',
            'child_categorie_image'=>'image|mimes:jpg,jpeg,png,svg'
        ]);


        $child_categorie = ChildCategorie::find($id);


        if($request->file('child_categorie_image')){
            
            if (file_exists(public_path('child_categorie_images/' . $child_categorie->child_categorie_image))) {
                unlink(public_path('child_categorie_images/' . $child_categorie->child_categorie_image));
            }

            $originalImage= $request->file('child_categorie_image');
            $thumbnailImage = Image::make($originalImage);
            $originalPath = public_path().'/child_categorie_images/';
            $thumbnailImage->resize(200,200);
            $imageName = time().$originalImage->getClientOriginalName();
            $thumbnailImage->save($originalPath. $imageName);


            $child_categorie->parent_categorie_id = $request->parent_categorie_id;
            $child_categorie->sub_categorie_id = $request->sub_categorie_id;
            $child_categorie->child_categorie_name = $request->child_categorie_name;
            $child_categorie->child_categorie_slug = Str::slug($request->child_categorie_name);
            $child_categorie->child_categorie_description = $request->child_categorie_description;
            $child_categorie->child_categorie_image = $imageName;
            $child_categorie->save();

            return redirect()->route('child_categories')->with('message','Child-Categorie Updated successfully.');




        }else{
            
            $child_categorie->parent_categorie_id = $request->parent_categorie_id;
            $child_categorie->sub_categorie_id = $request->sub_categorie_id;
            $child_categorie->child_categorie_name = $request->child_categorie_name;
            $child_categorie->child_categorie_slug = Str::slug($request->child_categorie_name);
            $child_categorie->child_categorie_description = $request->child_categorie_description;
            $child_categorie->child_categorie_image = $request->child_categorie_image_old;
            $child_categorie->save();

            return redirect()->route('child_categories')->with('message','Child-Categorie Updated successfully.');
        }
    }


    public function delete ($id){
        $child_categorie = ChildCategorie::find($id);

        if (file_exists(public_path('child_categorie_images/' . $child_categorie->child_categorie_image))) {
            unlink(public_path('child_categorie_images/' . $child_categorie->child_categorie_image));
        }

        $child_categorie->delete();


        return redirect()->back()->with('message','Successfully Child categorie deleted.');
    }





}
