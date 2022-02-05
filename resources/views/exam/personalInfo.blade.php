@extends('exam.index')
@section('content')
    @include('exam.header')
    <div class="d-flex justify-content-center row">
        <div class="col-md-8 col-lg-8">
            <div class="jumbotron">
                <div id="errors"></div>

                <form action="{{route('store.personal.info')}}" id="personaInfo" method="POST">
                    <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}" method="POST">
                <div class="form-group">
                    <label for="institute">Institute</label>
                    <input type="text" name="institute" class="form-control" id="institute" placeholder="Enter institute name...">
                </div>
                <div class="form-group">
                    <label for="cpga">CGPA</label>
                    <input type="text"  name="cgpa " class="form-control" id="cgpa" placeholder="enter your cgpa...">
                </div>
                <button  onclick="skipPersonalInfo({{$user_id}})" class="btn btn-danger" >Skip</button>
                <button type="submit"  class="btn btn-primary ml-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection


