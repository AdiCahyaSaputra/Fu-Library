<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="{{ asset('js/tailwindcss.js') }}"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {}
      }
    }
  </script>
  <style>
    * {
      -webkit-tap-highlight-color: transparent;
      transition: all .3s;
    }

    .line-clamp-3 {
      overflow: hidden;
      display: -webkit-box;
      -webkit-box-orient: vertical;
      -webkit-line-clamp: 3;
    }

    #sidebar, #overlay-side {
      transition: all 0.7s;
    }
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
      display: none;
    }
    /* /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    html {
      scroll-behavior: smooth;
    }
  </style>
  <title>FU Library | {{ $tittle }}</title>
</head>
<body>
  <!-- Nav Bar -->
  <div class="w-full h-full md:h-screen bg-gray-100">
    <div class="bg-gray-100 grid grid-cols-12 gap-2 h-full">
      @if(Request::path() != 'login' && Request::path() != 'register')
      <div class="md:col-span-2 md:block md:relative md:left-0 bg-white fixed w-2/3 md:w-auto inset-y-0 -left-full z-30 " id="sidebar">
        <div class="py-5 bg-gray-700" onclick="window.location.href = '/dashboard';">
          <div class="text-center">
            <?php // $pecahSTR = explode(' ', auth()->user()->profile->nama); $nama = $pecahSTR[0]; ?>
            <h4 class="font-bold md:text-sm text-white uppercase mr-1 inline">BOOK</h4>
            <div class="px-2 py-1 bg-white rounded-md text-gray-700 text-xs uppercase inline-block">
              SHOP
            </div>
          </div>

        </div>
        <ul class="text-sm md:text-md">

          <a href="/home" class="relative mt-5 pl-5  py-4 inline-block w-full  {{ Request::is('/') || Request::is('home*') || Request::is('checkout*') ? 'text-gray-700 font-bold' : 'text-gray-400 hover:text-gray-700' }}">
            @if (Request::is('/') || Request::is('home*') || Request::is('checkout*'))
            <div class="absolute bg-gray-700 w-2 h-full top-0 left-0"></div>
            @endif
            Home
          </a>
          <a href="/orders/all" class="{{ Request::is('orders*') ? 'text-gray-700 font-bold' : 'hover:text-gray-700 text-gray-400' }} relative mt-5 pl-5 py-4 inline-block w-full">
            @if (Request::is('orders*'))
            <div class="absolute bg-gray-700 w-2 h-full top-0 left-0"></div>
            @endif
            Order History
          </a>
          <a href="/bookmark" class="{{ Request::is('bookmark*') ? 'text-gray-700 font-bold' : 'hover:text-gray-700 text-gray-400' }} relative mt-5 pl-5 py-4 inline-block w-full">
            @if (Request::is('bookmark*'))
            <div class="absolute bg-gray-700 w-2 h-full top-0 left-0"></div>
            @endif
            Bookmark
          </a>

          <a href="/credits" class="{{ Request::is('credits*') ? 'text-gray-700 font-bold' : 'hover:text-gray-700 text-gray-400' }} relative mt-5 pl-5 py-4 inline-block w-full">
            @if (Request::is('credits*'))
            <div class="absolute bg-gray-700 w-2 h-full top-0 left-0"></div>
            @endif
            Credits
          </a>
          <div class="px-2">
            <div class="relative bg-gray-400 mt-5 px-5 py-4 inline-block w-full flex rounded-md hover:bg-gray-600 space-x-2 items-center" onclick="clickLogout()">
              <i data-feather="log-out" class="w-8 h-8 p-2 rounded-md bg-white"></i>
              <form action="/logout" method="post">
                @csrf
                <button type="submit" class="text-white" id="btnLogout">Log Out</button>
              </form>

            </div>

          </div>


        </ul>

      </div>
      @endif
      <div class="col-span-12 bg-white {{ Request::path() != 'login' && Request::path() != 'register' ? 'p-4 md:col-span-8' : '' }} min-h-screen overflow-auto no-scrollbar relative pb-32" id="toggle-sidebar">
        @if (Request::path() != "login" && Request::path() != "register" && Request::path() != 'home/c/*')
        <div class="absolute inset-0 bg-black bg-opacity-50 hidden z-10" id="overlay-side"></div>
        <div class="cursor-pointer flex flex-col items-end w-16 h-16 py-2 bg-transparent absolute right-4 top-4 md:hidden" id="btn-side">
          <div class="w-16 h-2 flex space-x-2">
            <div class="w-2 h-full bg-gray-700"></div>
            <div class="w-12 h-full bg-gray-700"></div>
          </div>
          <div class="mt-2 w-10 h-2 bg-gray-700"></div>
          <div class="mt-2 w-14 h-2 flex space-x-2">
            <div class="w-8 h-full bg-gray-700"></div>
            <div class="w-4 h-full bg-gray-700"></div>
          </div>
        </div>
        @endif
        @yield('content')
      </div>
    </div>
  </div>

  <!-- Javascript -->
  <script src="{{ asset('js/sidebar.js') }}"></script>
  <!-- choose one -->
  <script>
    const btnLogout = document.querySelector('#btnLogout');
    function clickLogout() {
      btnLogout.click();
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace()
  </script>
</body>
</html>