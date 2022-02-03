@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="border mt-3 admin-panel-shadow">
        <div class="text-secondary fw-bold admin-panel-heading p-3 bg-lisht text-center">
            Show Questions
        </div>
        <hr>
        <div class="p-3">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-12 ">
                    @isset($questions)

                        @foreach ($questions as $question)
                        <div class="jumbotron " id="question_section_{{$question->id}}">
                            <div class="question_section p-0">
                                <form action="{{url('admin/edit/question')}}" id="questionForm">
                                <h3 class="text-dark"><span>Q-{{$loop->index + 1}}</span>. {{$question->question}}</h4>
                                @php
                                    $options = App\Models\Option::where('question_id', $question->id)->get();

                                @endphp
                                @foreach ($options as $option)
                                     <h5 class="ml-4 py-1"><span>{{$loop->index+1}}</span>. {{$option->option}}</h5>
                                @endforeach
                                <div>
                                    <h6 class=" btn btn-success"><span>Correct Answer: </span>{{  $option = App\Models\Option::where('question_id', $question->id)->where('answer',1)->first()->option}}</h6>
                                    <h6 class=" btn btn-success"><span>Developer Category: </span>{{$question->category->name}}</h6>
                                    <h6 class=" btn btn-success"><span>Question Type: </span>{{strtoupper($question->questionType->name)}}</h6>
                                </div>
                                <div class="m-3">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editQuestionModal" onclick="editQuestion({{$question->id}})">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteQuestionModal" onclick="deleteQuestion({{$question->id}})">Delete</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        @endforeach

                    @endisset

              </div>
              {{$questions->links()}}
            </div>
        </div>
    </div>
</div>

{{--edit question modal--}}
<!-- Modal -->
<div class="modal fade" id="editQuestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title" id="exampleModalLabel">Question Update</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
             <div class="alert alert-warning error_msg"></div>

            <form id="updateForm" action="{{url('admin/update/question')}}">
                @csrf
                <div class="mb-3">
                    <div class="form-group">,,
                        <label for="categories">Select Developer Category</label>
                        <select class="form-control" id="categories" name="category_id">

                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="question_type">Select Exam Type</label>
                        <select class="form-control" id="question_type" name="question_type_id">

                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="questionMark">Question Mark</label>
                    <input type="number" name="question_mark" type="text" class="form-control" >
                </div>
                <div class="mb-3">
                    <label for="question" class="form-label">Question</label>
                    <textarea name="question" id="question"  rows="3" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="option_a" class="form-label">Option A</label>
                    <input type="text" name="option_1" id="option_1" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="option_a" class="form-label">Option B</label>
                    <input type="text" name="option_2" id="option_2" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="option_a" class="form-label">Option C</label>
                    <input type="text" name="option_3" id="option_3" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="option_a" class="form-label">Option D</label>
                    <input type="text" name="option_4" id="option_4" class="form-control">
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="correct_option">Select Currect Option</label>
                        <select class="form-control" id="correct_option" name="correct_option">

                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <!-- <input type="submit" value="Save Question" class="btn btn-primary float-right"> -->
                    <button type="submit" id="add-question-btn" class="btn btn-primary float-right">Save Question</button>
                    <div class="clearfix"></div>
                </div>
            </form>

        </div>
      </div>
    </div>
  </div>

  {{--delete category modal--}}
<!-- Modal -->
<div class="modal fade" id="deleteQuestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="question_id">
            <div class="alert alert-warning error_msg">
            </div>
                <div class="container">
                    <div class="row d-flex justify-content-center">
                            <div>
                            <h2 class="text-danger confirm"> Are you Confirm...?</h2>
                                <h3 class="text-success msg" style="display: none"></h3>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        var deleteQuestionUrl = "<?php echo url('admin/delete/question') ?>";
    </script>
  <script src="{{asset('assets/js/question.js')}}"  async></script>
@endsection
