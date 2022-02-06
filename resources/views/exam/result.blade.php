@extends('exam.index')
@section('content')
    @include('exam.header')
    <h2 class=" p-5 card-title text-center text-info">Your Online Exam Result</h2>
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" id="user_id" value="{{$user_id}}">
                    <table class="table table-bordered" style="text-align:center">
                        <tbody>
                        <tr><td><span class="table-text">Total Question: </span></td><td><label class="badge badge-info">{{$question_limit}} </label></td></tr>
                        <tr><td><span class="table-text">Examinee Mark: </span></td><td><label class="badge badge-info">{{$examinee_mark}}%</label></td></tr>
                        <tr><td><span class="table-text">Pass Mark: </span></td><td><label class="badge badge-info">{{$pass_mark}}%</label></td> </tr>
                        <tr><td><span class="table-text">Status: </span></td><td><label class="badge badge-{{$badge}}">{{strtoupper($status)}}</label></td></tr>
                        <tr><td><span class="table-text">Category: </span></td><td><label class="badge badge-info">{{$category}}</label></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <a class="btn btn-warning btn-lg mt-5">Quit From Exam</a>
    </div>
@endsection

