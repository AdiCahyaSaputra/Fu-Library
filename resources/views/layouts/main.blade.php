<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="{{ asset('js/tailwindcss.js') }}"></script>
  <style>
    * {
      -webkit-tap-highlight-color: transparent;
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
      <div class="md:col-span-2 md:block md:relative md:left-0 bg-white fixed w-2/3 md:w-auto h-full top-0 -left-full z-30 " id="sidebar">
        <div class="py-5 bg-gray-700" onclick="window.location.href = '/dashboard';">
          <div class="text-center">
            <?php // $pecahSTR = explode(' ', auth()->user()->profile->nama); $nama = $pecahSTR[0]; ?>
            <h4 class="font-bold text-md md:text-sm text-white uppercase">{{ auth()->user()->name }}</h4>
            <div class="py-2 px-4 bg-white rounded-full text-gray-700 inline-block text-xs mt-2 uppercase">
              SMK-RPL
            </div>
          </div>
        </div>
        <ul class="text-sm md:text-md">
          @if(Request::is('admin*'))
          <a href="/admin" class="relative mt-5 pl-5  py-4 inline-block w-full  {{ Request::is('admin') ? 'text-gray-700 font-bold' : 'text-gray-400 hover:text-gray-700' }}">
            @if (Request::is('admin'))
            <div class="absolute bg-gray-700 w-2 h-full top-0 left-0"></div>
            @endif
            Dashboard
          </a>
          @else
          <a href="/" class="relative mt-5 pl-5  py-4 inline-block w-full  {{ Request::is('/') || Request::is('home*') ? 'text-gray-700 font-bold' : 'text-gray-400 hover:text-gray-700' }}">
            @if (Request::is('/') || Request::is('home*'))
            <div class="absolute bg-gray-700 w-2 h-full top-0 left-0"></div>
            @endif
            Home
          </a>
          <a href="/dashboard" class="{{ Request::is('dashboard*') ? 'text-gray-700 font-bold' : 'hover:text-gray-700 text-gray-400' }} relative mt-5 pl-5 py-4 inline-block w-full">
            @if (Request::is('dashboard*'))
            <div class="absolute bg-gray-700 w-2 h-full top-0 left-0"></div>
            @endif
            Dashboard
          </a>
          <a href="/lessons" class="{{ Request::is('category*') ? 'text-gray-700 font-bold' : 'hover:text-gray-700 text-gray-400' }} relative mt-5 pl-5 py-4 inline-block w-full">
            @if (Request::is('category*'))
            <div class="absolute bg-gray-700 w-2 h-full top-0 left-0"></div>
            @endif
            Category
          </a>
          @endif
        </ul>

        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="fixed w-2/3 md:absolute bottom-0 bg-gray-200 hover:bg-gray-300 text-gray-700 p-4 md:w-full inline-block text-sm">Log Out</button>
        </form>
      </div>
      @endif
      <div class="col-span-12 bg-white {{ Request::path() != 'login' && Request::path() != 'register' ? 'p-4 md:col-span-10' : '' }} min-h-screen overflow-auto no-scrollbar relative" id="toggle-sidebar">
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
</body>
</html>