@extends('index')

@section('meta_description', $page->meta_description)
@section('meta_keyword', $page->meta_keyword)

@section('content')

<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ url() }}">Home</a></li>
        <li class="active">{{ $page->lang()->title }}</li>
    </ul>
</div>
<div class="line-top"><h3><small>{{ $page->lang()->title }}</small></h3></div>

<div class="container">
    <h3>{{ $page->lang()->title }}</h3>
</div>

@endsection

@section('scripts')
<script>
    Kibarer.home();
</script>
@endsection
