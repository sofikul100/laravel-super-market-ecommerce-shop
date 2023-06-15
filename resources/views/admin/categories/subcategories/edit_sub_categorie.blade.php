@extends('admin.master')

@section('admin_title')

Super Market -||- Edit-Sub-Categories

@endsection

@php 

$page = 'Sub_Categories_Edit'

@endphp 

@section('admin_content') 

<div class="row">
    <div class="col-md-12">
        <div class="card mt-4" style="border-radius:0%">
            <div class="d-flex flex-row justify-content-between align-items-center mt-2 ml-4">
                <div style="font-weight:bold;font-size:18px">{{ $pageName }}</div>
                <div class="mr-4">
                    <a href=" {{route('sub_categories')}}" class="btn  btn-outline-info btn-sm" style="border-radius:0%"> Back To Sub-CategorieS  </a>
                </div>
            </div>
            <hr>
            <div class="card-body">
                <form action="{{route('sub_categorie_update',$sub_categorie->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="parent_categorie_id" style="font-size:11px">SELECT PARENT CATEGORIE : </label>
                    <select name="parent_categorie_id" id="parent_categorie_id" class="form-control @error('parent_categorie_id') is-invalid @enderror" style="border-radius: 0%">

                        <option value="" disabled selected>Select Parent Categorie </option>
                        @foreach ($parent_categories as $parent_categorie)
                             <option value="{{$parent_categorie->id}}" @if ($parent_categorie->id == $sub_categorie->parent_categorie_id)
                                 selected
                             @endif>{{$parent_categorie->parent_categorie_name}}</option>
                        @endforeach
                            
                    </select>
                    @error('parent_categorie_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror 
                    <br/>
                    <label for="sub_categorie_name" style="font-size:11px">SUB CATEGORIE NAME : </label>
                    <input 
                      type="text"
                      name="sub_categorie_name"
                      id="sub_categorie_name"
                      value="{{$sub_categorie->sub_categorie_name}}"
                      class="form-control @error('sub_categorie_name') is-invalid @enderror"
                      style="border-radius:0%"
                      placeholder="Enter sub categorie name...."
                      >
                      @error('sub_categorie_name')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror 
                    <br/>
                    <label for="sub_categorie_description" style="font-size:11px">SUB CATEGORIE DESCRIPTION : </label>
                    <input 
                      type="text"
                      name="sub_categorie_description"
                      id="sub_categorie_description"
                      value="{{$sub_categorie->sub_categorie_description}}"
                      class="form-control @error('sub_categorie_description') is-invalid @enderror"
                      style="border-radius:0%"
                      placeholder="Enter sub categorie description...."
                      >
                      @error('sub_categorie_description')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror 
                    <br/>
                    
                    <label for="sub_categorie_image" style="font-size:11px">SUB CATEGORIE IMAGE W-200PX/H-200PX : </label>
                    <input 
                     type="file" 
                     name="sub_categorie_image"
                     id="sub_categorie_image"
                     class="form-control @error('sub_categorie_image') is-invalid @enderror"
                     style="border-radius: 0%"
                     >
                     @error('sub_categorie_image')
                     <small class="text-danger">{{ $message }}</small>
                     @enderror 

                     <div class="mt-4 d-flex flex-row  align-items-center">
                        <b> Previus : </b>
                        <img src="{{asset('sub_categorie_imgaes')}}/{{$sub_categorie->sub_categorie_image}}" class="ml-2" width="110px" height="70px" alt="parent categorie edited image">
                        <input type="hidden" name="sub_categorie_image_old" value="{{$sub_categorie->sub_categorie_image}}" id="">
                        <b class="ml-2"> Present : </b>
                        <img src="" id="sub_categorie_image_preview" style="display:none" name="sub_categorie_image_preview" class="ml-2" width="110px" height="70px">
                     </div>

                    <br/>
                    <input type="submit" value="Update" class="mt-4 btn btn-sm btn-outline-info" style="border-radius: 0%"> 
                </form>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    $(document).ready(function (e){
       $("#sub_categorie_image").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#sub_categorie_image_preview").css('display','block');
              $("#sub_categorie_image_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       })
    });
</script>


@endsection