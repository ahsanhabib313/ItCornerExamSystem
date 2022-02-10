@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="border mt-3 admin-panel-shadow">
        <div class="text-secondary fw-bold admin-panel-heading pt-3 pb-3 bg-lisht">
            <div class="row ">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 text-center">
                  Show Settigs
                    <div class="alert alert-success success_msg">
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
        <hr>
        <div class="p-3">
            <div class="row d-flex justify-content-center">

                <div class="col-lg-10">
                   <div class="card">
                       <div class="card-body">
                            <div class="alert alert-success" style="display:none"></div>
                            <table class="table table-striped" id="settingTable">
                                    <thead class="table-active">
                                        <th>Question Limit</th>
                                        <th>Pass Mark Percentage</th>
                                        <th>Category</th>
                                        <th>MCQ Question Time(seconds)</th>
                                        <th>Programming Question Time(seconds)</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @isset($settings)
                                            @foreach ($settings as $item)
                                                <tr id="setting_row_{{$item->id}}">
                                                    <td class="question_limit_{{$item->id}}">{{$item->question_limit}}</td>
                                                    <input type="hidden" name="question_limit_{{$item->id}}" value = "{{$item->question_limit}}">

                                                    <td class="pass_mark_{{$item->id}}">{{$item->pass_mark}}</td>
                                                    <input type="hidden" name="pass_mark_{{$item->id}}" value = "{{$item->pass_mark}}">

                                                    <td class="category_name_{{$item->id}}">{{strtoupper($item->category->name)}}</td>
                                                    <input type="hidden" name="category_id_{{$item->id}}" value = "{{$item->category_id}}">
                                                    
                                                    <td class="mcq_ques_time_{{$item->id}}">{{($item->mcq_ques_time)}}</td>
                                                    <input type="hidden" name="mcq_ques_time_{{$item->id}}" value = "{{($item->mcq_ques_time)}}">

                                                    <td class="code_ques_time_{{$item->id}}">{{($item->code_ques_time)}}</td>
                                                    <input type="hidden" name="code_ques_time_{{$item->id}}" value = "{{($item->code_ques_time)}}">

                                                    <td>
                                                        <button class="btn btn-info" data-toggle="modal" data-target="#editSettingModal" onclick="editSetting({{ $item->id}})">Edit</button>
                                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteSettingModal" onclick="deleteSetting({{ $item->id}})">Delete</button>
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
                     
                      <form id = "updateForm" action="{{url('admin/update/setting')}}" method="POST" autocomplete="off">
                        <div class="alert alert-success text-success success_msg"></div>
                        <div class="alert alert-warning text-danger error_msg"></div>
                      <input type="hidden" id="setting_id">
                          <div class="form-group">
                                <label for="#question_limit">Question Limit</label>
                                <input type="text" id="question_limit" class="form-control">
                          </div>
                          <div class="form-group">
                                <label for="#pass_mark">Pass Mark(%)</label>
                                <input type="text" id="pass_mark" class="form-control">
                          </div>
                          <div class="form-group">
                              <label for="#category_id">Category</label>
                              <select class="form-control" id="category_id" >
                                  @foreach($categories as $category)
                                      <option class="category_option" value="{{$category->id}}" >{{$category->name}}</option>
                                  @endforeach

                              </select>
                          </div>
                          <div class="form-group">
                              <label for="mcq_ques_time">MCQ Question Time</label>
                              <input  class="form-control" id="mcq_ques_time">
                          </div>
                          <div class="form-group">
                              <label for="code_ques_time">Code Question Time</label>
                              <input  class="form-control" id="code_ques_time">
                          </div>

                          <div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="updateSettingBtn" class="btn btn-primary">Update</button>
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
        <form id="deleteSettingForm" action="{{url('admin/delete/setting')}}" method="POST">
        <div class="modal-body">
          <div class="alert alert-success text-success success_msg"></div>
          <div class="alert alert-warning text-danger error_msg"></div>
                <input type="hidden" id="setting_id">
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
          <button type="button" id="confirmDelete" class="btn btn-primary">Yes</button>
        </div>
      </form>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/settings.js')}}"></script> 
@endsection




