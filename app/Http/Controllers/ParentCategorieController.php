<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentCategorie;
use Intervention\Image\ImageManagerStatic as Image;
use Str;
class ParentCategorieController extends Controller
{
    public function index (){
        $pageName = "Parent-CategorieS";
        $parent_categories = ParentCategorie::all();
        return view('admin.categories.parent_categorie',compact('pageName','parent_categories'));
    }



    public function store (Request $request){

        $request->validate([
           'parent_categorie_name'=>'required|unique:parent_categories',
           'parent_categorie_imgage'=>'required|image|mimes:jpg,jpeg,png,svg'
        ]);
        



        $originalImage= $request->file('parent_categorie_imgage');
        $thumbnailImage = Image::make($originalImage);
        $originalPath = public_path().'/parent_categorie_imgaes/';
        $thumbnailImage->resize(200,200);
        $imageName = time().$originalImage->getClientOriginalName();
        $thumbnailImage->save($originalPath. $imageName);



        $parent_categorie = new ParentCategorie();
        $parent_categorie->parent_categorie_name = $request->parent_categorie_name;
        $parent_categorie->parent_categorie_slug = Str::slug($request->parent_categorie_name);
        $parent_categorie->parent_categorie_imgage = $imageName;
        $parent_categorie->parent_categorie_description = $request->parent_categorie_description;


        $parent_categorie->save();

        return redirect()->back()->with('message','Parent-Categorie created successfully.');




    }



    public function edit ($id){
        $pageName = "Parent-Categorie-Update";
        $parent_categorie = ParentCategorie::find($id);
        return view('admin.categories.edit_parent_categorie',compact('pageName','parent_categorie'));
    }




    public function update (Request $request,$id){
        $request->validate([
            'parent_categorie_name'=>'required',
            'parent_categorie_imgage'=>'image|mimes:jpg,jpeg,png,svg'
        ]);

        $parent_categorie = ParentCategorie::find($id); 
        if($request->file('parent_categorie_imgage_new')){


            if (file_exists(public_path('parent_categorie_imgaes/' . $parent_categorie->parent_categorie_imgage))) {
                unlink(public_path('parent_categorie_imgaes/' . $parent_categorie->parent_categorie_imgage));
            }

            $originalImage= $request->file('parent_categorie_imgage_new');
            $thumbnailImage = Image::make($originalImage);
            $originalPath = public_path().'/parent_categorie_imgaes/';
            $thumbnailImage->resize(200,200);
            $imageName = time().$originalImage->getClientOriginalName();
            $thumbnailImage->save($originalPath. $imageName);
    
    
    
            $parent_categorie->parent_categorie_name = $request->parent_categorie_name;
            $parent_categorie->parent_categorie_slug = Str::slug($request->parent_categorie_name);
            $parent_categorie->parent_categorie_imgage = $imageName;
            $parent_categorie->parent_categorie_description = $request->parent_categorie_description;
    
    
            $parent_categorie->save();
    
            return redirect()->route('parent-categories')->with('message','Parent Categorie updated Successfully');






        }else{
            $parent_categorie = ParentCategorie::find($id);
            $parent_categorie->parent_categorie_name = $request->parent_categorie_name;
            $parent_categorie->parent_categorie_slug = Str::slug($request->parent_categorie_name);
            $parent_categorie->parent_categorie_imgage =$request->parent_categorie_imgage_preview;
            $parent_categorie->parent_categorie_description = $request->parent_categorie_description;
            $parent_categorie->save();
    
            return redirect()->route('parent-categories')->with('message','Parent Categorie updated Successfully');

        }
    }




    public function delete ($id){
        $parent_categorie = ParentCategorie::find($id);

        if (file_exists(public_path('parent_categorie_imgaes/' . $parent_categorie->parent_categorie_imgage))) {
            unlink(public_path('parent_categorie_imgaes/' . $parent_categorie->parent_categorie_imgage));
        }

        $parent_categorie->delete();


        return redirect()->back()->with('message','Successfully parent categorie deleted.');
    }
}
