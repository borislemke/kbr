@extends('index')
@section('content')

<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ route('home') }}">{{ trans('url.home') }}</a></li>
        <li><a href="{{ route('account', trans('url.account')) }}">{{ trans('url.account') }}</a></li>
        <li class="active">{{ trans('url.wishlist')}}</li>
    </ul>
</div>
<div class="line-top"> <h3><small>{{ trans('url.wishlist') }}</small> </h3></div>

<div class="container wishlist">
    <div class="row">
       
        <div class="col-md-12 col-sm-12">
            
            <div class="user-wrapper">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="icon-user media-object img-circle" src="{{ asset('facex.jpg') }}" alt=""> 
                        </a>
                    </div>
                    <div class="user-desc media-body">
                        <a href="">
                            <h4 class="media-heading">andre’s wish lists</h4>
                        </a>
                        <p>
                            Wishlists: <span>3</span>
                        </p>
                    </div>
                </div>
            </div>
            
            @foreach($wishlists as $wishlist)
            <div class="panel panel-primary col-md-12 col-sm-6">
                <div class="panel-body">
                    <div class="col-md-3 display-wishlist-image">
                        <div class="media">
                            <div class="media-left">
                                @if($wishlist->property->thumb())
                                <img class="media-object img-responsive" src="{{ asset('uploads/property/' . $wishlist->property->thumb()->file) }}">
                                @else
                                <img width="150" src="{{ asset('no-image.png') }}">
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="display-wishlist-desc">
                        
                        <div class="col-md-5 ">
                            <div class="media-body">
                                
                                <h4>{{ $wishlist->property->lang()->title }}</h4>
                                
                                <p>
                                    {{ $wishlist->property->lang()->description }}
                                </p>
                            </div>
                            <div class="facilities">
                                <ul>
                                   @foreach($wishlist->property->facilities as $facility)
                                    <li> {{ $facility->name }} : <span> {{ $facility->description }}</span> </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="media-body">
                               <div class="price">
                                   <h4>{{ $wishlist->property->price }}</h4>
                               </div>
                                
                                <div class="view-detail">
                                    <a href="{{ route('property.detail', str_slug($wishlist->property->lang()->title) . '-' . $wishlist->property->id) }}">View</a>
                                    <button type="button" class="btn btn-danger delete-wishlist" data-url="{{ route('api.wishlist.destroy', $wishlist->id) }}">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>   
    
    <div class="col-md-12">
        <div class="pagination-wrapper">
            {!! $wishlists->render() !!}
        </div>
    </div>
    

</div>

@stop

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        
        $('.delete-wishlist').click(function(event) {

            var question = 'Are you sure delete this item?';

            if(confirm(question)){

                var url = $(this).attr('data-url');
                var customerId = "{{ $customer->id }}";
                var token = "{{ csrf_token() }}";
                var method = 'delete';

                $.post(url, {id: id, customer_id: customerId, _token: token, _method: method}, function(data, textStatus, xhr) {
                    
                    console.log(data);
                    if (data == 'deleted') location.reload();
                });

            }

            event.preventDefault();
        });
    });     
</script>
@stop