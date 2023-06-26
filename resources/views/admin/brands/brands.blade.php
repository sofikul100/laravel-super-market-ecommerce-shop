@extends('admin.master')

@section('admin_title')

Super Market -||- Brands

@endsection

@php 

$page = 'Brands'

@endphp 

@section('admin_content') 

<div class="row">
    <div class="col-md-12">
        <div class="card mt-4" style="border-radius:0%">
            <div class="d-flex flex-row justify-content-between align-items-center mt-2 ml-4">
                <div style="font-weight:bold;font-size:18px">{{ $pageName }}</div>
                <div class="mr-4">
                    <button class="btn  btn-outline-info btn-sm" style="border-radius:0%"  data-toggle="modal" data-target="#add_brand_modal"> Add New </button>
                </div>
            </div>
            <hr>
            <div class="card-body">
                <table  class="table table-bordered table-striped yTable">
                    <thead>
                    <tr>
                      <th>Sl</th>
                      <th>Brand Name</th>
                      <th>Brand Logo</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                  </table>
            </div>
        </div>
    </div>



<!------ brand add model --->
<div  class="modal" id="add_brand_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius:0%">
            <div class="modal-header bg-info" style="border-radius:0%">
              <h5 class="modal-title" style="" id="exampleModalLabel" style="font-size:14px"> ADD NEW BRAND HERE.. </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             
                <form action="{{route('brand_store')}}"  method="post"  enctype="multipart/form-data">
                    @csrf
                    <label for="parent_categorie_name" style="font-size:11px">BRAND NAME : </label>
                    <input 
                      type="text"
                      name="brand_name"
                      id="brand_name"
                      class="form-control @error('brand_name') is-invalid @enderror"
                      style="border-radius:0%"
                      placeholder="Enter brand name...."
                      >

                      @error('brand_name')
                         <small class="text-danger">{{ $message }}</small>
                      @enderror 
                    <br/>
                    
                    <label for="brand_logo" style="font-size:11px">BRAND  LOGO W-200PX/H-200PX : </label>
                    <input 
                     type="file" 
                     name="brand_logo"
                     id="brand_logo"
                     class="form-control @error('brand_logo') is-invalid @enderror"
                     style="border-radius: 0%"
                     >

                     @error('brand_logo')
                         <small class="text-danger">{{ $message }}</small>
                     @enderror 


                     <img src="" alt="" id="brand_logo_preview" class="mt-4" name="brand_logo_preview" width="110px" height="80px" style="display:none">
                    <br/>
                    <input type="submit" value="Create" id="brand_create_button" class=" btn btn-sm btn-outline-info" style="border-radius: 0%"> 
                </form>

            </div>
          </div>
        </div>
       </div>





 <!------ brand edit model --->

 <div  class="modal" id="edit_brand_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius:0%">
        <div class="modal-header bg-info" style="border-radius:0%">
          <h5 class="modal-title" style="" id="exampleModalLabel" style="font-size:14px"> EDIT BRAND HERE.. </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         
            <form id="upadate_brand"  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="brand_id" id="brand_id">
                <label for="parent_categorie_name" style="font-size:11px">BRAND NAME : </label>
                <input 
                  type="text"
                  name="brand_name_edit"
                  id="brand_name_edit"
                  class="form-control"
                  style="border-radius:0%"
                  placeholder="Enter brand name...."
                  >
                  <small class="text-danger" id="brand_name_error"></small>
                <br/>
                
                <label for="brand_logo" style="font-size:11px">BRAND  LOGO W-200PX/H-200PX : </label>
                <input 
                 type="file" 
                 name="brand_logo_edit"
                 id="brand_logo_edit"
                 class="form-control"
                 style="border-radius: 0%"
                 >

                <small class="text-danger" id="brand_logo_error"></small>

                <div class="d-flex flex-row justify-content-between align-items-center">
                    <div id="old_image_preview" class="mt-4">
                        <b>old Image/Images : </b>
                    </div>
                    <b class="mt-4"> Presant Image : </b>
                    <img src="" alt="" id="brand_logo_new_preview" class="mt-4 mr-1" name="brand_logo_new_preview" width="110px" height="80px" style="display:none">
                </div>
                <br/>
                <input type="submit" value="Update" id="brand_create_button" class=" btn btn-sm btn-outline-info" style="border-radius: 0%"> 
            </form>

        </div>
      </div>
    </div>
   </div>


















</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>


$(function brand() {
      table =$(".yTable").DataTable({
        processing:true,
        serverSide:true,
        ajax:"{{route('brands')}}",
        columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data:'brand_name',name:'brand_name'},
            {data:'brand_logo',name:'brand_logo'},
            {data:'action',name:'action',orderable:true,searchable:true}
        ]
     });
     
     


     //=========== delete brand with ajax==========//
      $('body').on('click','.brand_delete_button',function(){
           var id = $(this).data("id");
           confirm("Are You sure want to delete !");

           $.ajax({
              type:"GET",
              url:"{{route('brand_delete')}}",
              data:{id:id},
              success: function (response){
                toastr.success(response.message);
                $('.yTable').DataTable().ajax.reload();
              },
              error:function (error) {
                console.log(success)
              }
           });
      });


    //================ edit brand==========//
    $('body').on('click','.brand_edit_button',function(){
           var id = $(this).data("id");
           $.ajax({
              type:"GET",
              url:"{{route('brand_edit')}}",
              data:{id:id},
              success: function (response){
                 $("#brand_name_edit").val(response.brand_name);
                 
                 $image = `<img src="{{asset('brand_images')}}/${response.brand_logo}" id="brand_old_preview" width="50px" height="40px"/>`;
                 $("#old_image_preview").append($image);
                 $("#brand_id").val(response.id);
                },
              error:function (error) {
                console.log(success)
              }
           });
      });


    //=========== edit brand file reader ===========//
    $(document).ready(function (e){
       $("#brand_logo_edit").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#brand_logo_new_preview").css('display','block');
              $("#brand_logo_new_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       });
});
  

//=============== update brand================//

$("#upadate_brand").submit(function (e) { 
     e.preventDefault();
     
     //let id = $("#brand_id").val();
     
     $.ajax({
      headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url:"{{route('brand_update')}}",
      type:"POST",
      data:new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,

      success:function (response){
         toastr.success(response.message);
         $("#edit_brand_modal").modal('hide')
         $("#brand_logo_new_preview").attr('src',' ');
         $("#brand_logo_new_preview").css('display','none');
         $("#brand_old_preview").attr('src',' ');
         $("#brand_old_preview").css('display','none');
         $("#brand_logo_edit").val();
         $('.yTable').DataTable().ajax.reload();
      },
      error:function(error){
         console.log(error)
      }

     })



});









});






$(document).ready(function (e){
       $("#brand_logo").change(function (){
           let reader = new FileReader();

           reader.onload = (e) =>{
              $("#brand_logo_preview").css('display','block');
              $("#brand_logo_preview").attr('src',e.target.result)
           } 

           reader.readAsDataURL(this.files[0]);
       });
});

 































//========== add new brand===============//
// $(document).ready(function (){
     
// // $("#brand_submit").on('submit',function(e){
// //     e.preventDefault();
// //     // let brand_name  = $("#brand_name").val();
// //     // let brand_logo  = $("#brand_logo").val(); 
// //     $.ajax({
// //         headers: {
// //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// //         },
// //         url: "{{route('brand_store')}}",
// //         type: "POST",
// //         data:new FormData(this),
// //         dataType:'JSON',
// //         contentType: false,
// //         cache: false,
// //         processData: false,
// //         beforeSend: function() {
// //               $("#loader").show();
// //               $("#brand_create_button").val("Creating....");

// //         },
// //         success: function (response) {
// //             if(response.status == 200){
// //                 toastr.success(response.message);
// //                 $("#brand_submit")[0].reset();
// //                 $("#loader").hide();
// //                 $("#brand_create_button").val("Create");
// //                 $("#brand_logo_preview").attr('src','');
// //                 $("#brand_logo_preview").css('display','none');
// //                 $("#add_brand_modal").modal('hide');
// //             }
// //         },
// //         error:function (error){
// //             $("#loader").hide();
// //             $("#brand_create_button").val("Create");
// //             $('#brand_name_error').html(
// //                 `<small class='text-danger'>
// //                     ${error.responseJSON.errors.brand_name ? error.responseJSON.errors.brand_name : ' '}
// //                 </small>`
// //             );
// //             $('#brand_logo_error').html(
// //                 `<small class='text-danger'>
// //                     ${error.responseJSON.errors.brand_logo ? error.responseJSON.errors.brand_logo : ' '}
// //                 </small>`
// //             );
// //         }
// //     });
    
// // });
// });





</script>


@endsection