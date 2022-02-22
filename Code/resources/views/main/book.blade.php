@extends('layouts.main')

@section('content')
<!-- Judul -->
<div class="">
  <a href="/home" class="pr-2 text-gray-400 bg-gray-200 text-xs hover:text-gray-700 flex items-center inline-block w-max"> <i data-feather="arrow-left" class="inline p-[6px] bg-gray-700 mr-2"></i> Back To Home</a>
  <h1 class="font-bold text-gray-700 text-xl mt-1">Detail of book</h1>
</div>

<!-- Book Info -->
<div class="grid grid-cols-12 gap-2 pb-2 mt-2 border-b border-gray-200">
  <div class="col-span-4 md:col-span-2 h-max shadow-sm">
    <img src="{{ asset($book->image) }}" alt="">
  </div>
  <div class="col-span-7 md:col-span-5 flex flex-col justify-between">
    <div>
      <p class="text-xs text-gray-400 font-medium">
        {{ $book->category->name }}
      </p>
      <h1 class="text-lg text-gray-700 font-bold">{{ $book->tittle }} ({{ $book->year }})</h1>
      <p class="text-xs text-gray-700 flex items-center mt-2 bg-gray-200">
        <i data-feather="user" class="p-[5px] bg-gray-700 text-white mr-2 "></i> {{ $book->author }}
      </p>
    </div>
    <div class="flex items-center">
      <h3 class="font-semibold text-xs py-2 px-4 text-white bg-gray-700">${{ $book->price }}</h3>
    </div>
  </div>
</div>

<!--Desc  -->
<div class="mt-2">
  <div class="text-md text-gray-700 font-semibold py-2 px-4 bg-gray-200">
    Description
  </div>
  <div>
    <p class="text-sm text-gray-600 mt-2 ">
      {{ $book->desc }}
    </p>
  </div>
  <div class="flex items-center mt-4 text-xs font-semibold text-gray-700/70">
    <i data-feather="book-open" class="p-[5px] text-white bg-gray-700 mr-2"></i> This book contains {{ $book->pages }} Pages
  </div>
</div>

<div class="flex space-x-2 items-center mt-4">
  <a href="/checkout/{{ $book->slug }}" class="py-2 rounded-md bg-gray-700 text-white font-semibold inline-block w-full text-center"> Order a book</a>
  <form action="/bookmark" method="post">
    @csrf
    <input type="hidden" name="book_id" id="book_id" value="{{ $book->id }}" />
    <button
    type="submit"
    class="p-2 bg-gray-700 rounded-md {{ $status ? 'text-white/50' : 'text-white' }} hover:bg-gray-800 focus:ring-2 focus:ring-gray-500"
    name="{{ $status ? 'cancel' : 'add' }}"
    value="bookmark"> 
     <i data-feather="bookmark"></i>
    </button>
  </form>
</div>


@endsection