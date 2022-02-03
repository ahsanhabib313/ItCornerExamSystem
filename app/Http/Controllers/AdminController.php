<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class AdminController extends Controller
{

    //view admin dashboard
    public function dashboard(){
        return view('layouts.app');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.addquestion');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addQuestions()
    {
        return view('exam.questionsPage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required',
            'category' => 'required',
        ]);

        $question = $request->question;
        $option_a = $request->option_a;
        $option_b = $request->option_b;
        $option_c = $request->option_c;
        $option_d = $request->option_d;
        $correct_answer = $request->correct_answer;
        $category = $request->category;

        $store = Question::create([
            'question' => $question,
            'option-a' => $option_a,
            'option-b' => $option_b,
            'option-c' => $option_c,
            'option-d' => $option_d,
            'correct-answer' => $correct_answer,
            'category' => $category,
            

        ]);

        if($store){
            return response()->json(true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
