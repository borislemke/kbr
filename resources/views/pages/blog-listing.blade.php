
@extends('index')
@section('title', 'Blogs')
@section('content')

<div class="blog-holder container">
    <div class="col-md-12 col-sm-12">
        <div class="col-md-9 col-sm-12">
           
            <div class="blog-content-holder">
                <div class="blog-content-item-holder">
                    <div class="blog-item-image"> <img src="{{ baseUrl() }}/assets/img/contact/au.jpg" alt=""> </div>
                    <div class="blog-item-title"><h3>Image Post Type</h3></div>
                    <div class="blog-item-post-date"> 
                        <ul>
                            <li><a href=""><i class="material-icons">date_range</i>2016-1-1</a></li>
                            <li><a href=""><i class="material-icons">style</i> Real Estate</a></li>
                            <li><a href=""><i class="material-icons">comment</i> 3 </a></li>
                        </ul>
                    </div>
                    
                    <div class="blog-item-content">
                        <p>
                            Porttitor feugiat mus cras quisque pharetra sagittis non laoreet augue nulla lectus auctor accumsan cubilia sollicitudin mattis leo vel morbi class sollicitudin cubilia quisque penatibus dictumst faucibus dui natoque ultricies montes congue pellentesque aliquet lectus dictum est volutpat class odio elementum quis commodo dolor ultrices scelerisque montes class curabitur class
                        </p>
                    </div>
                    
                    <div class="blog-item-readmore">
                        <a href="" class="btn btn-primary">Read More</a>
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
