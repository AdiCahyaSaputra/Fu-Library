@extends('layouts.main')

@section('content')
<div class="py-2">
  <h1 class="text-purple-400 text-xs">FU Library / Admin</h1>
  <h1 class="font-bold text-purple-700 text-2xl">DASHBOARD</h1>
</div>

<h1 class="text-purple-700 font-bold mt-2 p-2 bg-purple-200 border-l-4 border-purple-700">Database: All Books</h1>
<!-- Table -->
<div class="w-full bg-white shadow-lg rounded-sm border border-gray-200 mt-4">
  <div class="p-3">
    <div class="overflow-x-auto no-scrollbar">
        <table class="table-auto w-full">
          <thead class="text-xs font-semibold uppercase text-purple-700 bg-purple-200">
            <tr>
              <th class="p-2 whitespace-nowrap">
                <div class="font-semibold text-left">
                  No
                </div>
              </th>
              <th class="py-2 px-4 whitespace-nowrap">
                <div class="font-semibold text-left">
                  Tittle
                </div>
              </th>
              <th class="py-2 px-4 whitespace-nowrap">
                <div class="font-semibold text-left">
                  Category
                </div>
              </th>
              <th class="py-2 px-4 whitespace-nowrap">
                <div class="font-semibold text-left">
                  Author
                </div>
              </th>
            </th>
            <th class="py-2 px-4 whitespace-nowrap">
              <div class="font-semibold text-left">
                Pages
              </div>
            </th>
            <th class="py-2 px-4 whitespace-nowrap">
              <div class="font-semibold text-left">
                Action
              </div>
            </th>
          </tr>
        </thead>
        <tbody class="text-sm divide-y divide-gray-100">
          @foreach($books as $book)
          <tr>
            <td class="whitespace-nowrap">
              <div class="p-2 font-medium text-gray-800">
                {{ $loop->iteration }}.
              </div>
            </td>
            <td class="py-2 px-4 whitespace-nowrap">
              <div class="font-medium text-gray-800">
                {{ $book->tittle }} ({{ $book->year }})
              </div>
            </td>
            <td class="py-2 px-4 whitespace-nowrap">
              <div class="text-left">
                {{ $book->category->name }}
              </div>
            </td>
            <td class="py-2 px-4 whitespace-nowrap">
              <div class="text-left">
                {{ $book->author }}
              </div>
            </td>
            <td class="py-2 px-4 whitespace-nowrap">
              <div class="text-left">
                {{ $book->pages }}
              </div>
            </td>
            <td class="py-2 px-4 whitespace-nowrap">
              <div class="text-left text-xs">
                <a href="/admin/d/edit" class="hover:bg-purple-200 text-purple-700">Edit</a>
                <p class="inline-block"> / </p>
                <a href="/admin/d/delete" class="hover:bg-purple-200 text-purple-700">Delete</a>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <a href="/admin/d/create" class="block hover:bg-purple-500 py-2 text-center bg-purple-300 font-bold text-purple-700">Create</a>
  </div>
</div>

<h1 class="text-purple-700 font-bold mt-6 p-2 bg-purple-200 border-l-4 border-purple-700">Database: Rent Records</h1>
<!-- Table -->
<div class="w-full bg-white shadow-lg rounded-sm border border-gray-200 mt-4">
  <div class="p-3">
    <div class="overflow-x-auto no-scrollbar">
      <table class="table-auto w-full">
        <thead class="text-xs font-semibold uppercase text-purple-700 bg-purple-200">
          <tr>
            <th class="p-2 whitespace-nowrap">
              <div class="font-semibold text-left">
                No
              </div>
            </th>
            <th class="py-2 px-4 whitespace-nowrap">
              <div class="font-semibold text-left">
                Name
              </div>
            </th>
            </th>
            <th class="py-2 px-4 whitespace-nowrap">
              <div class="font-semibold text-left">
                Book
              </div>
            </th>
            <th class="py-2 px-4 whitespace-nowrap">
              <div class="font-semibold text-left">
                Rent Date
              </div>
            </th>
            <th class="py-2 px-4 whitespace-nowrap">
              <div class="font-semibold text-left">
                Return Date
              </div>
            </th>
          </th>
        </tr>
      </thead>
      <tbody class="text-sm divide-y divide-gray-100">
        @foreach($pinjams as $pinjam)
        <tr>
          <td class="whitespace-nowrap">
            <div class="p-2 font-medium text-gray-800">
              {{ $loop->iteration }}.
            </div>
          </td>
          <td class="py-2 px-4 whitespace-nowrap">
            <div class="font-medium text-gray-800">
              {{ $pinjam->user->name }}
            </div>
          </td>
          <td class="py-2 px-4 whitespace-nowrap">
            <div class="text-left">
              {{ $pinjam->book->tittle }}
            </div>
          </td>
          <td class="py-2 px-4 whitespace-nowrap">
            <div class="text-left">
              {{ $pinjam->rentDate }}
            </div>
          </td>
          <td class="py-2 px-4 whitespace-nowrap">
            <div class="text-left">
              {{ $pinjam->returnDate }}
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>

@endsection