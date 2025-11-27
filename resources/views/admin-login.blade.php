<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin-login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
        
        <h2 class="text-2xl text-center text-gray-800 font-bold mb-6">
            Admin login
        </h2>

        @error('user')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <form action="/admin-login" method="POST" class="space-y-4">
            @csrf

            <!-- Admin Name -->
            <div>
                <label class="text-grey-600 mb-1">Admin name</label>
                <input 
                    type="text" 
                    name="name"
                    placeholder="Enter admin name"
                    class="w-full px-4 border border-gray-300 rounded-xl py-2 focus:outline-none"
                >
                @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Admin Password -->
            <div>
                <label>Admin password</label>
                <input 
                    type="password" 
                    name="password"
                    placeholder="Enter admin password"
                    class="w-full px-4 border border-gray-300 rounded-xl py-2 focus:outline-none"
                >
                @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Button -->
            <button 
                type="submit" 
                class="w-full bg-blue-500 rounded-xl px-4 py-2 text-white"
            >
                login
            </button>

        </form>

    </div>

</body>
</html>
