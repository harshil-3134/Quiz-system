<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz result page</title>
        @vite('resources/css/app.css')
</head>
<body >
<x-user-navbar></x-user-navbar>
<div class=" flex flex-col items-center min-h-screen bg-gray-100">
<h1 class=" text-4xl text-green-900 p-5 font-bold">Quiz Result</h1>
 <div class=" w-200">
    @if($correctAnswers*100/count($resultData)>70)
    <a href="/certificate" class=" text-green-500 text-center font-bold block">View and dowload certificate</a>
    @endif
    <h1 class=" text-2xl text-green-900  text-center my-5">
        {{ $correctAnswers }} out of {{ count($resultData) }} is correct.
    </h1>
    <ul class=" border border-gray-200">
        <li class=" p-2 font-bold">
                
                <ul class=" flex justify-between">
                    <li class=" w-30">S. No</li>
                    <li class=" w-70">Question</li>
                    <li class=" w-70">Result</li>
                </ul>

            </li>    
        @foreach ($resultData as $key=>$item)
            <li class="even:bg-gray-200 p-2">
                
                <ul class=" flex justify-between">
                    <li class=" w-30">{{$key + 1}}</li>
                    <li class=" w-70">{{$item->question}}</li>
                    @if($item->is_correct)
                    <li class=" w-70 text-green-500">Correct</li>
                    @else
                    <li class=" w-70 text-red-500">Incorrect</li>
                    @endif
                </ul>

            </li>         
        @endforeach
        
    </ul>
  </div>
</div>
<x-footer-user></x-footer-user>
</body>