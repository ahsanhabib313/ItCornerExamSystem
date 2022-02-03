@extends('exam.index')
@section('content')
    @include('exam.header')
    <div class="d-flex justify-content-center row">
        <div class="col-md-8 col-lg-8">
            <div class="jumbotron">
                <div id="errors"></div>
                <input type="hidden" id="user_id" value="{{$user_id}}">
                <div class="form-group">
                    <label for="institute">Institute</label>
                    <input type="text" class="form-control" id="institute" placeholder="Enter institute name...">
                </div>
                <div class="form-group">
                    <label for="cpga">CGPA</label>
                    <input type="text" class="form-control" id="cgpa" placeholder="enter your cgpa...">
                </div>
                <button type="submit" onclick="skipPersonalInfo({{$user_id}})" class="btn btn-danger" >Skip</button>
                <button type="submit" onclick="personalInfo({{$user_id}})" class="btn btn-primary ml-2">Submit</button>

            </div>
        </div>
    </div>
@endsection


