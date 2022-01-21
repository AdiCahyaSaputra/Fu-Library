@extends('layouts.main')

@section('content')
<h1>Welcome To Dashboard, {{ auth()->user()->name }}</h1>
@endsection