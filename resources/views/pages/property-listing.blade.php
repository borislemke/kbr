@extends('index')
@section('content')
<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ baseUrl() }}">Home</a></li>
        <li class="active">{{ ucfirst($type) }}</li>
    </ul>
</div>
<div class="line-top"><h3><small>{{ $type }}</small></h3></div></div>
<br>
<div class="container">
    <div class="row list jscroll">

        @foreach($properties as $property)
        <div class="col-md-4 list-item">
            <a href="{{ route('property.detail', str_slug($property->lang()->title) . '-' . $property->id) }}">

                <div class="thumbnail">
                    @if(count($property->propertyFiles) > 0)
                    <img src="{{ asset('uploads/property/' . $property->propertyFiles[0]->file) }}">
                    @else
                    <img src="{{ asset('no-image.png') }}">
                    @endif

                    <div class="caption">
                        <h3 class="list-item-title">{{ $property->lang()->title }}</h3>
                    </div>
                </div>
            </a>
        </div>
        @endforeach

        <a class="jscroll-next hidden" href="{{ $properties->nextPageUrl() }}">next page</a>

    </div>

</div>

@stop

@section('scripts')
<script type="text/javascript">

var lastPage = {{ $properties->lastPage() }} - 1;

$(document).ready(function() {
    
    $('.jscroll').jscroll({
        debug: false,
        autoTrigger: true,
        autoTriggerUntil: lastPage,
        loadingHtml: '<img src="assets/img/loading_bar.gif" alt="Loading" />',
        padding: 300,
        nextSelector: 'a.jscroll-next:last',
        pagingSelector: 'a.jscroll-next:last',
        callback: function () {
            console.log('loaded');
        }
    });

});

</script>
@stop
