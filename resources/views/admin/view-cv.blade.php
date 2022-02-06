<?php

use App\Models\RelationUsersQuestion;
use App\Models\User;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Exam;

?>
<?php
$total_mark = 0;
$examinee_mark = 0;
?>
@extends('layouts.app')
@section('content')
<div class="container">

    <!--Examinee Result Summary -->

    <table class="table table-striped mb-3 mt-5" style="max-width: 70%; margin:auto">
        <thead>
            <tr class="text-white" style="background-color: #7dc855;">
                <th colspan="5">
                    <h2 class="text-center">View Result</h2>
                </th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            $serial = 1;
            @endphp
            @foreach($users as $user)
            <tr>
                <th scope="row">{{$serial++}}</th>
                <td>{{$user->first_name." ".$user->last_name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->mobile_number}}</td>
                <td>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal<?php echo ($user->id) ?>">View Details</a>

                    <!-- Modal -->
                    <div style="max-width: 21cm 29.7cm; margin: 5mm 45mm 5mm 45mm;" class="modal fade" id="exampleModal<?php echo ($user->id) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="border-top-left-radius:10px; border-top-right-radius:10px">
                                <div class="modal-header text-white" style="background-color: #2979ff!important; border-top-left-radius:10px; border-top-right-radius:10px">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Exam-[
                                        <?php
                                        $exam_count = DB::select("select count(user_id) as exam_count from exams where user_id = $user->id");
                                        $exam_date = DB::select("select created_at as exam_date from exams where user_id = $user->id ORDER BY created_at LIMIT 1");
                                        echo $exam_count[0]->exam_count;
                                        echo "]";
                                        $exam = new Exam();

                                        echo " " . \Carbon\Carbon::parse($exam_date[0]->exam_date)->isoFormat('MMM Do YYYY');
                                        ?>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- start cv content -->
                                    <div class="col-lg-12">
                                        <div class="col-lg-10 mt-3 mb-3 pt-3 bg-white">
                                            <div class="col-lg-8 float-left">
                                                <table class="table table-borderless table-white text-dark">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="4">
                                                                <h5 class="text-dark mt-3"><strong>Personal Information</strong></h5>
                                                                <hr>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th class="test-secondary">Name</th>
                                                            <td>:</td>
                                                            <td style="color: black;">{{$user->first_name." ".$user->last_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="test-secondary">Email</th>
                                                            <td>:</td>
                                                            <td>{{$user->email}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="test-secondary">Phone</th>
                                                            <td>:</td>
                                                            <td>{{$user->mobile_number}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="test-secondary">Address</th>
                                                            <td>:</td>
                                                            <td>{{$user->address}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="test-secondary">Gender</th>
                                                            <td>:</td>
                                                            <td>{{$user->gender}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="test-secondary">Age</th>
                                                            <td>:</td>
                                                            <td>{{$user->age}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="test-secondary">City</th>
                                                            <td>:</td>
                                                            <td>{{$user->city}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="test-secondary">Address</th>
                                                            <td>:</td>
                                                            <td>{{$user->address}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="4">
                                                                <h5 class="text-dark mt-3"><strong>Academic Information</strong></h5>
                                                                <hr>
                                                            </th>
                                                        </tr>

                                                        <tr>
                                                            <th>Institute Name</th>
                                                            <td>:</td>
                                                            <td>NA</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Registration No</th>
                                                            <td>:</td>
                                                            <td>NA</td>
                                                        </tr>
                                                        <tr>
                                                            <th>CGPA</th>
                                                            <td>:</td>
                                                            <td>NA</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Session</th>
                                                            <td>:</td>
                                                            <td>NA</td>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="4">
                                                                <h5 class="text-dark mt-3"><strong>Experience</strong></h5>
                                                                <hr>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>Experience</th>
                                                            <td>:</td>
                                                            <td>{{$user->experience}} Years</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Expected Salary</th>
                                                            <td>:</td>
                                                            <td>{{$user->salary}}/=</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-lg-4 float-right bg-gray p-0 border-none">
                                                <div class="card p-0 bg-gray">
                                                    <img src="{{asset($user->image)}}" height="200" width="200" class="p-1 m-3" alt="cv-profile" style="border: 1px solid #2979ff; border-radius: 5px; float: center;">
                                                    <h5 class="pl-0 pr-0 pt-1 pb-1 m-0 text-left text-dark" style="padding-left: 1rem !important;">Apply For PHP Developer</h5>
                                                    <div class="card-body pb-1" style="padding-left: 1rem !important;">
                                                        <h5 class="card-title text-dark"><strong>Exam Result</strong></h5>
                                                    </div>
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>Total Questions</td>
                                                                <td>
                                                                    <?php
                                                                    $total_questions = DB::select("select count('question_id') as total_question from relation_users_questions where user_id = $user->id;");
                                                                    echo $total_question = $total_questions[0]->total_question;
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total Marks</td>
                                                                <td>
                                                                    <?php
                                                                    $total_mark;
                                                                    $total_marks = DB::select("select sum(questions.question_mark) as total_marks from relation_users_questions inner join questions where relation_users_questions.question_id = questions.id && relation_users_questions.user_id = $user->id;");

                                                                    if ($total_question == 0) {
                                                                        echo $total_mark = 0;
                                                                    } else {
                                                                        echo $total_mark = $total_marks[0]->total_marks;
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Examinee Marks</td>
                                                                <td>
                                                                    <?php
                                                                    // $total_answer = DB::select("select count('questions.id') as total_answer from `questions` inner join `relation_users_questions` on `questions`.`id` = `relation_users_questions`.`question_id`  inner join `options` on `relation_users_questions`.`question_id` = `options`.`question_id` where (`relation_users_questions`.`examinee_answer` = options.id and answer=1) and `relation_users_questions`.`user_id` = 12;");
                                                                    // echo $total_answer[0]->total_answer;
                                                                    $examinee_mark;
                                                                    $examinee_marks = DB::select("select sum(questions.question_mark) as examinee_marks from questions inner join relation_users_questions on questions.id = relation_users_questions.question_id inner join options on relation_users_questions.question_id = options.question_id where(relation_users_questions.examinee_answer = options.id and options.answer = 1 and relation_users_questions.user_id = $user->id)");
                                                                    $examinee_mark = $examinee_marks[0]->examinee_marks;
                                                                    if ($examinee_mark == null) {
                                                                        echo $examinee_mark = 0;
                                                                    } else {
                                                                        echo $examinee_mark;
                                                                    }

                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Status</td>
                                                                <td>
                                                                    <?php
                                                                    $pass_mark = 0;
                                                                    if ($total_mark == 0) {
                                                                        echo "[" . round($pass_mark, 2) . "%]";
                                                                    } else {
                                                                        $pass_mark = (($examinee_mark * 100) / $total_mark);
                                                                        echo "[" . round($pass_mark, 2) . "%]";
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="clear-fixed"></div>
                                        </div>
                                        <div class="clear-fixed"></div>
                                    </div>
                                    <!-- end cv content -->
                                </div>
                                <div class="modal-footer" style="border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Print</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
</div>
@endsection
