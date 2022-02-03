@extends('admin.layout')

@section('content')

<div class="container-fluid ">
    <div class="row d-flex justify-content-center align-content-center">
        <div class="col-md-6  my-5">
            <div class="jumbotron p-5">
                <div>
                    <h1 class="text-center font-weight-bold text-success">Question Form</h3>
                </div>
                <div class="alert alert-danger errors">
                        <ul class="error-list">
                            
                        </ul>
                </div>
                <div class="alert alert-success msg">
                    <ul class="msg-list">
                        
                    </ul>
            </div>
                <form id="questionForm" action="{{route('admin.store.questions')}}">
                    @csrf
                    <div class="form-group">
                      <label for="questions">Questions.</label>
                      <textarea rows="3" class="form-control" name="question" placeholder="write your question..."></textarea>
                     
                    </div>
                    <div class="form-group">
                      <label for="option-a">Option A.</label>
                      <input type="text" name="option_a" class="form-control" onchange="getOptionAvalue(this.value)">
                     
                    </div>
                    <div class="form-group">
                        <label for="option-a">Option B.</label>
                        <input type="text" name="option_b" class="form-control" onchange="getOptionBvalue(this.value)">
                       
                    </div>
                    <div class="form-group">
                        <label for="option-a">Option C.</label>
                        <input type="text" name="option_c" class="form-control" onchange="getOptionCvalue(this.value)">
                       
                    </div>
                    <div class="form-group">
                        <label for="option-a">Option D.</label>
                        <input type="text" name="option_d" class="form-control" onchange="getOptionDvalue(this.value)">
                       
                    </div>
                    <div class="form-group">
                        <label for="">Correct Answer.</label>
                        <select name="correct_answer" class="form-control">
                               
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="category" class="form-control">
                                <option value=""  selected>Choose the Category</option>
                                <option value="php developer">PHP DEVELOPER</option>
                                <option value="laravel developer">LARAVEL DEVELOPER</option>
                                <option value="java developer">JAVA DEVELOPEPR</option>
                                <option value="mern developer">MERN DEVELOPEPR</option>
                        </select>
                    </div>
                    <button type="submit" id="save" class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('assets/js/questionForm.js')}}"></script>
@endsection