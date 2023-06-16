@extends('admin.master')

@section('admin_title')

Super Market -||- Child-Categories

@endsection

@php 

$page = 'Child_Categories'

@endphp 

@section('admin_content') 

<div class="row">
    <div class="col-md-12">
        <div class="card mt-4" style="border-radius:0%">
            <div class="d-flex flex-row justify-content-between align-items-center mt-2 ml-4">
                <div style="font-weight:bold;font-size:18px">{{ $pageName }}</div>
                <div class="mr-4">
                    <button class="btn  btn-outline-info btn-sm" style="border-radius:0%"  data-toggle="modal" data-target="#add_sub_categorie_modal"> Add New </button>
                </div>
            </div>
            <hr>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Sl</th>
                      <th>Parent Categorie Name </th>
                      <th>Sub-Categorie Name</th>
                      <th>Child-Categorie Name</th>
                      <th>Child-Categorie Image</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($child_categories as $key => $child_categorie) 
                            <tr>
                              <td>{{$key + 1}}</td>
                              <td>{{$child_categorie->parent_categorie_name}}</td>
                              <td>{{$child_categorie->sub_categorie_name}}</td>
                              <td>{{$child_categorie->child_categorie_name}}</td>
                              <td><img 
                                   src="{{asset('child_categorie_images')}}/{{$child_categorie->child_categorie_image}}"
                                   alt="parent-categorie-image"
                                   height="50px"
                                   width="70px"
                                   >
                                  </td>
                              <td>
                                  <a href="{{route('child_categorie_edit',$child_categorie->id)}}" class="btn btn-sm btn-outline-info">
                                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                  </a>
                                  {{-- {{route('parent_categorie_delete',$parent_categorie->id)}} --}}
                                  <a href="{{route('child_categorie_delete',$child_categorie->id)}}"  class="btn btn-sm btn-outline-danger"   id="delete-categorie">
                                      <i class="fa fa-trash" aria-hidden="true"></i>
                                  </a>
                              </td>
                          </tr>
                          @endforeach  
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

</div>



<!------ child categorie add model --->
        <div  class="modal" id="add_sub_categorie_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content" style="border-radius:0%">
                <div class="modal-header bg-info" style="border-radius:0%">
                  <h5 class="modal-title" style="" id="exampleModalLabel" style="font-size:14px"> ADD NEW CHILD-CATEGORIE HERE.. </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                 
                    <form action="{{route('child_categorie_store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="parent_categorie_id" style="font-size:11px">SELECT PARENT CATEGORIE : </label>
                        <select name="parent_categorie_id" id="parent_categorie_id" class="form-control @error('parent_categorie_id') is-invalid @enderror" style="border-radius: 0%">
        
                                <option value="" disabled selected>Select Parent Categorie </option>
                            @foreach ($parent_categories as $parent_categorie)
                                <option value="{{$parent_categorie->id}}">{{$parent_categorie->parent_categorie_name}}</option>
                            @endforeach
                        </select>
                        @error('parent_categorie_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror 
                        <br/>
                        <label for="sub_categorie_id" style="font-size:11px">SELECT SUB CATEGORIE : </label>
                        <select name="sub_categorie_id" id="sub_categorie_id" class="form-control @error('sub_categorie_id') is-invalid @enderror" style="border-radius: 0%">
                            
                        </select>
                        @error('sub_categorie_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <br/>
                        <label for="child_categorie_name" style="font-size:11px">CHILD CATEGORIE NAME : </label>
                        <input 
                          type="text"
                          name="child_categorie_name"
                          id="child_categorie_name"
                          class="form-control @error('child_categorie_name') is-invalid @enderror"
                          style="border-radius:0%"
                          placeholder="Enter child categorie name...."
                          >
                          @error('child_categorie_name')
                          <small class="text-danger">{{ $message }}</small>
                          @enderror 
                        <br/>
                        <label for="sub_categorie_description" style="font-size:11px">CHILD CATEGORIE DESCRIPTION : </label>
                        <input 
                          type="text"
                          name="child_categorie_description"
                          id="child_categorie_description"
                          class="form-control @error('child_categorie_description') is-invalid @enderror"
                          style="border-radius:0%"
                          placeholder="Enter child categorie description...."
                          >
                          @error('child_categorie_description')
                          <small class="text-danger">{{ $message }}</small>
                          @enderror 
                        <br/>
                        
                        <label for="child_categorie_image" style="font-size:11px">CHILD CATEGORIE IMAGE W-200PX/H-200PX : </label>
                        <input 
                         type="file" 
                         name="child_categorie_image"
                         id="child_categorie_image"
                         class="form-control @error('child_categorie_image') is-invalid @enderror"
                         style="border-radius: 0%"
                         >
                         @error('child_categorie_image')
                         <small class="text-danger">{{ $message }}</small>
                         @enderror 
        
                         <img src="" width="120px" style="display: none" id="child_categorie_image_preview" height="80px" class="mt-4" alt="sub categorie image preview">
        
                        <br/>
                        <input type="submit" value="Submit" class="mt-4 btn btn-sm btn-outline-info" style="border-radius: 0%"> 
                    </form>
        
                </div>
              </div>
            </div>
          </div>




<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>

$(document).ready(function (e){

       $("#child_categorie_image").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#child_categorie_image_preview").css('display','block');
              $("#child_categorie_image_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       })

    

    $("#parent_categorie_id").change(function (){
        $("#sub_categorie_id").html("")
        let parent_categorie_id = $("#parent_categorie_id").val();

        $.ajax({
            url:"get-subcategorie/"+parent_categorie_id,
            type:"GET",
            success:function (response){
                response.sub_categories.forEach(element => {
                    let option = `<option value="${element.id}">${element.sub_categorie_name}</option>`;
                    $("#sub_categorie_id").append(option);
                });
            },
            error:function (error){
                console.log(error)
            }
        })
    }); 

});


</script>


@endsection