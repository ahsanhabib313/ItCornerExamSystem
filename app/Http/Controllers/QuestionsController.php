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

        $questions = Question::paginate(5);
        return view('admin.showQuestions',['questions'=>$questions]);

    }

    //edit the questions
    public function editQuestion(Request $request){

                    $categories = Category::all();
                    $question = Question::with('questionType')->where('id', $request->id)->first();
                    if($question->question_type_id == 1){
                        $options = Option::where('question_id', $request->id)->get();
                        $option_answer_id = Option::where('question_id', $request->id)->where('answer', 1)->first()->id;
                            return response()->json([
                                    'categories' => $categories,
                                    'question' => $question,
                                    'options'  => $options,
                                    'option_answer_id'=> $option_answer_id
                            ]);
    
                    }else{
                        $code_answer = CodeQuestionsAnswer::where('question_id', $request->id)->first()->question_answer;
                        return response()->json([
                                'categories' => $categories,
                                  'question' => $question,
                               'code_answer' => $code_answer
                        ]);
                    }
                   
                  
    }


    //update question and option
    public function updateQuestion(Request $request){
        
        /** get the all inputs */
        $question_type_id = $request->question_type_id;
        $question_id = $request->question_id;
        $question = $request->question;
        $category_id = $request->category_id;
        $question_mark = $request->question_mark;

        if($question_type_id == 1){
            $option_id = json_decode($request->option_id);
            $option_text = json_decode($request->option_text);
            $option_answer_id = $request->option_answer_id;
            
            //update the questions
            $update_question = Question::where('id', $question_id)
                               ->update([
                                   'question' => $question,
                                   'category_id' => $category_id,
                                   'question_mark' => $question_mark
                               ]);
            
                //update the options
                if($update_question){
                    for( $i= 0; $i< count($option_id); $i++){
                        $id = (int)$option_id[$i];
                        Option::where('id', $id)
                                ->update([
                                    'option' => $option_text[$i],
                                    'answer' => 0
                                ]);
                    }    
                }

                $option_answer_update = Option::where('id', $option_answer_id)
                                            ->update([
                                                'answer' => 1
                                            ]);
           
                    if($option_answer_update){
                        return response()->json(true);
                    }  

    }else{

         $code_answer = $request->code_answer;

        //update the questions
        $update_question = Question::where('id', $question_id)
                            ->update([
                                'question' => $question,
                                'category_id' => $category_id,
                                'question_mark' => $question_mark
                            ]);

        //update the code answers
        if($update_question){

        CodeQuestionsAnswer::where('question_id', $question_id)
                                        ->update([
                                            'question_answer' => $code_answer
                                        ]);

        }    
        
        return response()->json(true);

    }      

    }


    /** delete the question **/
    public function deleteQuestion(Request $request){
        
        $question_id = $request->question_id;
        $question_type_id = $request->question_type_id;

        if($question_type_id == 1){
            //retrieve all options according to question id
            $options = Option::where('question_id', $question_id)->get();
            foreach ($options as $option){
                $option->delete();
            }

            $question = Question::where('id', $question_id)->first();
            $delete = $question->delete();
            if($delete){
                return response()->json(true);
            }else{
                return response()->json();
            }
            
        }else{

            $code_ques_answer = CodeQuestionsAnswer::where('question_id', $question_id)
                               ->first();
            $code_delete = $code_ques_answer->delete();

            if($code_delete){
                $question = Question::where('id', $question_id)->first();
                $delete = $question->delete(); 
                if($delete){
                    return response()->json(true);
                }
            }else{
                return response()->json();
            }
        }
      
    }
}
