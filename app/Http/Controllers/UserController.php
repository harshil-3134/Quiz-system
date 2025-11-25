<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;
use App\Models\mcq_record;
use App\Models\Record;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function welcome(){
        // $categories=category::get();
         $categories=category::withCount('quizzes')->get();
        return view('welcome',['categories'=>$categories]);
    }

    function userQuizList($id,$category){
       
           $quizData=Quiz::withCount('Mcq')->where('category_id',$id)->get();
            return view('userQuizList',["quizData"=>$quizData,"category"=>$category]);
    } 

    function userSignup(Request $request){
       $valdiate= $request->validate([
        "name" => "required|min:3",
        "email" => "required|email|unique:users",
        "password" => "required|min:3|confirmed",
       ]);

       $user = User::create([
        "name" =>$request->name,
        "email" =>$request->email,
        "password" =>Hash::make($request->password),
       ]);

       if($user){
        Session::put('user',$user);
        if(Session::has('quiz-url')){
            $url=Session::get('quiz-url');
              Session::forget('quiz-url');
               return redirect($url)->with('message',"user Login succesfully");
        }
         return redirect('/')->with('message',"user registered succesfully");
       }
       
    }

   function startQuiz($id,$name){
     $quizCount= Mcq::where('quiz_id',$id)->count();
     $mcqs=Mcq::where('quiz_id',$id)->get();
     Session::put('firstmcq',$mcqs[0]);
     $quizName=$name;
     return view('start-quiz',['quizName'=>$name,'quizCount'=>$quizCount]);
    }

    function userLogout(){
        Session::forget('user');
        return redirect('/');
    }

    function userSignupQuiz(){
        Session::put('quiz-url',url()->previous());
        return view('user-signup');
    }

    function userLogin(Request $request){
       $valdiate= $request->validate([
        "email" => "required|email",
        "password" => "required",
       ]);
       
       $user = User::where('email',$request->email)->first();
       if(!$user||!Hash::check($request->password,$user->password)){
          return "User not valid, Please check the email and password";
       }

     
       if($user){
        Session::put('user',$user);
        if(Session::has('quiz-url')){
            $url=Session::get('quiz-url');
              Session::forget('quiz-url');
               return redirect($url);
        }
         return redirect('/');
       }
       
    }
    
    function userLoginQuiz(){
        Session::put('quiz-url',url()->previous());
        return view('user-login');
    }
 

    function mcq($id,$name){
    $record= new Record();
    $record->user_id=Session::get('user')->id;
    $record->quiz_id=Session::get('firstmcq')->quiz_id; 
    $record->status=1;

    if($record->save()){
     $currentQuiz=[];
     $currentQuiz['totalMcq']= Mcq::where('quiz_id',Session::get('firstmcq')->quiz_id)->count();
     $currentQuiz['currentMcq']=1;
     $currentQuiz['quizName']=$name;
     $currentQuiz['quizId']=Session::get('firstmcq')->quiz_id;
     $currentQuiz['recordId']=$record->id;


     Session::put('currentQuiz',$currentQuiz);
     $mcqData=Mcq::find($id);
     return view('mcq-page',['quizName'=>$name,'mcqData'=>$mcqData]);
     }else{
      return "something went wrong";
     }

    }

    function submitAndNext(Request $request,$id){
      $currentQuiz=Session::get('currentQuiz');
      
      $mcqData=Mcq::where([
        ['id','>',$id],
        ['quiz_id','=',$currentQuiz['quizId']]
      ])->first();

    $isExist=mcq_record::where([
      ['record_id','=',$currentQuiz['recordId']],
      ['mcq_id','=',$request->id],
    ])->count();
    
    if($isExist<1){
        
     $mcq_record= new mcq_record;
     $mcq_record->record_id=$currentQuiz['recordId'];
     $mcq_record->user_id= Session::get('user')->id;
     $mcq_record->mcq_id=$request->id;
     $mcq_record->select_answer=$request->option;
     if($request->option == Mcq::find($request->id)->correct_ans){      
      $mcq_record->is_correct=1;
     }
    else{
       $mcq_record->is_correct=0;
    }
    if(!$mcq_record->save()){
      return "something went wrong";
    }
    else{
      $currentQuiz['currentMcq']+=1;
    }
    }


      Session::put('currentQuiz',$currentQuiz);
      if($mcqData){
      return view('mcq-page',['quizName'=>$currentQuiz['quizName'],'mcqData'=>$mcqData]);
      }
      else{
        $resultData=mcq_record::WithMcq()->where('record_id',$currentQuiz['recordId'])->get();
        $correctAnswers=mcq_record::where([
          ['record_id','=',$currentQuiz['recordId']],
          ['is_correct','=',1],

          
          ])->count();
          $record= Record::find($currentQuiz['recordId']);
          if($record){
            $record->status=2;
            $record->update();
          }   

        return view('quiz-result',['resultData'=>$resultData],['correctAnswers'=>$correctAnswers]);
      }
    }

    function userDetails(){
    $quizRecord=Record ::WithQuiz()->where('user_id',Session::get('user')->id)->get();
      return view('user-details',['quizRecord'=>$quizRecord]);
    }
}
