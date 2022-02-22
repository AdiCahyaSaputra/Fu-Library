@extends('layouts.main')

@section('content')
<!-- Judul -->
<div class="">
  <a href="/home/{{ $book->slug }}" class="pr-2 text-gray-400 bg-gray-200 text-xs hover:text-gray-700 flex items-center inline-block w-max"> <i data-feather="arrow-left" class="inline p-[6px] bg-gray-700 mr-2"></i> Cancel</a>
  <h1 class="font-bold text-gray-700 text-xl mt-1">Order a book</h1>
</div>

@if(session("checkout"))
<div class="rounded-md flex justify-between items-center my-2 pl-4 pr-2 py-2 text-sm bg-green-700 text-white font-semibold ">
  Checkout succed!
  <p class="p-2 rounded-md inline-block w-max bg-white text-gray-700 text-xs">Details</p>
</div>
@endif

<form action="/checkout" method="post">
  @csrf
  <!-- Checkout Detail -->
  <div class="bg-gray-700 p-2 mt-2">
    <div class="p-2 border-b border-white flex items-center space-x-2">
      <i data-feather="truck" class="p-[2px] text-white"></i>
      <h1 class="text-lg text-white font-semibold">
        Order details
      </h1>
    </div>

    <div class="px-2 text-white text-sm divide-y divide-gray-500">
      <div class="flex justify-between items-center p-2">
        <p>
          Items
        </p>
        <div class="flex items-center space-x-4">
          <i data-feather="minus" class="text-white p-[5px] bg-gray-600" onclick="btnMines()"></i>
          <p id="items">
            1
          </p>
          <i data-feather="plus" class="text-white p-[5px] bg-gray-600" onclick="btnPlus()"></i>
        </div>
      </div>

      <div class="flex justify-between items-center p-2">
        <p>
          Price
        </p>
        <p id="price">
          {{ $book->price }}
        </p>
      </div>

    </div>



  </div>
  <div class="flex font-semibold justify-between items-center py-2 px-4 bg-gray-600 text-white text-sm">
    <p>
      Total Price
    </p>
    <p id="total">
      {{ $book->price }}
    </p>
  </div>
  <div class="grid grid-cols-12 gap-4 mt-4">
    <h1 onclick="selected(0)" class="brightness-50 wallet-items bg-[#00AA13] col-span-6 w-full h-24 text-sm text-white font-semibold flex justify-center items-center">Go Pay</h1>
    <h1 onclick="selected(1)" class="brightness-50 wallet-items bg-sky-400 col-span-6 w-full h-24 text-sm text-white font-semibold flex justify-center items-center">Dana</h1>
    <h1 onclick="selected(2)" class="brightness-50 wallet-items bg-purple-600 col-span-6 w-full h-24 text-sm text-white font-semibold flex justify-center items-center">OVO</h1>
    <h1 onclick="selected(3)" class="brightness-50 wallet-items bg-orange-500 col-span-6 w-full h-24 text-sm text-white font-semibold flex justify-center items-center">Shopee Pay</h1>
  </div>

  <div class="mt-4 p-4 bg-gray-700 rounded-md">
    <h1 class="text-white text-sm font-semibold">Card Number</h1>
    <input type="hidden" name="user" id="inputUID" value="{{ auth()->user()->id }}" required>
    <input type="hidden" name="book" id="inputBook" value="{{ $book->id }}" required>
    <input type="hidden" name="items" id="inputItems" value="1" required>
    <input type="hidden" name="total" id="inputTotal" value="{{ $book->price }}" required>
    <input type="hidden" name="wallet" id="inputWallet" value="" required>
    <input required type="number" class="placeholder-gray-500 text-gray-500 px-2 py-1 mt-2 border border-gray-400 rounded-md w-full outline-none">
    <button type="submit" class="py-2 px-4 bg-gray-500 text-white font-semibold text-center mt-2 w-full text-xs rounded-md hover:bg-gray-600">Checkout!</button>
  </div>
</form>

<script>
  // wallet
  const wallet = document.querySelectorAll('.wallet-items');
  const inputWallet = document.querySelector('#inputWallet');
  function selected(ind) {
    for (let i = 0; i < wallet.length; i++) {
      wallet[i].classList.remove('active');
      wallet[i].classList.remove('text-lg');
      wallet[i].classList.add('brightness-50');
      wallet[i].classList.add('text-sm');
    }

    if (!wallet[ind].classList.contains('active')) {
      wallet[ind].classList.add('active');
      wallet[ind].classList.add('text-lg');
      wallet[ind].classList.remove('brightness-50');
      wallet[ind].classList.remove('text-sm');
      inputWallet.value = wallet[ind].textContent;
    }

  }

  // items
  const items = document.querySelector('#items');
  const price = document.querySelector('#price');
  const total = document.querySelector('#total');
  
  const inputItems = document.querySelector('#inputItems');
  const inputTotal = document.querySelector('#inputTotal');
  
  function btnMines() {
    if (items.textContent == 1) {
      return 0;
    }
    
    let totalPrice = parseInt(total.textContent);

    total.innerHTML = totalPrice / parseInt(items.textContent);
    items.innerHTML = items.textContent - 1;
    inputItems.value = items.textContent;
    inputTotal.value = total.textContent;
  }

  function btnPlus() {
    let num = parseInt(items.textContent);
    let totalPrice = parseInt(total.textContent);
    
    items.innerHTML = num + 1;
    inputItems.value = items.textContent;
    total.innerHTML = totalPrice * parseInt(items.textContent);
    inputTotal.value = total.textContent;
  }
  
  console.log(parseInt(price.textContent));
  console.log(parseInt(total.textContent));

</script>

@endsection