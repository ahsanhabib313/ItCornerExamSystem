<?php

namespace App\Http\Controllers;

use App\Models\CodeQuestionsAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Setting;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the input
        $request->validate([
                  'fresher' => 'required|nullable',
                     'city' => 'required',
                  'address' => 'required',
                'institute' => 'required',
                'cgpa'      => 'required',

        ]);

        //validate expected_salary and experience if user is not a fresher
        if($request->fresher == 0){
            $request->validate([
                     'experience' => 'required',
                         'salary' => 'required|numeric',
            ]);
        }

                $user_id = $request->user_id;
                $fresher = $request->fresher;
             $experience = $request->experience;
                 $salary = $request->salary;
                   $city = $request->city;
                $address = $request->address;
              $institute = $request->institute;
                   $cgpa = $request->cgpa;

        //update the user personal info
        $update = User::where('id', $user_id)
                    ->update([
                    'fresher' => $fresher,
                 'experience' => $experience,
                     'salary' => $salary,
                       'city' => $city,
                    'address' => $address,
                  'institute' => $institute,
                       'cgpa' => $cgpa

                    ]);

       if($update){
           return ($this->getExamineeResult($user_id));
       }else{
           return response()->json();
       }
    }


    //get the result
    public function getExamineeResult($user_id){

        //get the user latest exam instance
        $exam = Exam::orderBy('id','desc')->where('user_id', $user_id)->first();

        //get the user answer list
        $relation_user_question = DB::table('relation_users_questions')->where('user_id', $user_id)->where('exam_id', $exam->id)->get();

        //find the correct answer
        $correct_answer_no =0;
        foreach($relation_user_question as $item){
            if($item->question_type_id == 1){
                $option = Option::where('question_id', $item->question_id)->where('id', $item->examinee_answer)->where('answer', 1)->first();
                if($option){
                    $correct_answer_no +=1;
                }
            }else{
                $codes_answer = CodeQuestionsAnswer::where('question_id', $item->question_id)->first()->question_answer;
                if($codes_answer == $item->examinee_answer){
                    $correct_answer_no +=1;
                }
            }
        }
        //get the latest question limit
        $question_limit = Setting::orderBy('id', 'desc')->first()->question_limit;
        //get the latest pass mark
        $pass_mark = Setting::orderBy('id', 'desc')->first()->pass_mark;
        //decide weather he is pass or fail or suspend
        if($exam->suspend == 1){
            $status = 'suspend';
            $badge = 'warning';
        }else{
            if($correct_answer_no>= $pass_mark){
                $status = 'pass';
                $badge = 'success';
            }else{
                $status = 'fail';
                $badge = 'danger';
            }
        }

        //update the status on setting table
        Exam::orderBy('id','desc')->where('user_id', $user_id)
                 ->update([
                     'status' => $status
                 ]);

        $user = User::where('id', $user_id)->first();
        $category = $user->category->name;

        return view('exam.result', compact('question_limit','correct_answer_no', 'pass_mark', 'status', 'category', 'badge','user_id'));

    }

    /** user make suspended function */
    public function userSuspend($user_id){

        $update = Exam::where('user_id', $user_id)
                    ->whereDate('created_at', '=', date('Y-m-d'))
                    ->orderBy('id','desc')
                    ->update([
                           'suspend' => 1
                       ]);

        return view('exam.suspend', compact('user_id'));


    }



}
