<form action="/test-csrf" method="post">
  <input type="hidden" name="token" value="{{ $token }}">
  <input type="text" name="nama">
  <button type="submit">Submit</button>
</form>