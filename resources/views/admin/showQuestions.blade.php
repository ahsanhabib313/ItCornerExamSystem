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
                                <h3 class="text-dark"><span>Q-{{$loop->index + 1}}</span>.<span class="question"> {{$question->question}}</span></h4>
                                @php
                                    $options = App\Models\Option::where('question_id', $question->id)->get();
                                    $option_answer = App\Models\Option::where('question_id', $question->id)->where('answer',1)->first();
                                    $code_answer = App\Models\CodeQuestionsAnswer::where('question_id', $question->id)->first();


                                @endphp
                                @isset($options)
                                        @foreach ($options as $option)
                                        <h5 class="ml-4 py-1"><span>{{$loop->index+1}}</span>. <span class="option_{{$option->id}}"> {{$option->option}}</span></h5>
                                        @endforeach
                                @endisset
                               
                                <div class="mt-3">
                                    @if (is_null($option_answer))
                                    <h6 class=" btn btn-success"><span>Correct Answer: </span><span class="correct_answer">{{$code_answer->question_answer}}</span></h6>
                                    @endif
                                    
                                    @if (is_null($code_answer))
                                    <h6 class=" btn btn-success"><span>Correct Answer: </span><span class="correct_answer">{{$option_answer->answer}}</span></h6>
                                    @endif
                                   
                                    <h6 class=" btn btn-success"><span>Developer Category: </span><span class="category">{{$question->category->name}}</span></h6>
                                    <h6 class=" btn btn-success"><span>Question Type: </span>{{strtoupper($question->questionType->name)}}</h6>
                                </div>
                                <div class="m-3">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editQuestionModal" onclick="editQuestion({{$question->id}})">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteQuestionModal" onclick="deleteQuestion({{$question->id }}, {{$question->question_type_id}})">Delete</button>
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
          <h3 class="modal-title font-weight-bold text-black" id="exampleModalLabel">Question Update</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
             <div class="alert alert-warning error_msg text-danger"></div>
             <div class="alert alert-success success_msg text-success">Hello</div>

            <form id="updateForm" action="{{route('admin.update.question')}}" method="POST">

                <input type="hidden" id="question_id">
                <input type="hidden" id="question_type_id">
                <h3 class="text-black font-weight-bold">Type: <span class="question_type"> </span></h3>

                <div class="mb-3">
                    <div class="form-group">
                        <label for="categories">Select Developer Category</label>
                        <select class="form-control text-black" id="category_id" >
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="questionMark">Question Mark</label>
                    <input type="number" id="question_mark" type="text" class="form-control text-black" >
                </div>
                <div class="mb-3">
                    <label for="question" class="form-label">Question</label>
                    <textarea  id="question"  rows="3" class="form-control text-black"></textarea>
                </div>
                <div id="code_answer">

                </div>
                <div id="options_input">

                </div>
                <div id="option_answer">
                 
                </div>
                <div class="mb-3">
                    <!-- <input type="submit" value="Save Question" class="btn btn-primary float-right"> -->
                    <button onclick="updateQuestion()" type="button" class="btn btn-primary float-right">Update Question</button>
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
        <form id="deleteQuestionForm" action="{{route('admin.delete.question')}}" method="POST">
        <div class="modal-body">
            <input type="hidden" id="question_id">
            <input type="hidden" id="question_type_id">
            <div class="alert alert-warning text-danger error_msg"></div>
            <div class="alert alert-success text-success success_msg"></div>
                <div class="container">
                    <div class="row d-flex justify-content-center">
                            <div>
                            <h2 class="text-danger "> Are you Confirm...?</h2>
                                
                            </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="button" id="confirmBtn" class="btn btn-primary">Yes</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    //var deleteQuestionUrl = "<?php echo url('admin/delete/question') ?>";
   
</script>
 
@endsection

