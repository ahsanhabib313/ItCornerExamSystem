@extends('exam.index')
@section('content')
    @include('exam.header')
    <div class="d-flex justify-content-center row">
        <div class="col-md-6 col-lg-8">
            <div class="jumbotron">
                <div id="errors"></div>

                <form action="{{route('store.personal.info')}}" id="personaInfo" method="POST">

                    <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}">

                        <div class="form-group">
                            <select class="form-control form-control" name="fresher" onchange="isFresher(this.value)">
                                <option value="">Are you Fresher..?</option>
                                <option value="1" >Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('fresher')
                            <p class="text-warning">{{$message}}</p>
                            @enderror
                        </div>

                        <div class=" experience_div" >
                            <div class="form-group">
                                <select class="form-control form-control" name="experience">
                                    <option value="">Year of Experience...</option>
                                    <option value=".5" >.5 year</option>
                                    <option value="1">1 year</option>
                                    <option value="1.5">1.5 year</option>
                                    <option value="2">2 year</option>
                                </select>
                                @error('experience')
                                <p class="text-warning">{{$message}}</p>
                                @enderror
                           </div>
                        </div>
                        <div class="salary_div">
                            <div class="form-group">
                                <input type="text" name="expected_salary" id="salary"
                                       class=" form-control form-control" value="" placeholder="Expected Salary...">
                                @error('expected_salary')
                                <p class="text-warning">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="city" id="city"
                                   class=" form-control form-control" placeholder="Current City...">
                            @error('city')
                            <p class="text-warning">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea rows="2" class="form-control" placeholder="address.." name="address"></textarea>
                            @error('address')
                            <p class="text-warning">{{$message}}</p>
                            @enderror
                        </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/personalInfo.js')}}">

    </script>
@endsection


