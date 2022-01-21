@extends('layouts.main')

@section('content')
    <div class="w-full h-full bg-gray-200">
        <div class="h-full md:w-96 px-5 py-10 bg-gray-200 mx-auto
        ">
            <h1 class="text-3xl text-center mt-10 uppercase text-gray-700 font-bold"><span class="text-white px-4 py-2 bg-gray-700">FU</span> Registration</h1>
            <form class="mt-20 space-y-4" action="/register" method="post" autocomplete="off">
                @csrf
                <div class="flex items-center">
                    <div>
                        <label for="username" class="sr-only">Username</label>
                        <input id="username" name="username" type="text" required
                            class="md:text-md rounded-l-md shadow-md relative block w-full px-3 py-2  border-l border-t border-r-2 border-gray-200 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-gray-500 focus:border-2 focus:border-gray-500 focus:z-10 text-sm
                            @error('username') border-2 border-red-500 @enderror"
                            placeholder="Username" value="{{ old('username') }}">
                        
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" required
                            class="rounded-r-md shadow-md relative block w-full px-3 py-2 border-l-2 border-t border-gray-200 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-gray-500 focus:border-2 focus:border-gray-500 focus:z-10 md:text-md text-sm
                            @error('password') border-2 border-red-500 @enderror"
                            placeholder="Password">
                    </div>
                </div>
                @if($errors->any())
                <div class="flex items-center">
                  @error('username')
                  <p class="-mt-2 text-xs text-red-500 font-medium">{{ $message }}</p>
                  @enderror
                  @error('password')
                  <p class="-mt-2 text-xs text-red-500 font-medium">{{ $message }}</p>
                  @enderror
                </div>
                @endif
                <div>
                  <div>
                        <label for="name" class="sr-only">Name</label>
                        <input id="name" name="name" type="text" required
                            class="md:text-md rounded-md shadow-md relative block w-full px-3 py-2 border-l border-t border-gray-200 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-gray-500 focus:border-2 focus:border-gray-500 focus:z-10 text-sm
                            @error('name') border-2 border-red-500 @enderror"
                            placeholder="Name" value="{{ old('name') }}">
                        @error('name')
                        <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex inline-block items-center">
                  <div class="w-full">
                    <select id="jurusan" name="jurusan" class="rounded-l-md md:text-md block w-full py-2 px-3  bg-white border-l border-r-2 border-t border-gray-200 shadow-md focus:outline-none focus:ring-gray-500 focus:border-2 focus:border-gray-500 text-sm">
                      <option>RPL-SMK</option>
                      <option>AKL-SMK</option>
                      <option>IPA-SMA</option>
                      <option>IPS-SMA</option>
                    </select>
                  </div>
                  <div class="w-full">
                    <select id="classNum" name="classNum" class=" rounded-r-md md:text-md block w-full py-2 px-3  bg-white border-l-2 border-t border-gray-200 shadow-md focus:outline-none focus:ring-gray-500 focus:border-2 focus:border-gray-500 text-sm">
                      <option>X</option>
                      <option>XI</option>
                      <option>XII</option>
                    </select>
                  </div>
                </div>

                <div class="flex justify-center">
                    <button type="submit"
                        class="
                    mt-10 group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-700 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Register
                    </button>
                </div>
                <div class="text-sm text-center">
                    <a href="/login" class="font-medium text-gray-400 hover:text-gray-800 inline-block mt-2">
                    Already have an Account ? Login
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection