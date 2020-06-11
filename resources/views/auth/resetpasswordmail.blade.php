<h1>{{ $title }} {{ $user }}</h1>
<hr/>
<p>Click <a href ="{{ route('passwordreset')}}?nonce={{$nonce}}"> here</a> to reset your password.</p>
<hr/>
<footer>Mail from <a href='{{ config('app.url') }}'>{{ config('app.url') }}</a></footer>
