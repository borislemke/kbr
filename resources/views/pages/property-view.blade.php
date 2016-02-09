@extends('index')
@section('content')

<?php  
    $custLog = Auth::customer()->get();
?>

<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ baseUrl() }}">Home</a></li>
        <li class="active">{{ $property->lang()->title }}</li>
    </ul>
</div>
<div class="line-top"><h3><small>{{ $property->lang()->title }}</small></h3></div>

<div class="container">

  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->

    <div class="row detail">

        <div class="col-md-8 property-detail" data-id="{{ $property->id }}" data-customerId="{{ ($custLog)? $custLog->id : 0 }}">

            <div class="thumbnail nohovereffect">
                @if(count($property->propertyFiles) > 0)
                <img src="{{ asset('uploads/property/' . $property->propertyFiles[0]->file) }}">
                <p for=""><span class="currency">{!! \Config::get('currency') !!}</span> {{ number_format($property->price, 2) }}</p>
                @else
                <img src="{{ asset('no-image.png') }}">
                <p for=""><span class="currency">{!! \Config::get('currency') !!}</span> {{ number_format($property->price, 2) }}</p>
                @endif

                
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Description</div>
                <div class="panel-body">
                    {{ $property->lang()->description }}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Facilities</div>

                <ul class="list-group">

                    @foreach($property->facilities as $facility)
                    <li class="list-group-item">
                        <span class="badge">{{ $facility->description }}</span>
                        {{ $facility->name }}
                    </li>
                    @endforeach

                </ul>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Distances</div>

                <ul class="list-group">

                    @foreach($property->distances as $distance)
                    <li class="list-group-item">
                        <span class="badge">{{ $distance->value }} {{ $distance->unit }}</span>
                        {{ $distance->from }}
                    </li>
                    @endforeach

                </ul>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Details</div>

                <ul class="list-group">
                   
                    <li class="list-group-item">
                        <span class="badge">{{ $property->land_size }} m2</span>
                        Land:
                    </li>
                   
                    <li class="list-group-item">
                        <span class="badge">{{ $property->building_size }} m2</span>
                        Building:
                    </li>

                </ul>
            </div>
            
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <span class="currency "><sup>{!! \Config::get('currency') !!} </sup> {{ number_format($property->price, 2) }} </span> 
                </div>
                <div class="panel-body">
                    <div class="" >
                        <div class="col-lg-12" style="padding-bottom: 20px;">
                            <a href="#" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#inquiryModal">Inquire this property</a>
                        </div>
                    </div>
                    <br>
                    <div class=" text-center" >
                        <div class="col-lg-6">
                            <a href="#" class="btn btn-default fa fa-print"> Print PDF</a>
                        </div>
                        <div class="col-lg-6">
                            <a href="#" class="btn btn-default fa fa-heart-o" id="btn-favorite"> Favorites</a>
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Inquiry Modal -->
<div id="inquiryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

    {!! Form::open([ 'url' => route('property.inquiry') ]) !!}

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Inquire this property</h4>
      </div>

      <div class="modal-body">
        <input type="hidden" name="property_id" value="{{ $property->id }}">

        <div class="form-group">
          <input name="name" type="text" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
          <input name="phone" type="text" class="form-control" placeholder="Phone">
        </div>
        <div class="form-group">
          <input name="email" type="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
          <input name="subject" type="text" class="form-control" placeholder="Subject">
        </div>

        <div class="form-group">
          <textarea name="content" class="form-control" rows="5" placeholder="Comment"></textarea>
        </div>

        <div class="form-group">
            <div class="g-recaptcha" data-sitekey="6LcdHRcTAAAAAMUKsjZDzArdb0e8Fk2HU-duNhJP" style=" margin-top: 20px; margin-bottom:20px;"></div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Send</button>
      </div>

    {!! Form::close() !!}

    </div>

  </div>
</div>


@stop

@section('scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">

$(document).ready(function() {
    
    $('#btn-favorite').click(function(event) {
        /* Act on the event */

        console.log('favorite clicked');

        var propertyId = $('.property-detail').attr('data-id');

        var customerId = $('.property-detail').attr('data-customerId');

        if (customerId != 0) {

            var url = "{{ route('property.favorite') }}";
            var token = "{{ csrf_token() }}";

            $.post(url, {property_id: propertyId, customer_id: customerId, _token: token}, function(data, textStatus, xhr) {
                
                console.log(data);
            });

        } else {

            alert('Please login!');
        }

        event.preventDefault();
    });
});

</script>

@stop