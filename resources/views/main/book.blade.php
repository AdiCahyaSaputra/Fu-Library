@extends('layouts.main')

@section('content')
<div class="-mt-2">
  <a href="/home" class="text-gray-400 text-xs hover:text-gray-700"> <span class="text-2xl">&larr;</span> Back To Home</a>
  <h1 class="font-bold text-gray-700 text-2xl">Rent a Book</h1>
</div>

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
      <p class="text-xs text-gray-700">
        {{ $book->author }}
      </p>
    </div>
    <div>
      @if(isset($book->pinjam[0]->returnDate) && $book->pinjam[0]->returnDate > date('Y-m-d'))
      <p class="text-xs text-gray-700 font-bold md:mt-10">
        *Return date {{ implode("/", array_reverse(explode("-",$book->pinjam[0]->returnDate))) }}
      </p>
      @endif
      @if($status == "Is Order")
      <p class="text-xs text-white bg-gray-700 p-2 mt-2 font-medium">
        Status: {{ $status }}
      </p>
      @else
      <p class="text-xs text-white bg-gray-700 p-2 mt-2 font-medium">
        Status: {{ $status }}
      </p>
      @endif
    </div>
  </div>
</div>

<div class="relative">
  <h1 class="text-lg text-gray-700 font-bold mt-4">How To Rent This Book ?</h1>
</div>
<ul class="text-sm ">
  <li>1. Max Rent is 1 Week</li>
  <li>2. Order a book first</li>
  <li>3. Confirm rent after you pick up this book</li>
</ul>
<form action="/rent" method="post" class="md:w-2/3">
  @csrf
  <div class="pt-4">
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    <input type="hidden" name="book_id" value="{{ $book->id }}">
    <input type="hidden" name="rentDate" id="rentDate" value="{{ date('Y-m-d') }}">
    @if($status == "Available")
    <label for="returnDate" class="text-xs font-bold text-gray-700">The book will be return in </label>
    <input type="date" id="returnDate" name="returnDate" value="{{ date('Y-md-d') }}"
    class="md:text-md rounded-md shadow-md relative block w-full px-3 py-2 border-l border-t border-gray-200 placeholder-gray-500 text-gray-900 focus:rounded-none focus:outline-none focus:border-l-4 focus:border-t-0 focus:border-gray-700 focus:z-10 text-sm">
    <button type="submit"
      class="
      mt-4 group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-700 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
      Order A Book !
    </button>
    @endif
  </div>
</form>
@if($status == "Is Rented")
<p class="mt-2 text-sm font-medium text-gray-500">
  *You can't rent this book if <span class="text-gray-700 font-bold">Status</span> is rented by other users. Wait until the return date
</p>
@endif
@if ($status == "Is Order" )
<form action="/order" method="post">
  @csrf
  <input type="hidden" name="order" id="order" value="{{ $book->id }}">
  <button type="submit"
    class="
    mt-4 group relative w-full flex justify-center py-2 px-4 border border-gray-700 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
    Confirm Rent
  </button>
</form>
@if(auth()->user()->id == $book->pinjam[0]->user->id )
<form action="/cancel" method="post">
  @csrf
  <input type="hidden" name="pinjamID" value="{{ $book->pinjam[0]->id }}">
  <button
    type="submit"
    class="
    mt-4 group relative w-full flex justify-center py-2 px-4 bg-red-700 text-sm font-medium rounded-md text-white hover:bg-red-800 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
    Cancel
  </button>
</form>
@endif
@endif
@endsection