@extends('index')
@section('content')

<div class="bs-component">
    <ul class="breadcrumb">
        <li><a href="{{ baseUrl() }}">Home</a></li>
        <li><a href="{{ route('account', Lang::get('url')['account']) }}">Account</a></li>
        <li class="active">Wishlist</li>
    </ul>
</div>
<div class="line-top"></div>

<div class="container">
    <h3>WISHLIST</h3>
</div>

@stop