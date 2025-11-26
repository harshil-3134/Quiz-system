<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;



use App\Models\category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;
use App\Models\mcq_record;
use App\Models\Record;
use Illuminate\Http\Request;
use App\Mail\verifyUser;
use App\Mail\userForgotPassword;


class UserController extends Controller
{
    function welcome(){
        // $categories=category::get();
         $categories=category::withCount('quizzes')->orderBy('quizzes_count','desc')->take(5)->get();
           $quizData=Quiz::withCount('records')->orderBy('records_count','desc')->take(5)->get();

        return view('welcome',['categories'=>$categories,'quizData'=>$quizData]);
    }

    function categories(){
      $categories=category::withCount('quizzes')->orderBy('quizzes_count','desc')->paginate(3);
      return view('categories-list',['categories'=>$categories]);

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

       //
        $link=Crypt::encryptString($user->email);
        $link= url('/verify-user/'.$link);
       Mail::to($user->email)->send(new verifyUser($link));

       //

       if($user){
        Session::put('user',$user);
        if(Session::has('quiz-url')){
            $url=Session::get('quiz-url');
              Session::forget('quiz-url');
               return redirect($url)->with('message-success',"User Login succesfully,please check email to verify account");
        }else{
         return redirect('/')->with('message-success',"User registered succesfully,please check email to verify account");

         }
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
          return redirect('user-login')->with('message-error',"User not valid, Please check the email and password");
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

    function searchQuiz(Request $request){
     $quizData= Quiz::withCount('Mcq')->where('name','Like','%'.$request->search.'%')->get();
      return view('search-quiz',['quizData'=>$quizData,'quiz'=>$request->search]);
    }

    function verifyUser($email){
       echo $orgEmail= Crypt::decryptString($email);
       $user = User::where('email',$orgEmail)->first();
       if($user){
           $user->active=2;
       }
       if($user->save()){
         return redirect('/')->with('message-success',"User Verfied succesfully");

       }

    }
    function userForgotPassword(Request $request){
             //
        $link=Crypt::encryptString($request->email);
        $link= url('/user-forgot-password/'.$link);
       Mail::to($request->email)->send(new userForgotPassword($link));

       //
         return redirect('/')->with('message-success',"Email has been sent to your address");

    }

    function userResetForgotPassword($email){
          $orgEmail= Crypt::decryptString($email);
          return view('user-set-forgot-password',['email'=>$orgEmail]);
    }

    function userSetForgotPassword(Request $request){
        $valdiate= $request->validate([
        "email" => "required|email",
        "password" => "required|min:3|confirmed",
       ]);
         $user = User::where('email',$request->email)->first();
         if($user){
          $user->password=Hash::make($request->password);
          if($user->save()){
            return redirect('user-login')->with('message-success',"Password has been updated succesfully");;
          }
         }
    }
}

