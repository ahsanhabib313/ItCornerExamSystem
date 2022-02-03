@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="border mt-3 admin-panel-shadow">
        <div class="text-secondary fw-bold admin-panel-heading pt-3 pb-3 bg-lisht">
            <div class="row ">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 text-center">
              Add Settigs 
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
        <hr>
        <div class="p-3">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                   <div class="jumbotron">
                    <div class="alert alert-success" style="display:none"></div>
                    <form action="{{route('admin.add.setting')}}" id="add_setting_form">
                        <div class="mb-3">
                                <div class="form-group">
                                    <label for="limit" class="form-label">How many questions do you want to give in the exam?</label>
                                    <input type="text" name="question_limit" id="limit" class="form-control">
                                </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="limit" class="form-label">How many questions need to be answered for passing exam ?</label>
                                <input type="text" name="pass_mark"  class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="limit" class="form-label">Developer Category  </label>
                                <select name="category_id" class="form-control">
                                      <option value="">Choose Category</option>
                                        @isset($categories)
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        @endisset
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="question_type">Question Type</label>
                                <select class="form-control" id="question_type" name="question_type_id">
                                    <option value="">Choose Question Type</option>
                                    @foreach($question_types as $question_type)
                                    <option value="{{$question_type->id}}">{{strtoupper($question_type->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                                <button type="submit" id="btn_add_setting" class="btn btn-primary btn-block float-right">Save</button>
                                <div class="clearfix"></div>
                        </div>
                    </form>
                   </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
    </div>
</div>
@endsection