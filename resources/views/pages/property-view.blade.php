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

                @if($property->thumb)
                <img src="{{ asset('uploads/property/' . $property->thumb()->first()->value) }}">
                @else
                <img src="{{ asset('no-image.png') }}">
                @endif


                <p for=""><span class="currency">{!! \Config::get('currency') !!}</span> {{ number_format($property->price, 2) }}</p>

                
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Description</div>
                <div class="panel-body">
                    {!! $property->lang()->content !!}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Facilities</div>

                <div class="panel-body">
                    <ul>
                        @foreach($property->facilities() as $facility)
                        <li>
                            {{ $facility->name }} : {{ $facility->value }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Distances</div>

                <div class="panel-body">
                    <ul>
                        @foreach($property->distances() as $distance)
                        <li>
                            {{ $distance->name }} : {{ $distance->value }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Details</div>

                <div class="panel-body">
                    <ul>
                   
                        <li>
                            Land: {{ $property->land_size }}
                        </li>
                       
                        <li>
                            Buliding: {{ $property->building_size }}
                        </li>

                    </ul>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">View</div>

                <div class="panel-body">
                    <ul>
                   
                        <li>
                            North: {{ $property->view_north }}
                        </li>
                       
                        <li>
                            West: {{ $property->view_west }}
                        </li>

                    </ul>
                </div>
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
                            <a href="#" class="btn btn-default fa <? if ($custLog) echo checkWishlist($custLog->id, $property->id) ? 'fa-heart' : 'fa-heart-o'; else echo 'fa-heart-o'; ?>" id="btn-favorite"> Favorites</a>
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

    {!! Form::open([ 'url' => route('api.enquiry.store'), 'id' => 'form-enquiry' ]) !!}

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
        <button type="submit" class="btn btn-primary send-enquiry">Send</button>
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

            var url = "{{ route('api.wishlist.store') }}";
            var token = "{{ csrf_token() }}";

            $.post(url, {property_id: propertyId, customer_id: customerId, _token: token}, function(data, textStatus, xhr) {
                
                console.log(data);

                if (data.status == 200) {

                    $('#btn-favorite').removeClass('fa-heart-o').addClass('fa-heart');
                }

                if (data.status == 300) {

                    $('#btn-favorite').removeClass('fa-heart').addClass('fa-heart-o');
                }

            });

        } else {

            alert('Please login!');
        }

        event.preventDefault();
    });

    $('#form-enquiry').submit(function(event) {
        event.preventDefault();

        $('.send-enquiry').html('Sending...');

        console.log('send enquiry');

        var url = $(this).attr('action');
        var data = $(this).serialize();

        $.post(url, data, function(data, textStatus, xhr) {
            
            console.log(data);

            if (data.status == 200) {

                $('#inquiryModal').modal('hide');

                console.log(data.monolog.message);
                // todo show success dialog;
            }

            if (data.status == 500) {

                if (data.monolog.message.name)
                    $('input[name=name]').closest('.form-group').addClass('has-error');

                if (data.monolog.message.subject)
                    $('input[name=subject]').closest('.form-group').addClass('has-error');

                if (data.monolog.message.phone)
                    $('input[name=phone]').closest('.form-group').addClass('has-error');
            }

            $('.send-enquiry').html('Send');

        });

    });
});

</script>

@stop