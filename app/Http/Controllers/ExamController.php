<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Setting;
use App\Models\Option;
use App\Models\Exam;
use App\Models\User;

class ExamController extends Controller
{

    //get the questions page
    public function getQuestion(Request $request, $user_id){

        //user object
        $user = User::find($user_id);
        //initially retrieve a exam instance for the examinee
        $exam = Exam::whereDate('created_at', '=', date('Y-m-d'))->where('user_id',  $user_id)->first();

        //check if the user is inexist in exam table
        if(empty($exam)){
            $exam = Exam::create([
                'user_id' =>  $user_id,
                'status'  => null
            ]);
        }

        //check if the use is suspend in the exam table
        if($exam->suspend == 1){
            return view('exam.suspend', compact('user_id'));
        }

        //get the setting instance
        $setting = Setting::find($user->setting_id);

        //get the question limit
        $question_limit = $setting->question_limit;

        //get the category
        $category_id = $setting->category_id;

        //get mcq question time
        $mcq_ques_time = $setting->mcq_ques_time;

        //get mcq question time
        $code_ques_time = $setting->code_ques_time;

        //retrieve a random question from questions table
        $question = Question::where('category_id',$category_id)->inRandomOrder()->first();

        //retrieve the question type id
        $question_type_id = $question->question_type_id;

        //get the current_position value initial
        $current_ques_no = DB::table('relation_users_questions')->where('user_id', $user_id)->where('exam_id', $exam->id)->count();

        $current_ques_no += 1;

        if($request->ajax() && $current_ques_no>$question_limit){
            return  view('exam.personalInfo', compact('user_id'));
        }

        //if get tha all questions answer go to the personal info page
        if(!($request->ajax()) && $current_ques_no > $question_limit) {

            //get the before exam date
             $exam_created_at = DB::table('relation_users_questions')->where('user_id',  $user_id)->whereDate('created_at', '=', date('Y-m-d'))->orderBy('id','desc')->first();

            //check whether the last exam date and today's date are same
            if($exam_created_at){
                return view('exam.thankYouPage', compact('user_id'));
            }

        }

        //check question type id
        if( $question->question_type_id == 1){

            //retrieve the options from option table according to question id
            $options = Option::where('question_id', $question->id)->get();
            return(view('exam.mcqExam', compact('options','question_limit','question','current_ques_no','user_id','question_type_id','mcq_ques_time','code_ques_time')));
        }

        //check question type id
        if( $question->question_type_id == 2 && $question->category_id == 1){

            return(view('exam.phpCodeExam', compact('question_limit','question','current_ques_no','user_id','question_type_id', 'mcq_ques_time','code_ques_time')));
        }
        //check question type id
        if( $question->question_type_id == 2 && $question->category_id == 2){

            return(view('exam.jsCodeExam', compact('question_limit','question','current_ques_no','user_id','question_type_id', 'mcq_ques_time','code_ques_time')));
        }

    }

    //get the next question
    public function questionAnswerStore(Request $request){

        //get the data
        $user_id = $request->user_id;
        $question_id  = $request->question_id;
        $examinee_answer = $request->examinee_answer;

        //compare examinee result with undefine value
        if(strcmp($examinee_answer,'undefined') == 0){
            $examinee_answer = null;
        }

        $exam = Exam::where('user_id',  $user_id)->whereDate('created_at', '=', date('Y-m-d'))->orderBy('id', 'desc')         ->first();

        //check whether user is suspended
        if($exam->suspend == 1){
            return response()->json([
                'suspend' => 1,
                'user_id' => $user_id
            ]);
        }

        //store the data in table
        $store = DB::table('relation_users_questions')
                    ->insert([
                        'user_id'         =>  $user_id,
                        'exam_id'         => $exam->id,
                        'question_id'     => $question_id,
                        'examinee_answer' => $examinee_answer,
                        'created_at'      =>  date('Y-m-d H:i:s'),
                        'updated_at'      =>  date('Y-m-d H:i:s')
                    ]);

        return response()->json([
            'user_id' => $user_id
        ]);
    }
}
