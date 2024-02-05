<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function test(){
        $data = Student::get();

        return response()->json($data, 200);        
    }
    public function addStudent(Request $request){
        $data = Student::create([
            "fullname" => $request-> fullname,
            "age" => $request-> age,
            "address" => $request-> address,
        ]);
   
        return response()->json($data, 200);        
    }

        public function updateStudent(Request $request, $id){
           
            $student = Student::find($id);
            $avatar = $student->avatar; 
           $file =$request->file("avatar");
           if($file){

            $file_name = Str::random(20);
            $ext = strtolower($file->getClientOriginalExtension()); // You can use also getClientOriginalName()
            $file_full_name = $file_name . '.' . $ext;
            $upload_path = 'upload/avatar/image/';    //Creating Sub directory in Public folder to put image
            $save_url_file = $upload_path . $file_full_name;
            $success = $file->move($upload_path, $file_full_name);
            $avatar =  $save_url_file; 

           }

        $student->update([   
            "fullname" => $request-> fullname,
            "age" => $request-> age,
            "address" => $request-> adress,
            "avatar" => $avatar,
        ]);
   

        return response()->json(null, 200);        
    }

    public function delateStudent($id){

        $student = Student::find($id);
        $student->Student::delete();

    return response()->json(null, 200);        
   }
}
