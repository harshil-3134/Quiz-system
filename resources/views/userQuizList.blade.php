<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Category : {{str_replace('-',' ',$category) }}  </title>
        @vite('resources/css/app.css')
</head>
<body >
    <x-user-navbar ></x-user-navbar>

    <div class=" bg-gray-100 flex flex-col items-center min-h-screen pt-5">  

    <h2 class=" text-2xl text-center text-gray-800 mb-6">Category Name : {{str_replace('-',' ',$category) }}    
    </h2>  
  <div class=" w-200">

    <ul class=" border border-gray-200">
        <li class=" p-2 font-bold">
                
                <ul class=" flex justify-between">
                    <li class=" w-30">quiz id</li>
                    <li class=" w-110">quiz name</li>
                     <li class=" w-30">Mcq count</li>
                      <li class=" w-30">action</li>
                </ul>

            </li>    
        @foreach ($quizData as $item)
            <li class="even:bg-gray-200 p-2">
                
                <ul class=" flex justify-between">
                    <li class=" w-30">{{$item->id}}</li>
                    <li class=" w-110">{{$item->name}}</li>
                    <li class=" w-30">{{$item->mcq_count}}</li>
                      <li class=" w-30 flex">
                        <a href="/start-quiz/{{$item->id}}/{{str_replace(' ','-',$item->name) }}" class=" text-green-500 font-bold">
                        Attemt Quiz    
                        </a>  
                    </li>
                </ul>

            </li>         
        @endforeach
        
    </ul>
  </div>
   </div>
</body>
</html>