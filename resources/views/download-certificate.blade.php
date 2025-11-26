<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate</title>
        @vite('resources/css/app.css')
</head>
<body class=" pt-10 text-center">
        <div class="w-200 border-4 m-10 bg-gray-100 border-indigo-900 p-10 text-center">
        <h1 class=" text-5xl flex">
           <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#000000"><path d="M250-40v-343L122-590l179-290h358l179 290-128 207v343l-230-77-230 77Zm60-84 170-55 170 55v-176H310v176Zm24-696L192-590l142 230h292l142-230-142-230H334Zm104 379L310-568l43-43 85 85 169-170 43 42-212 213ZM310-300h340-340Z"/></svg>
            <span>Certifiacte of Completeion</span>
        </h1>
        <p class=" text-2xl mt-5">This is clarify that</p>
        <h2 class=" text-4xl">{{$data['name']}}</h2>
        <p class=" text-2xl mt-3">Has succesfully completed the</p>
        <h3 class=" text-3xl"> {{$data['quiz']}}</h3>
        <p class=" text-2xl mt-5">{{date('y-m-d')}}</p>



    </div>
</body>
</html>