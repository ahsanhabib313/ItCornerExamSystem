<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

use App\Models\User;
use App\Models\Setting;
use App\Models\Category;
use App\Models\QuestionType;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::all();
        return view('admin.add-setting', compact('categories'));
    }

    public function store_setting(Request $request){

        $validation_rules = [
            'question_limit'=>'required|min:5|max:100|numeric',
            'pass_mark'=>'required|numeric',
            'category_id'=>'required',
            'mcq_ques_time'=>'required|numeric',
            'code_ques_time'=>'required|numeric',
        ];
        $validator = Validator::make($request->all(),$validation_rules);
        if($validator->fails()) {
            return Response::json(['failed'=>$validator->errors()]);
        }else{
            $users = User::all();
            $setting = new Setting();
            $setting->question_limit = $request->question_limit;
            $setting->pass_mark = $request->pass_mark;
            $setting->category_id = $request->category_id;
            $setting->mcq_ques_time = $request->mcq_ques_time;
            $setting->code_ques_time = $request->code_ques_time;
            if($setting->save()){
                $setting_id = Setting::orderBy('id','desc')->first()->id;
                if($setting_id){
                    foreach($users as $user){
                        User::where('id', $user->id)
                                ->update([
                                    'setting_id' => $setting_id
                                ]);
                    }
                }

                return Response::json(['success'=>"Setting page set successfully"]);
            }else{
                return Response::json(['failed'=>"Sorry Operation failed! Please try again later"]);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_setting()
    {
        //get all settings
        $settings = Setting::all();
        $categories = Category::all();
        return view('admin.show-setting', compact('settings', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
