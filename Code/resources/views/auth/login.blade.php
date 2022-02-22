@extends('layouts.main')

@section('content')
    <div class="w-full h-full bg-gray-200">
        <div class="h-full md:w-96 px-5 py-10 bg-gray-200 mx-auto">
            @if (session('gagal'))
            <div class="px-8 py-4 bg-gray-700 rounded-md">
                <h4 class="text-center text-sm font-bold text-white">{{ session('gagal') }}</h4>
            </div>
            @endif
            @if (session('status'))
            <div class="px-8 py-4 bg-gray-700 rounded-md">
                <h4 class="text-center text-sm font-bold text-white">{{ session('status') }}</h4>
            </div>
                
            @endif
            <h1 class="lg:text-4xl text-3xl text-center mt-10 uppercase text-gray-700 font-bold"><span class="text-white px-4 py-2 bg-gray-700">FU</span> Login</h1>
            <form class="mt-20 space-y-6" action="/login" method="post" autocomplete="off">
                  @csrf
                  <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="username" class="sr-only">Username</label>
                        <input id="username" name="username" type="text" required
                            class="md:text-md rounded-md shadow-md relative block w-full px-3 py-2 placeholder-gray-500 text-gray-900 focus:rounded-none outline-none focus:border-l-4 focus:border-t-0 focus:border-gray-700 focus:z-10 text-sm"
                            placeholder="Username">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" required
                            class="mt-2 rounded-md shadow-md relative block w-full px-3 py-2 placeholder-gray-500 text-gray-900 focus:rounded-none outline-none focus:border-l-4 focus:border-t-0 focus:border-gray-700 focus:z-10 md:text-md text-sm"
                            placeholder="Password">
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="p-2 rounded-md appearance-none border checked:bg-gray-600 border-gray-400">
                        <label for="remember-me" class="uppercase ml-2 block md:text-sm text-gray-600 text-xs">
                            Remember me
                        </label>
                    </div>

                    <div class="text-xs ml-4 uppercase">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-800">
                            Forgot password?
                        </a>
                    </div>

                </div>

                <div class="flex justify-center">
                    <button type="submit"
                        class="
                    mt-10 rounded-md relative w-full text-center py-2 px-4 border border-transparent text-sm font-medium text-white bg-gray-700 hover:bg-gray-800 outline-none active:ring active:ring-gray-500">
                        Login
                    </button>
                </div>
                <div class="text-sm text-center">
                    <a href="/register" class="font-medium text-gray-400 hover:text-gray-800 inline-block mt-2">
                    Didn't have an account? Register Now!
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection