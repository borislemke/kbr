@extends('index')
@section('content')

<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ route('home') }}">{{ trans('url.home') }}</a></li>
        <li class="active">{{ trans('url.account') }}</li>
    </ul>
</div>
<div class="line-top"></div>
<div class="container">
    <h3>ACCOUNT</h3>
    <ul>
        <li><a href="{{ route('account.wishlist', ['account' => trans('url.account'), 'wishlist' => trans('url.wishlist')]) }}">{{ trans('url.wishlist') }}</a></li>
        <li><a href="{{ route('account.setting', ['account' => trans('url.account'), 'setting' => trans('url.setting')]) }}">{{ trans('url.setting') }}</a></li>
        <li><a href="{{ route('logout', trans('url.logout')) }}">{{ trans('url.logout') }}</a></li>
    </ul>
</div>

@endsection

@section('scripts')
<script>
    Kibarer.home();
</script>
@endsection
