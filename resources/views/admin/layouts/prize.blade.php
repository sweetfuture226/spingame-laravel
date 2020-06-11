<h1>{{ $data['title'] }} {{ $data['user'] }}</h1>
<hr/>
<p>Click <a href ="{{ route('verifyemail')}}?nonce={{$data['nonce']}}"> here</a> to complete the registration.</p>
<hr/>
<footer>Mail from <a href='{{ config('app.url') }}'>{{ config('app.url') }}</a></footer>
