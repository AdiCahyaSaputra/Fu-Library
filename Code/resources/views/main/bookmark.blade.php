@extends('layouts.main')

@section('content')
<div class="flex space-x-2 items-center mt-2">
  <div class="w-12 h-12 bg-gray-700">
    <i data-feather="bookmark" class="p-3 w-full h-full text-white"></i>
  </div>
  <div class="uppercase">
    <h1 class="text-gray-700 text-sm font-semibold">Bookmark</h1>
    <p class="text-xs text-gray-500 font-medium">
      Detail
    </p>
  </div>
</div>

<div class="mt-4">
  @foreach($bookmarks as $bookmark)
  <a href="/home/{{ $bookmark->book->slug }}" class="bg-gray-700 hover:bg-gray-400 p-2 rounded-md mt-2 flex items-start space-x-2">
    <div class="overflow-hidden flex justify-center items-center bg-white rounded-md w-24">
      <img src="{{ asset($bookmark->book->image) }}" alt="">
    </div>
    <div class="">
      <div class="text-white">
        <h4 class="text-lg font-semibold">{{ $bookmark->book->tittle }}</h4>
        <p class="text-sm text-white/70">
          {{ $bookmark->book->year }}
        </p>
        <p class="text-sm text-white/70">
          Author : {{ $bookmark->book->author }}
        </p>
        <p class="text-sm text-white/70">
          Pages : {{ $bookmark->book->pages }}
        </p>
        <p class="text-sm text-white/70">
          Price : <span class="text-white/90">Rp.{{ $bookmark->book->price }}</span>
        </p>
        
      </div>
      <div class="mt-2 flex items-center bg-gray-400 pr-2 rounded-sm">
        <i data-feather="bookmark" class="text-gray-700 bg-white rounded-sm p-[5px]"></i>
        <p class="text-xs ml-2 text-white">
          Delete from Bookmark
        </p>
      </div>
    </div>
  </a>
  @endforeach

</div>
@endsection