
@extends('index')
@section('title', 'Blogs')
@section('content')

<div class="blog-holder container">
    <div class="col-md-12 col-sm-12">
        <div class="col-md-9 col-sm-12">
           
           @foreach($posts as $post)
            <div class="blog-content-holder">
                <div class="blog-content-item-holder">
                    <div class="blog-item-image"> <img src="{{ baseUrl() }}/assets/img/contact/au.jpg" alt=""> </div>
                    <div class="blog-item-title"><h3>{{ $post->lang()->title }}</h3></div>
                    <div class="blog-item-post-date"> 
                        <ul>
                            <li><a href=""><i class="material-icons">date_range</i>{{ $post->created_at->format('Y-m-d') }}</a> </li>
                            <li><a href=""><i class="material-icons">style</i> {{ $post->categories[0]->name }}</a> </li>
                            <!-- <li><a href=""><i class="material-icons">comment</i> 3 </a> </li> -->
                        </ul>
                    </div>
                    
                    <div class="blog-item-content">
                        <p>
                            {!! str_limit(strip_tags($post->lang()->content), 300) !!}
                        </p>
                    </div>
                    
                    <div class="blog-item-readmore">
                        <a href="{{ route('blog', ['blog' => trans('url.blog'), 'term' => $post->created_at->format('Y/m/d') . '/' . $post->lang()->slug]) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
                
                <div class="blog-content-item-holder">
                    <div class="blog-item-image"></div>
                    <div class="blog-item-title"></div>
                    <div class="blog-item-post-date"></div>
                    <div class="blog-item-content"></div>
                    <div class="blog-item-readmore"></div>
                </div>
            </div>
            @endforeach

            <div class="text-center">
            {!! $posts->render() !!}
            </div>


        </div>
        
        <div class="col-md-3 col-sm-12">
            <div class="blog-menu-holder">
                <div class="blog-menu-search"></div>
                <div class="blog-menu-categories"></div>
                <div class="blog-menu-popular-post"></div>
                <div class="blog-menu-archives"></div>
            </div>
        </div>
    </div>
</div>
@stop
