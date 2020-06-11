@extends('layouts.authMaster')
@section('content')


<div class="container">
<h1>Contact US</h1>

@if(Session::has('success'))
   <div class="alert alert-success">
     {{ Session::get('success') }}
   </div>
@endif
@if(Session::has('error'))
   <div class="alert alert-danger">
     {{ Session::get('error') }}
   </div>
@endif

<form method="post" action="/contact-us">

<!-- <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
<label>Name:</label>
<input type='name' name='name' class='form-control' placeholder='Enter Name' />
<span class="text-danger">{{ $errors->first('name') }}</span>
</div> -->

<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
<label>Email:</label>
<input name='email' type='email' class='form-control' placeholder='Enter Email' />
<span class="text-danger">{{ $errors->first('email') }}</span>
</div>

<div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
<label>Message:</label>
<textarea name='message' class='form-control' placeholder="Enter Message"></textarea>
<span class="text-danger">{{ $errors->first('message') }}</span>
</div>

<div class="form-group">
<button class="btn btn-success">Contact US!</button>
</div>
{{csrf_field()}}
</form>

</div>
@stop