@extends('admin.master')

@section('admin_title')

Super Market -||- Edit-Categories

@endsection

@php 

$page = 'Parent_Categories_Edit'

@endphp 

@section('admin_content') 

<div class="row">
    <div class="col-md-12">
        <div class="card mt-4" style="border-radius:0%">
            <div class="d-flex flex-row justify-content-between align-items-center mt-2 ml-4">
                <div style="font-weight:bold;font-size:18px">{{ $pageName }}</div>
                <div class="mr-4">
                    <a href=" {{route('parent-categories')}}" class="btn  btn-outline-info btn-sm" style="border-radius:0%"> Back To CategorieS  </a>
                </div>
            </div>
            <hr>
            <div class="card-body">
                <form action="{{route('parent_categorie_update',$parent_categorie->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="parent_categorie_name" style="font-size:11px">PARENT CATEGORIE NAME : </label>
                    <input 
                      type="text"
                      name="parent_categorie_name"
                      id="parent_categorie_name"
                      value="{{$parent_categorie->parent_categorie_name}}"
                      class="form-control @error('parent_categorie_name') is-invalid @enderror"
                      style="border-radius:0%"
                      placeholder="Enter parent categorie name...."
                      >
                      @error('parent_categorie_name')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror 
                    <br/>
                    <label for="parent_categorie_description" style="font-size:11px">PARENT CATEGORIE DESCRIPTION : </label>
                    <input 
                      type="text"
                      name="parent_categorie_description"
                      value="{{$parent_categorie->parent_categorie_description}}"
                      id="parent_categorie_description"
                      class="form-control @error('parent_categorie_description') is-invalid @enderror"
                      style="border-radius:0%"
                      placeholder="Enter parent categorie description...."
                      >
                      @error('parent_categorie_description')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror 
                    <br/>
                    
                    <label for="parent_categorie_imgage" style="font-size:11px">PARENT CATEGORIE IMAGE W-200PX/H-200PX : </label>
                    <input 
                     type="file" 
                     name="parent_categorie_imgage_new"
                     id="parent_categorie_imgage"
                     class="form-control @error('parent_categorie_imgage') is-invalid @enderror"
                     style="border-radius: 0%"
                     >
                     @error('parent_categorie_imgage')
                     <small class="text-danger">{{ $message }}</small>
                     @enderror
                     
                     <div class="mt-4 d-flex flex-row  align-items-center">
                        <b> Previus : </b>
                        <img src="{{asset('parent_categorie_imgaes')}}/{{$parent_categorie->parent_categorie_imgage}}" class="ml-2" width="110px" height="70px" alt="parent categorie edited image">
                        <input type="hidden" name="parent_categorie_imgage_preview" value="{{$parent_categorie->parent_categorie_imgage}}" id="">
                        <b class="ml-2"> Present : </b>
                        <img src="" id="parent_categorie_imgage_preview" style="display:none" name="parent_categorie_imgage_preview" class="ml-2" width="110px" height="70px">
                     </div>

                    <br/>
                    <input type="submit" value="Update" class="btn btn-sm btn-outline-info mt-4" style="border-radius: 0%"> 
                </form>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    $(document).ready(function (e){
       $("#parent_categorie_imgage").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#parent_categorie_imgage_preview").css('display','block');
              $("#parent_categorie_imgage_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       })
    });
</script>


@endsection