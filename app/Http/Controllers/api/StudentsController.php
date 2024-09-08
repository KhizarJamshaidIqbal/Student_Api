<?php

namespace App\Http\Controllers\api;

use App\Models\student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    public function index() {
        $students = student::all();
        if ($students->count() > 0) {
            return response()->json([
                'status' => 200,
                'Students' => $students
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'Students' => 'No Records Found'
            ], 404);
        }
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'age' => 'required|integer|max:200',
            'course' => 'required|string|max:150',
            'email' => 'required|email|max:200',
            'phone' => 'required|digits:11'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $students = student::create([
                'name' => $request->name,
                'age' => $request->age,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            if($students){
                return response()->json([
                    'status' => 200,
                    'message' => 'Student Added Successfully!'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something Went Wrong!'
                ], 500); // Correct the status code here as well
            }
        }
    }

    public function show($id) {
        $student = student::find($id);
        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Such Student Record Found!'
            ], 404);
        }
    }

    public function update(Request $request, int $id) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'age' => 'required|integer|max:200',
            'course' => 'required|string|max:150',
            'email' => 'required|email|max:200',
            'phone' => 'required|digits:11'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        }  else {

            $student = student::find($id);

            if ($student) {
                $student->update([
                    'name' => $request->name,
                    'age' => $request->age,
                    'course' => $request->course,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Student Updated Successfully!'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No Such Student Record Found!!'
                ], 404);
            }
        }
    }

    public function destroy($id) {
        $student = student::find($id);

        if ($student) {
            $student->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Student Record Deleted Successfully!'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Such Student Record Found'
            ], 404);
        }
    }
}
