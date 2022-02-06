<?php

namespace App\Http\Controllers;

use App\Models\CodeQuestionsAnswer;
use App\Models\RelationUsersQuestion;
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
        $relation_user_question = RelationUsersQuestion::where('user_id', $user_id)->where('exam_id', $exam->id)->get();

        //find the correct answer
        $examinee_mark =0;
        $total_mark = 0;
        foreach($relation_user_question as $item){
             $total_mark += $item->question->question_mark;
            if($item->question->question_type_id == 1){
                $option = Option::where('id', $item->examinee_answer)->where('question_id', $item->question_id)->where('answer', 1)->first();
                if($option){
                    $examinee_mark += $item->question->question_mark;
                }
            }else{
                $codes_answer = CodeQuestionsAnswer::where('question_id', $item->question_id)->first()->question_answer;
                if($codes_answer == $item->examinee_answer){
                    $examinee_mark += $item->question->question_mark;
                }
            }
        }
        //get the user instance
        $user = User::find($user_id);

        //get the question limit
        $question_limit = $user->setting->question_limit;

        //get the latest pass mark as percentage
        $pass_mark =  $user->setting->pass_mark;

        //calcuate the examinee mark percentage
        $examinee_mark = round(($examinee_mark * 100)/$total_mark, 2);

        //decide wether he is pass or fail or suspend
        if($exam->suspend == 1){
            $status = 'suspend';
             $badge = 'warning';
        }else{
            if($examinee_mark>= $pass_mark){
                $status = 'pass';
                 $badge = 'success';
            }else{
                $status = 'fail';
                 $badge = 'danger';
            }
        }

        //update the status on setting table
        $exam->update([
                     'status' => $status
                 ]);
        //get the category
        $category = $user->category->name;

        return view('exam.result', compact('question_limit','examinee_mark', 'pass_mark', 'status', 'category', 'badge','user_id'));

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
