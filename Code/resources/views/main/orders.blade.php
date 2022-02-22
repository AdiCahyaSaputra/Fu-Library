@extends('layouts.main')

@section('content')

<div class="flex space-x-2 items-center mt-2">
  <div class="w-12 h-12 bg-gray-700">
    <i data-feather="shopping-bag" class="p-3 w-full h-full text-white"></i>
  </div>
  <div class="uppercase">
    <h1 class="text-gray-700 text-sm font-semibold">Order History</h1>
    <p class="text-xs text-gray-500 font-medium">
      Detail
    </p>
  </div>
</div>

<div class=" rounded-md my-2 text-sm text-white font-semibold ">
  <!-- Category Button -->
  <div class="overflow-x-auto no-scrollbar flex mt-4 space-x-2">
    <a href="/orders/all" class="text-sm px-4 py-2 {{ Request::path() == 'orders/all' ? 'bg-gray-700 text-white' : 'border border-gray-700 text-gray-700' }}">All</a>
    @foreach( $month as $m )
    <a href="/orders/{{ strtolower($m) }}" class="text-sm px-4 py-2 {{ Request::path() == 'orders/' . strtolower($m) ? 'bg-gray-700 text-white' : 'border border-gray-700 text-gray-700 hover:bg-gray-700 hover:text-white' }}">{{ $m }}</a>
    @endforeach
  </div>
</div>

@if(count($orders) == 0)
<h1 class="text-sm mt-4 p-2 bg-gray-300 text-gray-500 text-center font-semibold">Did'nt order any book for this Month!</h1>
@endif

@foreach($orders as $order)
@if($order->user->id == auth()->user()->id)
<div class="my-2  flex justify-between items-center p-4 bg-gray-700 text-white font-semibold text-lg">
  <div>
    <h1>{{ $order->book->tittle }}</h1>
    <p class="text-sm text-white/60">Total : ${{ $order->totalPrice }}</p>
  </div>
  <div class="text-sm text-right text-white/80">
    <p>{{ $order->totalItems }} Items</p>
    <p class="text-white">{{ $order->paymentMethod }}</p>
  </div>
</div>
@endif
@endforeach
@endsection