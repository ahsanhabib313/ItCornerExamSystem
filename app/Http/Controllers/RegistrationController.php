<?php

namespace App\Http\Controllers;
require_once('ItUpload.php');
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\User;
use App\Models\Setting;

class RegistrationController extends Controller
{
    // show the registraion page
    public function showPage(Request $request){

        $categories = Category::get();

        return view('auth.registration', compact('categories'));
    }

    //user registration
    public function register(Request $request){
        
        //validate the function
        $request->validate([
            'first_name' => 'required|max:20',
            'last_name'  => 'required|max:20',
            'gender'     => 'required',
            'age'        => 'required|numeric',
            'email'      =>  'required|email|unique:users',
            'password'   => 'required|min:6',
         'mobile_number' => 'required|numeric',
              'category' => 'required',
               'fresher' => 'required',
                  'city' => 'required',
               'address' => 'required',
               'image'   => 'required'
        ]);

        //validate expected_salary and experience if user is not a fresher
        if($request->fresher == 0){
            $request->validate([
                'experience' => 'required',
                'expected_salary' => 'required',
            ]);
        }

         //get the latest question limit
         $setting = Setting::orderBy('id', 'desc')->first();
         if(empty($setting)){
             $setting_id = null;
         }else{
             $setting_id = $setting->id;
         }
         $file_type = ["jpg","png","jpeg","gif"];
         $config_data = [
             "file_name"      => 'profile', //you may set a file name
             "name_attribute" => "image", //value of input field name attribute
             "target_dir"     => "assets/img/",
             "watermark"      => false, 
         ];
         $upload = new ItUpload($config_data); 
         $upload_status = $upload->store();
         $file_dir = $upload->get_target_file();
        if($upload_status['status'] ==='success'){
            //create the user
            $user_id = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'gender'     => $request->gender,
                'age'        => $request->age,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
             'mobile_number' => $request->mobile_number,
          'category_id'      => $request->category,
             'fresher'       => $request->fresher,
             'experience'    => $request->experience,
                    'salary' => $request->expected_salary,
             'city'          => $request->city,
             'address'       => $request->address,
                'setting_id' => $setting_id,
               'image'       =>$file_dir[0]

            ])->id;
        }
        
        

 return redirect()->route('user.exam', [$user_id]);
    }
}