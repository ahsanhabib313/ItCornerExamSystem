@extends('exam.index')
@section('content')
    @include('exam.header')
    <div class="d-flex justify-content-center row">
        <div class="col-md-5 m-5">
            <div class="card">
                <div class="card-body p-5">
                    <div id="errors"></div>

                    <form action="{{route('store.personal.info')}}" id="personaInfo" method="POST">

                        <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}">

                        <div class="form-group">
                            <select class="form-control  form-control-sm" name="fresher" onchange="isFresher(this.value)">
                                <option selected value="" >Are you Fresher..?</option>
                                <option value="1" >Yes</option>
                                <option value="0">No</option>
                            </select>

                        </div>

                        <div class=" experience_div" >
                            <div class="form-group">
                                <select class="form-control form-control-sm" name="experience">
                                    <option selected value="">Year of Experience...</option>
                                    <option value=".5" >.5 year</option>
                                    <option value="1">1 year</option>
                                    <option value="1.5">1.5 year</option>
                                    <option value="2">2 year</option>
                                </select>

                            </div>
                        </div>
                        <div class="salary_div">
                            <div class="form-group">
                                <input type="text" name="salary" id="salary"
                                       class=" form-control form-control-sm"  placeholder="Expected Salary...">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="city" id="city"
                                   class=" form-control form-control-sm" placeholder="Current City...">
                        </div>
                        <div class="form-group">
                            <textarea rows="2" class="form-control form-control-sm" placeholder="address.." name="address"></textarea>

                        </div>
                        <div class="form-group">
                            <input type="text" name="institute" class="form-control form-control-sm " id="institute" placeholder="Graduated From">
                        </div>
                        <div class="form-group">
                            <input type="text"  name="cgpa" class="form-control form-control-sm" id="cgpa" placeholder="B.Sc or Equivalent CGPA">
                        </div>
                        <button  onclick="skipPersonalInfo({{$user_id}})" class="btn btn-danger" >Skip</button>
                        <button type="submit"  class="btn btn-primary ml-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/personalInfo.js')}}">

    </script>
@endsection


