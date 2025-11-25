 <nav class=" bg-white shadow-md px-4 py-3">
   <div class=" flex justify-between item-center">
         <div class=" text-2xl text-green-900 hover:text-blue-500 cursor-pointer">
            Quiz system
        </div>
        <div class=" space-x-4">
            <a class=" text-green-900 hover:text-blue-500" href="/">home</a>
            <a class=" text-green-900 hover:text-blue-500" href="/">Categories</a>
           @if (Session('user'))
                <a class=" text-green-900 hover:text-blue-500" href="/user-details">Welcome ,{{Session('user')->name}}</a>
                <a class=" text-green-900 hover:text-blue-500" href="/user-logout">Logout</a>
           @else
                <a class=" text-green-900 hover:text-blue-500" href="/user-login">login</a>
                <a class=" text-green-900 hover:text-blue-500" href="/user-signup">Signup</a>
           @endif
            <a class=" text-green-900 hover:text-blue-500" href="">blog</a>
        </div>
   </div>
    </nav> 