<?php

namespace App\Http\Controllers;
use App\Models\category;
use App\Models\Quiz;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function welcome(){
        // $categories=category::get();
         $categories=category::withCount('quizzes')->get();
        return view('welcome',['categories'=>$categories]);
    }

    function userQuizList($id,$category){
       
           $quizData=Quiz::where('category_id',$id)->get();
            return view('userQuizList',["quizData"=>$quizData,"category"=>$category]);
    } 

    function userSignup(Request $request){
       $valdiate= $request->validate([
        "name" => "required|min:3",
        "email" => "required|email",
        "password" => "required|min:3|confirmed",
       ]);
    }
}
