@extends('layouts.main')

@section('content')

@if(Request::has('search'))
<!-- Judul ketika di search an -->
<div class="">
  <a href="/home" class="pr-2 text-gray-400 bg-gray-200 text-xs hover:text-gray-700 flex items-center inline-block w-max"> <i data-feather="arrow-left" class="inline p-[6px] bg-gray-700 mr-2"></i> Back To Home</a>
  <h1 class="font-bold text-gray-700 text-xl mt-1">Search a book</h1>
</div>
@endif

@if(Request::is('home*') && !Request::has('search'))
<!-- Judul -->

<div class="flex space-x-2 items-center mt-2">
  <div class="w-12 h-12 bg-gray-700">
    <i data-feather="user" class="p-3 w-full h-full text-white"></i>
  </div>
  <div class="uppercase">
    <h1 class="text-gray-700 text-sm font-semibold">{{ auth()->user()->name }}</h1>
    <p class="text-xs text-gray-500 font-medium">{{ auth()->user()->jurusan->name }}</p>
  </div>
</div>

@endif

<!-- Welcome message -->
@if(Request::path('home') && !Request::has('search'))
<div class="mt-4 md:mt-0 py-2 pl-4 pr-2 bg-gray-700 flex justify-between">
  <div>
    <h1 class="text-md font-semibold text-white" id="box-greeting">Welcome {{ explode(" ", auth()->user()->name)[0] }}!</h1>
    <p class="text-sm text-white/70">
      Discover all books
    </p>
  </div>
  <div class="bg-white flex items-center focus:bg-gray-100">
    <h1 class="text-xl font-bold text-gray-700 px-5" id="btn-box">&darr;</h1>
  </div>
</div>

<div class="relative overflow-hidden border-t border-white">
  <div class="p-4 bg-gray-700 -translate-y-full hidden" id="content-box">
    <p class="text-sm text-white/80">
      Discover a lot of books here! find your interest, order a book, and organize a library without a paper lmao. Just send me your feedback right now
    </p>
    <p class="mt-4 text-white/80 inline-block font-semibold text-xs bg-white/40 pr-2">
      <i data-feather="mail" class="p-[5px] inline mr-1 text-gray-700 bg-white"></i> adics631@gmail.com
    </p>
  </div>

</div>
@endif

<!-- Search Query Message -->
@if(Request::has('search'))
<div class="mt-8 md:mt-0 py-2 pl-4 pr-2 bg-gray-700 rounded-md flex justify-between">
  <div>
    <p class="text-md text-white font-semibold">
      Did not found what you want?<br>
      <span class="text-sm text-white/60 font-medium">Better luck next time</span>
    </p>

  </div>
</div>

@endif
<!-- Search Button -->
<form action="/home" class="mb-4">
  <input value="{{ request('search') }}" autocomplete="off" type="text" id="search" name="search" placeholder="Search" class="rounded-md relative inline-block w-full px-3 py-2 mt-2 border border-gray-200 focus:border-2 shadow-md placeholder-gray-500 text-gray-900 outline-none focus:ring-gray-700 focus:border-gray-700 focus:z-10 text-sm">
  <button type="submit" class="hidden" id="btnSubmit"></button>
</form>

@if(!Request::has('search'))
<!-- Category Button -->
<div class="overflow-x-auto no-scrollbar flex mt-4 space-x-2">
  <a href="/home" class="text-sm rounded-full px-4 py-2 {{ Request::path() == 'home' || Request::is('/') ? 'bg-gray-700 text-white' : 'border border-gray-700 text-gray-700' }}">Recomended</a>
  @foreach( $categories as $c )
  <a href="/home/c/{{ $c->slug }}" class="text-sm rounded-full px-4 py-2 {{ Request::is('home/c/' . $c->slug) ? 'bg-gray-700 text-white' : 'border border-gray-700 text-gray-700 hover:bg-gray-700 hover:text-white' }}">{{ $c->name }}</a>
  @endforeach
</div>
@endif

<!-- Category items is empty -->
@if(Request::is('home/c*'))
@if($books->isEmpty())
<h1 class="text-sm mt-4 p-2 bg-gray-300 text-gray-500 text-center font-semibold">Books Not Found!</h1>
@endif
@endif

<!-- Search items is empty -->
@if(Request::has('search'))
@if($books->isEmpty())
<h1 class="text-sm mt-4 p-2 bg-gray-300 text-gray-500 text-center font-semibold">Books Not Found!</h1>
@endif
  
@endif

<!-- Book -->
@foreach( $books as $book )
<div class="mt-2 grid grid-cols-12 gap-px bg-white p-2 rounded-md border-l border-t border-gray-200 shadow-md hover:bg-gray-300">
  <a href="/home/{{ $book->slug }}" class="col-span-4 md:col-span-2 overflow-hidden rounded-md h-max shadow-sm">
    <img src="{{ asset($book->image) }}" alt="">
  </a>
  <a href="/home/{{ $book->slug }}" class="col-span-8 md:col-span-10 p-2 flex flex-col justify-between">
    <div>
      <h1 class="text-lg text-gray-700 font-bold">{{ $book->tittle }}</h1>
      <p class="text-sm text-gray-500">
        {{ $book->year }}
      </p>
      <p class="text-xs mt-2 text-gray-400 line-clamp-3 break-all">
        {{ $book->desc }}
      </p>
    </div>
    <div>
      <p class="mt-2 py-2 px-4 inline-block bg-gray-700 text-white rounded-md text-xs font-bold">
        {{ $book->author }}
      </p>

    </div>
  </a>
</div>
@endforeach

<!-- LatestBook -->
@if(Request::is('home') && !Request::has('search'))
<div class="p-4 bg-gray-700 mt-4 rounded-md">
  <h1 class="font-bold text-lg text-white">News Book</h1>
  <div class="flex space-x-2">
    <div class="w-8 h-[4px] bg-white mt-2 active btn-slide cursor-pointer" onclick="sliding(0)"></div>
    <div class="w-4 h-[4px] bg-white/50 mt-2 btn-slide cursor-pointer" onclick="sliding(1)"></div>
    <div class="w-4 h-[4px] bg-white/50 mt-2 btn-slide cursor-pointer" onclick="sliding(2)"></div>
  </div>

  <div class="relative mt-4 overflow-hidden">
    @for ($i = 0; $i < 3; $i++)
      <div class=" w-full grid grid-cols-12 gap-4 {{ $i == 0 ? 'active relative top-0 right-0' : 'absolute top-0 -right-[calc(100%+1rem)]' }} slide-items bg-gray-600 p-2 md:p-4 rounded-md">
      <div class="col-span-4 h-40 md:col-span-3 md:h-60 bg-white bg-cover bg-center border-2 border-white"
        style="background-image: url('{{ asset($newBooks[$i]->image )}}')"></div>
      <div class="col-span-8 md:col-span-9 max-h-40">
        <h1 class="text-white text-lg font-bold">{{ $newBooks[$i]->tittle }}</h1>
        <p class="text-white/50">
          {{ $newBooks[$i]->year }}
        </p>
        <p class="text-sm text-white/80 break-all line-clamp-3">
          {{ $newBooks[$i]->desc }}
        </p>

        <h1 class="py-2 px-4 bg-white/30 text-white font-semibold text-sm mt-2 inline-block">{{ $newBooks[$i]->author }}</h1>
      </div>
    </div>
    @endfor
<!--
    <div class="w-full grid grid-cols-12 gap-4 absolute top-0 -right-[calc(100%+1rem)] slide-items bg-gray-600 p-2 md:p-4 rounded-md">
      <div class="col-span-4 h-40 md:col-span-3 md:h-60 bg-white bg-cover bg-center border-2 border-white"
        style="background-image: url('{{ asset($newBooks[1]->image )}}')"></div>
      <div class="col-span-8 md:col-span-9">
        <h1 class="text-white text-lg font-bold">{{ $newBooks[1]->tittle }}</h1>
        <p class="text-white/50">
          {{ $newBooks[1]->year }}
        </p>
        <p class="text-sm text-white/80 break-all line-clamp-3">
          {{ $newBooks[1]->desc }}
        </p>
        <h1 class="py-2 px-4 inline-block bg-white/30 text-white font-semibold text-sm mt-2">{{ $newBooks[1]->author }}</h1>
      </div>
    </div>

    <div class=" w-full grid grid-cols-12 gap-4 absolute top-0 -right-[calc(100%+1rem)] slide-items bg-gray-600 p-2 md:p-4 rounded-md">
      <div class="col-span-4 h-40 md:col-span-3 md:h-60 bg-white bg-cover bg-center border-2 border-white"
        style="background-image: url('{{ asset($newBooks[2]->image )}}')"></div>
      <div class="col-span-8 md:col-span-9">
        <h1 class="text-white text-lg font-bold">{{ $newBooks[2]->tittle }}</h1>
        <p class="text-white/50">
          {{ $newBooks[2]->year }}
        </p>
        <p class="text-sm text-white/80 break-all line-clamp-3">
          {{ $newBooks[2]->desc }}
        </p>
        <h1 class="py-2 px-4 inline-block bg-white/30 text-white font-semibold text-sm mt-2">{{ $newBooks[2]->author }}</h1>
      </div>
    </div>

  </div>
-->
</div>
@endif
<script>
 
 /**
  // box greet
  let boxGreet = document.querySelector('#box-greeting');
  let curr = new Date();
  let hour = curr.getHours();

  if (hour < 12) {
    // pagi
    boxGreet.innerHTML = "Have a nice day, {{ explode(' ', auth()->user()->name)[0] }}";
  } else if (hour >= 12 && hour <= 14) {
    // siang
    boxGreet.innerHTML = "Lunch time, {{ explode(' ', auth()->user()->name)[0] }}"
  } else if (hour > 14 && hour <= 18) {
    // sore
    boxGreet.innerHTML = "Get bored, right? {{ explode(' ', auth()->user()->name)[0] }}"
  } else {
    // malam
    boxGreet.innerHTML = "Nightmare is here, {{ explode(' ', auth()->user()->name)[0] }}"
  }
  **/
  // Search bar
  const searchBar = document.querySelector('#search');
  const searchBtn = document.querySelector('#btnSubmit');

  // pencet submit dengan gaya
  searchBar.addEventListener('keyup', function(e) {
    e.preventDefault();
    if (e.keycode === 13) {
      searchBtn.click();
    }
  })

  // slider
  const slideItems = document.querySelectorAll('.slide-items');
  const btnSlide = document.querySelectorAll('.btn-slide');
  let currItems = 0;

  for (let i = 0; i < slideItems.length; i++) {
    if (slideItems[i].classList.contains('active')) {
      currItems = slideItems[i];
    }
  }

  let i = 0;
  setInterval(function() {
    if (i < slideItems.length) {
      sliding(i);
    }
    i++;
    if (i == slideItems.length) {
      i = 0;
    }
  }, 2000);

  function sliding(ind) {
    // reset all
    for (let i = 0; i < btnSlide.length; i++) {
      btnSlide[i].classList.remove('active');
      btnSlide[i].classList.remove('bg-white');
      btnSlide[i].classList.remove('w-8');
      btnSlide[i].classList.add('bg-white/50');
      btnSlide[i].classList.add('w-4');
    }
    if (!btnSlide[ind].classList.contains('active')) {
      btnSlide[ind].classList.add('active');
      btnSlide[ind].classList.remove('bg-white/50');
      btnSlide[ind].classList.remove('w-4');
      btnSlide[ind].classList.add('bg-white');
      btnSlide[ind].classList.add('w-8');
    }

    // reset all
    for (let i = 0; i < slideItems.length; i++) {
      slideItems[i].classList.remove('active');
      slideItems[i].classList.remove('relative');
      slideItems[i].classList.remove('right-0');

      slideItems[i].classList.add('absolute');
      slideItems[i].classList.add('-right-[calc(100%+1rem)]');
    }

    // jika kita nge klik tombol ke 0
    if (!slideItems[ind].classList.contains('active')) {

      slideItems[ind].classList.add('active');
      slideItems[ind].classList.add('relative');
      slideItems[ind].classList.add('right-0');

      slideItems[ind].classList.remove('absolute');
      slideItems[ind].classList.remove('-right-[calc(100%+1rem)]');
    }

  }

  // box
  const btnBox = document.querySelector('#btn-box');
  const contentBox = document.querySelector('#content-box');
  
  btnBox.addEventListener('click', function() {
    if(!btnBox.classList.contains('active')) {
      
      btnBox.classList.add('active');
      btnBox.innerHTML = "&uarr;"
      contentBox.classList.remove('hidden');
      setTimeout(function() {
        contentBox.classList.remove('-translate-y-full');
      }, 20);
      
    } else {
      
      btnBox.classList.remove('active');
      btnBox.innerHTML = "&darr;"
      contentBox.classList.add('-translate-y-full');
      setTimeout(function() {
        contentBox.classList.add('hidden');
      }, 200);
      
    }
  });
  
</script>
@endsection