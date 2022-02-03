@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="border mt-3 admin-panel-shadow">
        <div class="text-secondary fw-bold admin-panel-heading pt-3 pb-3 bg-lisht">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 text-center">
                    Show Categories
                    <div class="alert alert-success success_msg">
                    </div>
                </div>
                <div class="col-lg-4">
                    
                </div>
            </div>
        </div>
        <hr>
        <div class="p-3">
            <div class="d-flex justify-content-center row">
                  <div class="col-md-8 col-lg-8">
                        <table class="table .table-bordered" id="category_table">
                            <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @isset($categories)
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td class="serial_{{$category->id}}">{{$loop->index + 1}}</td>
                                        <td class="name_{{$category->id}}">{{$category->name}}</td>
                                        <td>
                                            <button onclick="editCategory({{$category->id}})" class="btn btn-info" data-toggle="modal" data-target="#editCategoryModal">Edit</button>
                                            <button onclick="deleteCategory({{$category->id}})" class="btn btn-danger" data-toggle="modal" data-target="#deleteCategoryModal">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endisset
                            
                           
                            </tbody>
                        </table>

                    
                  </div>
            </div>
        </div>
    </div>
</div>

{{--edit category modal--}}
<!-- Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title" id="exampleModalLabel">Category Update</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
             <div class="alert alert-warning error_msg">
                  
            </div>
            <form id="editForm" action="{{url('admin/update/category')}}">
                <input type="hidden" id="id">
                <p>Serial No:<span class="serial">1</span></p>
                <div class="form-group">
                    <label>Name</label>
                    <input id="name" class="form-control">
                </div>
                <button type="button" id="update" class="btn btn-info">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </form>
        </div>
      </div>
    </div>
  </div>

  {{--delete category modal--}}
<!-- Modal -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-warning error_msg">
                  
            </div>
            <form id="deleteForm" action="{{url('admin/delete/category')}}">
                <input type="hidden" id="id">
            </form>
             
                <div class="container">
                    <div class="row d-flex justify-content-center">
                            <div>
                            <h2 class="text-danger"> Are you Confirm...?</h2>
                            </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="button" id="delete" class="btn btn-primary">Yes</button>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="{{asset('assets/js/category.js')}}"></script>
@endsection