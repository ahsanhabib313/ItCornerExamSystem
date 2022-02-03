<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function viewCv()
    {
        // $total_answer = DB::table('questions')
        //     ->where('relation_users_questions.examinee_answer', '=', 'options.id')
        //     ->where('relation_users_questions.user_id', '=', '12')
        //     ->join('relation_users_questions', 'questions.id', '=', 'relation_users_questions.question_id')
        //     ->join('relation_users_questions', 'options.question_id', '=', 'relation_users_questions.question_id')
        //     ->select(DB::raw("count('questions.question_id')"))
        //     ->get();
        // echo "<pre>";
        // print_r($total_answer);
        // echo "</pre>";
        // select count('questions.question_id') from `questions` 
        // inner join `relation_users_questions` on `questions`.`id` = `relation_users_questions`.`question_id` 
        // inner join `options` on `relation_users_questions`.`question_id` = `options`.`question_id` 
        // where (`relation_users_questions`.`examinee_answer` = options.id and answer=1) 
        // and `relation_users_questions`.`user_id` = 12;
 
        $categories = DB::table('users')
            ->join('categories', 'users.category_id', '=', 'categories.id')
            ->select(
                'categories.name'
            )->get();

        $users = User::all();
        return view('admin.view-cv', compact('users'));
    }
}
