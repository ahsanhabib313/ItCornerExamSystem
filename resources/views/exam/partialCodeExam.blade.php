
<div class="container-fluid">
    {{--start company name title --}}
    <div class="company-name">
       {{-- <h3 class="text-center p-2 text-success title" style="text-decoration: underline; font-weight:600">IT Corner
            Online Exam </h3>--}}
    </div>
    {{--stop company name title --}}
    {{--start question box --}}
    <input type="hidden" class="user_id" value="{{$user_id}}">
    <div class="d-flex justify-content-center row">
        <div class="col-md-12 col-lg-12">
            <div id="content_section">
                <div class="mb-5">
                    <form action="{{ route('user.question.answer.store') }}" id="questionAnswerForm">
                        <input type="hidden" id="user_id" value="{{$user_id}}">
                        <input type="hidden" id="question_id" value="{{$question->id}}">
                        <input type="hidden" id="question_limit" value="{{$question_limit}}">
                        <input type="hidden" id="question_type_id" value="{{$question_type_id}}">
                        <input type="hidden" id="mcq_ques_time" value="{{$mcq_ques_time}}">
                        <input type="hidden" id="code_ques_time" value="{{$code_ques_time}}">



                        <div class="question bg-white p-3 border-bottom" style="overflow: auto">
                            <div class="d-flex flex-row justify-content-between align-items-center mcq">
                                <h4 class="text-danger">Code Problem</h4>
                                <div class="btn btn-success">You Have Remaining: <span class="timer_value badge badge-warning">
                    </span><span class="timer_unit"> second</span></div>
                                <div class="btn btn-info">
                                    (<span id="current_ques_no">{{$current_ques_no}}</span> of <span>{{$question_limit}}</span>)
                                </div>
                            </div>
                        </div>
                        <div class="question bg-white p-5 border-bottom">
                            <div class="d-flex flex-row  align-items-center question-title">
                                <h3 class="text-danger">Q.</h3>
                                <h5 class="mt-1 ml-2" id="question">{{$question->question}}</h5>

                            </div>
                             <div id="code_section">
                                 <div class="row d-flex align-items-stretch" style="min-height: 500px">
                                    <div class="col-6">
                                        <textarea class="codemirror-textarea" id="code-editor"></textarea>
                                        <div class="app-row">
                                            <button class="btn-action" id="run">Run</button>
                                            <button class="btn-action" id="clear">Clear</button>
                                            {{--  <button class="btn-action" id="refresh">Refresh</button><span id="error"></span>--}}
                                        </div>
                                    </div>
                                     <div class="col-6">
                                         <div id="result"></div>
                                     </div>
                                 </div>

                             </div>
                        </div>
                        <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
                            <div>
                                <button class="btn btn-danger border-danger align-items-center" type="button"
                                        id="skipQuestionBtn">Skip<i class="fa fa-angle-right ml-2"></i></button>
                            </div>
                            <div>
                                <button class="btn btn-primary border-success align-items-center btn-success" type="button"
                                        id="nextQuestionBtn">Next<i class="fa fa-angle-right ml-2"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{--stop question box --}}


