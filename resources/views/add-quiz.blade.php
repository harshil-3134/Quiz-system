<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Categories page</title>
        @vite('resources/css/app.css')
</head>
<body >
    <x-navbar name="{{ $name }}" ></x-navbar>
     <div class=" bg-gray-100 flex flex-col items-center min-h-screen pt-5">  

     <div class=" bg-white p-8 rounded-2xl shadow-lg w-full max-w-md ">

    @if (!Session('quizDetails'))
        
  

    <h2 class=" text-2xl text-center text-gray-800 mb-6">Add new Quiz</h2> 

    <form action="/add-quiz" method="get" class=" space-y-4">
        
        <div>
        <input type="text" placeholder="Enter Quiz name" name="quiz"
        class=" w-full px-4 border border-gray-300 rounded-xl py-2 focus:outline-none"
        >
        </div>

        <div>
        <select type="text" name="category_id"
        class=" w-full px-4 border border-gray-300 rounded-xl py-2 focus:outline-none"
        >

        @foreach ( $categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>   
        @endforeach
 
        </select>
        </div>

    <button type="submit" class=" w-full bg-blue-500 rounded-xl px-4 py-2 text-white ">Add</button>

    </form>

    @else

    <span class=" text-green-500 font-bold">Quiz : {{Session('quizDetails')->name}}</span>
    <h2 class=" text-2xl text-center text-gray-800 mb-6">Add new Quiz</h2> 
    <form action="" method="get" class=" space-y-4">

      <div>
        <textarea type="text" placeholder="Enter Your Question name" name="quiz"
        class=" w-full px-4 border border-gray-300 rounded-xl py-2 focus:outline-none"
        ></textarea>
      </div>

       <div>
        <input type="text" placeholder="Enter first option" name="quiz"
        class=" w-full px-4 border border-gray-300 rounded-xl py-2 focus:outline-none"
        ></div>
        
        <div>
        <input type="text" placeholder="Enter second option" name="quiz"
        class=" w-full px-4 border border-gray-300 rounded-xl py-2 focus:outline-none"
        ></div>

        <div>
        <input type="text" placeholder="Enter third option" name="quiz"
        class=" w-full px-4 border border-gray-300 rounded-xl py-2 focus:outline-none"
        ></div>

        <div>
        <input type="text" placeholder="Enter fourth option" name="quiz"
        class=" w-full px-4 border border-gray-300 rounded-xl py-2 focus:outline-none"
        ></div>

        <div>
        <select name="right answer"
        class=" w-full px-4 border border-gray-300 rounded-xl py-2 focus:outline-none"
        >
        <option>Select Right Answer</option>
        <option>A</option>
        <option>B</option>
        <option>C</option>
        <option>D</option>
        </select>
        </div>

            <button type="submit" class=" w-full bg-blue-500 rounded-xl px-4 py-2 text-white ">Add More</button>
            <button type="submit" class=" w-full bg-green-500 rounded-xl px-4 py-2 text-white ">Add and Submit</button>
    </form>

      @endif
  </div> 
   </div>
</body>