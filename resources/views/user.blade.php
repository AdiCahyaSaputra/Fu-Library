@foreach( $users as $user )
<h1>{{ $user->username }}</h1>
<h1>{{ $user->name }}</h1>
<h1>{{ $user->class }}</h1>
<h1>{{ $user->password }}</h1>
<h1>{{ $user->jurusan->name }}</h1>
<br>
@endforeach

