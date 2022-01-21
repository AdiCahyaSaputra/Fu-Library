@extends('layouts.main')

@section('content')
<!-- Judul -->
<div class="py-2">
<h1 class="text-lg uppercase text-gray-700 font-bold"><span class="text-white px-4 py-2 bg-gray-700">FU</span> Home</h1>
</div>

<!-- Search Button -->
<form action="/home" class="my-4">
  <input value="{{ request('search') }}" autocomplete="off" type="text" id="search" name="search" placeholder="Search" class="md:w-2/3 rounded-md relative inline-block w-full px-3 py-2 mt-2 border border-gray-200 focus:border-2 shadow-md placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-gray-700 focus:border-gray-700 focus:z-10 text-sm">
  <button type="submit" class="hidden" id="btnSubmit"></button>
</form>

<!-- New Books -->
<div id="newBooksContent" class="">
  <div class="flex justify-between mt-4 items-center">
  <h1 class="font-bold text-lg text-gray-700">Popular Books</h1>
  <a href="/home/new-books" class="font-medium hover:text-gray-700 text-xs text-gray-400">See All</a>
  </div>
  
  <div class="grid grid-cols-12 mt-2 h-56 md:h-60 space-x-2 overflow-hidden">
    <div class="flex justify-center items-center col-span-6 md:col-span-3 h-56 md:h-full overflow-hidden rounded-lg inline-block bg-gray-200">
      <img src="{{ asset($newBooks[0]->image) }}" alt="">
    </div>
    <div class="flex justify-center items-center col-span-6 md:col-span-3 h-56 md:h-full overflow-hidden rounded-lg inline-block bg-gray-200">
      <img src="{{ asset($newBooks[1]->image) }}" alt="">
    </div>
    <div class="flex justify-center items-center col-span-6 md:col-span-3 h-56 md:h-full overflow-hidden rounded-lg inline-block bg-gray-200">
      <img src="{{ asset($newBooks[2]->image) }}" alt="">
    </div>
    <div class="flex justify-center items-center col-span-6 md:col-span-3 h-56 md:h-full overflow-hidden rounded-lg inline-block bg-gray-200">
      <img src="{{ asset($newBooks[3]->image) }}" alt="">
    </div>
  </div>
</div>

<!-- Category Button -->
<div class="overflow-x-auto no-scrollbar flex mt-4 space-x-2">
  <a href="/home" class="text-sm rounded-full px-4 py-2 {{ Request::path() == 'home' || Request::is('/') ? 'bg-gray-700 text-white' : 'border border-gray-700 text-gray-700' }}">All</a>
  @foreach( $categories as $c )
  <a href="/home/c/{{ $c->slug }}" class="text-sm rounded-full px-4 py-2 {{ Request::is('home/c/' . $c->slug) ? 'bg-gray-700 text-white' : 'border border-gray-700 text-gray-700 hover:bg-gray-700 hover:text-white' }}">{{ $c->name }}</a>
  @endforeach
</div>

<!-- Book -->
@foreach( $books as $book )
<div class="mt-4 grid grid-cols-12 gap-px bg-white p-2 rounded-md border-l border-t border-gray-200 shadow-md hover:bg-gray-300">
  <a href="/home/{{ $book->slug }}" class="col-span-4 md:col-span-2 overflow-hidden rounded-md h-max shadow-sm">
    <img src="{{ asset($book->image) }}" alt="">
  </a>
  <a href="/home/{{ $book->slug }}" class="col-span-8 md:col-span-10 p-2 flex flex-col justify-between">
    <div>
      <h1 class="text-lg text-gray-700 font-bold">{{ $book->tittle }}</h1>
      <p class="text-sm text-gray-500">{{ $book->year }}</p>
    </div>
    <p class="p-2 bg-gray-700 text-white inline-block rounded-br-lg text-xs font-bold">{{ $book->author }} / {{ $book->pages }}</p>
  </a>
</div>
@endforeach
<script>
  // Search bar
  const searchBar = document.querySelector('#search');
  const searchBtn = document.querySelector('#btnSubmit');
  const newBooksContent = document.querySelector('#newBooksContent');
  
  // ambil url saat ini
  let currentURL = window.location.href;
  
  // ketika di url saat ini ada search (ex.com?search=)
  if(currentURL.includes("search")) {
    // new book di apus
    newBooksContent.classList.add("hidden");
  }
  
  // pencet submit dengan gaya
  searchBar.addEventListener('keyup', function(e) {
    e.preventDefault();
    if( e.keycode === 13 ) { 
      searchBtn.click(); 
    }
  })
  
  // ini apaan dah wkwkwk saya juga lupa ini
  function singleBook(link) {
    return window.location.href = link;
  }
</script>
@endsection
