<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MCQ page</title>
        @vite('resources/css/app.css')
</head>
<body >
    <x-user-navbar ></x-user-navbar>
    @if (session('message'))
    <p class="text-green-500">{{'message'}}</p> 
    @endif

    <div class=" bg-gray-100 flex flex-col items-center min-h-screen pt-5">  

    <h1 class=" text-2xl text-center text-gray-800 font-bold mb-6">
       {{ $quizName }}
    </h1> 
     <h1 class=" text-2xl text-center text-gray-800 font-bold mb-6">
       Total No. of questions : {{ session('currentQuiz')['totalMcq'] }}
    </h1> 
      <h1 class=" text-2xl text-center text-gray-800 font-bold mb-6">
       {{ session('currentQuiz')['currentMcq'] }} of {{ session('currentQuiz')['totalMcq'] }}
    </h1> 
    <div class="mt-2 p-4 bg-white shadow-2xl rounded-xl w-140">
      <h3 class=" text-green-900 font-bold text-xl mb-1">{{ $mcqData->question }}</h3>
      <form action="/submit-next/{{ $mcqData->id }}" class=" space-y-4" method="get">
          
        @csrf
        <input type="hidden" name="id" value="{{ $mcqData->id }}">
       <label for="option_1" class="flex border p-3  rounded-2xl shadow-2xl cursor-pointer hover:bg-blue-50">
          <input id="option_1" type="radio" class=" font-radio text-blue-500" value="a" name="option">
          <span class=" text-green-900 pl-2">{{ $mcqData->a }}</span>
       </label>

       <label for="option_2" class="flex border p-3 rounded-2xl shadow-2xl cursor-pointer hover:bg-blue-50">
          <input id="option_2" type="radio" class=" font-radio text-blue-500" value="b" name="option">
          <span class=" text-green-900 pl-2">{{ $mcqData->b }}</span>
       </label>

       <label for="option_3" class="flex border p-3  rounded-2xl shadow-2xl cursor-pointer hover:bg-blue-50">
          <input id="option_3" type="radio" class=" font-radio text-blue-500" value="c" name="option">
          <span class=" text-green-900 pl-2">{{ $mcqData->c }}</span>
       </label>

       <label for="option_4" class="flex border p-3  rounded-2xl shadow-2xl cursor-pointer hover:bg-blue-50">
          <input id="option_4" type="radio" class=" font-radio text-blue-500" value="d" name="option">
          
          <span class=" text-green-900 pl-2">{{ $mcqData->d }}</span>
       </label>

       <button type="submit" class=" w-full bg-blue-500 rounded-xl px-4 py-2 text-white ">Submit Answer and Next</button>
      </form>
    </div>

</div>
    <x-footer-user></x-footer-user>
</body>
</html>