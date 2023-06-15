@extends('admin.master')

@section('admin_title')

Super Market -||- Categories

@endsection

@php 

$page = 'Parent_Categories'

@endphp 

@section('admin_content') 

<div class="row">
    <div class="col-md-12">
        <div class="card mt-4" style="border-radius:0%">
            <div class="d-flex flex-row justify-content-between align-items-center mt-2 ml-4">
                <div style="font-weight:bold;font-size:18px">{{ $pageName }}</div>
                <div class="mr-4">
                    <button class="btn  btn-outline-info btn-sm" style="border-radius:0%"  data-toggle="modal" data-target="#add_categorie_modal"> Add New </button>
                </div>
            </div>
            <hr>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Sl</th>
                      <th>Categorie Name</th>
                      <th>Categorie Slug</th>
                      <th>Categorie Image</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                       @foreach ($parent_categories as $key => $parent_categorie)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $parent_categorie->parent_categorie_name }}</td>
                                <td>{{ $parent_categorie->parent_categorie_slug }}</td>
                                <td><img 
                                     src="{{asset('parent_categorie_imgaes')}}/{{$parent_categorie->parent_categorie_imgage}}"
                                     alt="parent-categorie-image"
                                     height="50px"
                                     width="70px"
                                     >
                                    </td>
                                <td>
                                    <a href="{{route('parent_categorie_edit',$parent_categorie->id)}}" class="btn btn-sm btn-outline-info">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                    @php
                                        $sub_categories = App\Models\SubCategorie::count();
                                    @endphp
                                    @if ($sub_categories < 1)
                                    <a href="{{route('parent_categorie_delete',$parent_categorie->id)}}"  class="btn btn-sm btn-outline-danger"   id="delete-categorie">
                                      <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                       @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>



    <!------ parent categorie add model --->

<div  class="modal" id="add_categorie_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius:0%">
            <div class="modal-header bg-info" style="border-radius:0%">
              <h5 class="modal-title" style="" id="exampleModalLabel" style="font-size:14px"> ADD NEW CATEGORIE HERE.. </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             
                <form action="{{route('parent_categorie_store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="parent_categorie_name" style="font-size:11px">PARENT CATEGORIE NAME : </label>
                    <input 
                      type="text"
                      name="parent_categorie_name"
                      id="parent_categorie_name"
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
                     name="parent_categorie_imgage"
                     id="parent_categorie_imgage"
                     class="form-control @error('parent_categorie_imgage') is-invalid @enderror"
                     style="border-radius: 0%"
                     >
                     @error('parent_categorie_imgage')
                     <small class="text-danger">{{ $message }}</small>
                     @enderror 

                    <br/>
                    <input type="submit" value="Submit" class="btn btn-sm btn-outline-info" style="border-radius: 0%"> 
                </form>

            </div>
          </div>
        </div>
      </div>




</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
</script>


@endsection