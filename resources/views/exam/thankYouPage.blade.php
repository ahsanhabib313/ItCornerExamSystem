@extends('exam.index')
@section('content')
    @include('exam.header')
    <div class="container mt-5" >
        {{--start company name title --}}
        <div class="company-name">
            <h1 class="text-center p-5">IT CORNER</h1>
        </div>
        {{--stop company name title --}}
        {{--start question box --}}
        <div class="d-flex justify-content-center row">
            <div class="col-md-10 col-lg-10">
                <input type="hidden" id="user_id" value="{{$user_id}}">
                <div class="jumbotron">
                    <h3 class="text-center text-success"> Thank You For Your Exam</h3>
                    <p class="text-center text-info">If you Pass we will phone or email you later</p>
                </div>

            </div>
        </div>
        {{--stop question box --}}
    </div>
@endsection


