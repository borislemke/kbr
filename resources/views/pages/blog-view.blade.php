@extends('index')
@section('title', '')
@section('content')

<div class="content blog container">
    <div class="wrapper">
        <h1 class="title_page">{{ $post->lang()->title }}</h1>
        <div class="blog-image-wrapper"><img src="{{ asset('no-image.png') }}" alt="{{ $post->lang()->title }}"></div>

        <span class="detail-info"><i class="fa fa-calendar"></i> {{ $post->created_at->format('Y-m-d') }}
            <i class="material-icons">visibility</i> 10
            <i class="fa fa-folder-open-o"></i> Wood, Customer Review
        </span>

        <p>{!! $post->lang()->content !!}</p>

        <a href="{{ route('blog', ['blog' => trans('url.blog')]) }}" class="red-border-btn" style="font-size: 11px; margin-top: 0;">Back to blogs</a>
    </div>
</div>
@stop


@section('scripts')

@stop
