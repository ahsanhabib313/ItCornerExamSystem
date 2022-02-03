@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="border mt-3 admin-panel-shadow">
        <div class="text-secondary fw-bold admin-panel-heading pt-3 pb-3 bg-lisht">
            <div class="row ">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 text-center">
               Show Settigs 
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
        <hr>
        <div class="p-3">
            <div class="row d-flex justify-content-center">
             
                <div class="col-lg-8">
                   <div class="card">
                       <div class="card-body">
                            <div class="alert alert-success" style="display:none"></div>
                            <table class="table table-striped">
                                    <thead class="table-active">
                                        <th>Question Limit</th>
                                        <th>Pass Question Quantity</th>
                                        <th>Category</th>
                                        <th>Question Type</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @isset($settings)
                                            @foreach ($settings as $item)
                                                <tr>
                                                    <td>{{$item->question_limit}}</td>
                                                    <td>{{$item->pass_mark}}</td>
                                                    <td>{{strtoupper($item->category->name)}}</td>
                                                    <td>{{strtoupper($item->questionType->name)}}</td>
                                                    <td>
                                                        <button class="btn btn-info" data-toggle="modal" data-target="#editSettingModal" onclick="editSetting({{ $item->id }})">Edit</button>
                                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteSettingModal">Delete</button>
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
    </div>
</div>


{{--edit setting modal--}}
<!-- Modal -->
<div class="modal fade" id="editSettingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title" id="exampleModalLabel">Category Update</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="container-fluid">

            <div class="row d-flex justify-content-center">
                    <div class="col-md-10">
                      <form action="{{ route('admin.update.setting') }}">
                          <div class="form-group"> 
                                <label for="#question_limit">Question Limit</label>
                                <input type="text" name="question_limit" id="question_limit" class="form-control">
                          </div>
                          <div class="form-group"> 
                                <label for="#pass_mark">Pass Question Quantity</label>
                                <input type="text" name="pass_mark" id="pass_mark" class="form-control">
                          </div>
                          <div class="select_section">
                          </div>
                      </form>
                    </div>
            </div>

           </div>
        </div>
      </div>
    </div>
  </div>

  {{--delete Setting modal--}}
<!-- Modal -->
<div class="modal fade" id="deleteSettingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
@endsection