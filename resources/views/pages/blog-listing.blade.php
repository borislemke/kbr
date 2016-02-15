@extends('index')
@section('title', 'Blogs')
@section('content')

<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ route('home') }}">{{ trans('url.home') }}</a></li>
        <li class="active">{{ trans('url.blog') }}</li>
    </ul>
</div>
<div class="line-top"><h3><small>{{ trans('url.blog') }}</small></h3></div>

<div class="content blogs container">
    <div class="wrapper">
        <div class="column-left">

            @foreach($posts as $blog)
            <a href="{{ baseUrl() }}/blog/{{ $blog->url }}">
                <div class="blog-item">
                    <div class="blog-img" style="background-image: url({{ baseUrl() . '/media/blog/' . $blog->image }})">
                    </div>
                    <div class="blog-text">
                        <h2>{{ $blog->title }}</h2>
                        <p>{{ $blog->meta_desc }}</p>
                        <div class="sec-line">
                            <button class="red-border-btn">Read more</button>
                            <span class="detail-info"><i class="fa fa-calendar"></i> {{ $blog->created_at }}
                                <i class="material-icons">visibility</i> {{ $blog->views }}
                                <!--                                <i class="fa fa-folder-open-o"></i> Wood, Customer Review-->
                            </span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach

        </div>
        <div class="column-right">
            <div class="wrap">
                <h3>Categories</h3>
                <ul>
                    <li><a>Wood</a></li>
                    <li><a>Metal</a></li>
                    <li><a>Hospitality</a></li>
                    <li><a>Customers review</a></li>
                </ul>
                <h3>Date</h3>
                <ul>
                    <li><a>January</a></li>
                    <li><a>Febuary</a></li>
                    <li><a>March</a></li>
                    <li><a>April</a></li>
                    <li><a>May</a></li>
                    <li><a>June</a></li>
                    <li><a>July</a></li>
                    <li><a>August</a></li>
                    <li><a>September</a></li>
                    <li><a>October</a></li>
                    <li><a>November</a></li>
                    <li><a>December</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop
