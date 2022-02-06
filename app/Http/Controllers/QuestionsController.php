<?php

namespace App\Http\Controllers;

use App\Models\CodeQuestionsAnswer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Option;
use App\Models\Category;
use App\Models\QuestionType;
use Carbon\Carbon;

class QuestionsController extends Controller
{
    public function add_question_view(Request $request){


        $question_types = QuestionType::all();
        $question = new Question();
        $option = new Option();
        $category = new Category();
        $un_answered_question = DB::select('select * from check_answer');

        if(empty($un_answered_question)){
            $categories = $category->select()
            ->get();
            return ($request->ajax() ? view('admin.partial-question',['categories'=>$categories, 'question_types' => $question_types]) : view('admin.addquestion',['categories'=>$categories, 'question_types' => $question_types]));

        }else{
            $questions = $question->where('id',$un_answered_question[0]->question_id)
            ->select()
            ->get();
            $options = $option->where('question_id',$un_answered_question[0]->question_id)
            ->select()->get();
            return ($request->ajax() ? view('admin.partial-answer',['questions'=>$questions,'options'=>$options,  'question_types' => $question_types]) : view('admin.add-answer',['questions'=>$questions,'options'=>$options,  'question_types' => $question_types]));
        }

    }
    public function add_question_store(Request $request){

        if($request->question_type_id == 2){

            $validationRules = [
                     'category_id' => 'required',
                'question_type_id' => 'required',
                   'question_mark' => 'required|numeric',
                        'question' => 'required',
                 'question_answer' => 'required'
            ];

            $validator = Validator::make($request->all(),$validationRules);
            if($validator->fails()) {
                return Response::json(['failed'=>$validator->errors()]);
            }else{
                $question = new Question();
                $question->category_id = $request->category_id;
                $question->question_type_id = $request->question_type_id;
                $question->question_mark = $request->question_mark;
                $question->question = $request->question;
                $save = $question->save();

                if($save){
                        $insert = CodeQuestionsAnswer::create([
                            'question_id' => $question->id,
                            'question_answer' => $request->question_answer
                        ]);
                        if($insert){
                            return Response::json(['success'=>'All option save successfully']);
                        }

                }else{
                    return Response::json(['failed'=>'Question save failed']);
                }
            }
        }else{

            $validationRules = [
                'category_id' => 'required',
                'question_type_id' => 'required',
                'question_mark' => 'required',
                'question' => 'required',
                'option_1' => 'required',
                'option_2' => 'required',
                'option_3' => 'required',
                'option_4' => 'required',
            ];
            $validator = Validator::make($request->all(),$validationRules);
            if($validator->fails()) {
                return Response::json(['failed'=>$validator->errors()]);
            }else{

                $question = new Question();
                $question->category_id = $request->category_id;
                $question->question_type_id = $request->question_type_id;
                $question->question_mark = $request->question_mark;
                $question->question = $request->question;

                if($question->save()){
                    $question_id = $question->id;
                    $option = new Option();
                    $data = [
                        ['option'=>$request->option_1,'question_id'=>$question_id,'created_at'=>Carbon::now()],
                        ['option'=>$request->option_2,'question_id'=>$question_id,'created_at'=>Carbon::now()],
                        ['option'=>$request->option_3,'question_id'=>$question_id,'created_at'=>Carbon::now()],
                        ['option'=>$request->option_4,'question_id'=>$question_id,'created_at'=>Carbon::now()]
                    ];

                    if($option->insert($data)){
                        return Response::json(['success'=>'All option save successfully']);
                    }else{
                        return Response::json(['failed'=>'All option save failed']);
                    }
                }else{
                    return Response::json(['failed'=>'Question save successfully']);
                }
            }
        }

    }

    public function add_answer_store(Request $request){
        $question = new Question();
        $option = new Option();
        $un_answered_question = DB::table('check_answer')->select()->get();

        if(empty($un_answered_question)){
            return view('admin.addquestion');
        }else{
            $questions = $question->where('id',$un_answered_question[0]->question_id)
            ->select('question')
            ->get();
            $option->where('options.id',$request->option)
            ->update(['answer'=>1]);
            return Response::json(['success'=>"Answer added successfully"]);
        }
    }
    public function add_anser_view(){
        $question_types = QuestionType::all();
        $question = new Question();
        $option = new Option();
        $un_answered_question = DB::table('check_answer')->select()->get();
        if(empty($un_answered_question)){
            return view('admin.addquestion');
        }else{
            $questions = $question->where('id',$un_answered_question[0]->question_id)
            ->select('question')
            ->get();
            $option->where('options.id',$request->option)
            ->update(['answer'=>1]);
            return  view('admin.add-answer',['questions'=>$questions,'options'=>$un_answered_question,'question_types' => $question_types]);
        }
    }

    /* show all questions */
    public function showQuestion(Request $request){
        $questions = Question::paginate(4);
        return view('admin.showQuestions',['questions'=>$questions]);

    }

    //edit the questions
    public function editQuestion(Request $request){

                    $categories = Category::all();
                    $questionType = QuestionType::all();
                    $question = Question::where('id', $request->id)->first();
                    $options = Option::where('question_id', $request->id)->get();
                    $correct_answer = Option::where('question_id', $request->id)->where('answer', 1)->first();

                    return response()->json([
                        'categories' => $categories,
                        'questionType' => $questionType,
                        'question' => $question,
                        'options'  => $options,
                  'correct_answer' => $correct_answer
                    ]);

    }


    //update question and option
    public function updateQuestion(Request $request){

        $question_id = $request->question_id;
           $question = $request->question;
        $option_text = $request->option_text;
         dd ($option_text);
          $option_id = $request->option_id;

    }

    /** delete the question **/
    public function deleteQuestion(Request $request, $question_id){
       //retrieve all options according to question id
        $options = Option::where('question_id', $question_id)->get();
         foreach ($options as $option){
             $option->delete();
         }
         $delete = Question::where('id', $question_id)->delete();

         return response()->json([
             'message' => 'Question has been deleted successfully'
         ]);
    }
}
