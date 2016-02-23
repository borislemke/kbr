@extends('index')
@section('content')

<?php

$custLog = Auth::customer()->get();
?>

<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ baseUrl() }}">{{ trans('word.home') }}</a></li>
        <li><a href="{{ url('/') }}/villas">Villas</a></li>
        <li class="active">{{ $property->lang()->title }}</li>
    </ul>
</div>

<div class="detail-page">

    <div class="page-view-section-top">

        <div class="container">

            <div class="property-view-header">
                <h1>{{ $property->lang()->title }}</h1>
                <h2>Code: {{ $property->code }}</h2>
            </div>

            <div class="property-view-head flexbox flexbox-wrap">
                <div class="property-view-head-left">
                    <div class="property-view-head-gallery"></div>
                    <div class="property-head-left-information-wrapper">
                        <div class="property-view-head-information-block"></div>
                        <div class="property-view-head-information-block"></div>
                        <div class="property-view-head-information-block"></div>
                        <div class="property-view-head-information-block"></div>
                    </div>
                </div>

                <div class="property-view-head-right">
                    <div class="property-view-head-price-box flexbox">
                        <div class="property-head-view-price-currency">
                            <select name="currency_rate" id="currency_select">
                                <option value="usd" selected>usd</option>
                                <option value="idr">idr</option>
                                <option value="eur">eur</option>
                                <option value="rub">rub</option>
                            </select>
                        </div>
                        <div class="property-head-view-price-value">
                            <p>{{ convertCurrency($property->price, $property->currency, 'idr') }}</p>
                        </div>
                    </div>
                    <button class="property-view-head-enquiry flexbox">
                        <div class="head-enquiry-icon"><i class="material-icons">mail_outline</i></div>
                        <div class="head-enquiry-text">
                            <p class="head-enquiry-bold">{{ trans('word.enquire_this_villa') }}</p>
                            <p class="head-enquiry-hint">{{ trans('word.simple_form_minutes') }}</p>
                        </div>
                    </button>
                    <div class="property-view-head-action-buttons flexbox">
                        <button class="property-view-head-action-button flexbox">
                            <i class="material-icons">print</i>
                            <p>{{ trans('word.print_pdf') }}</p>
                        </button>
                        <button class="property-view-head-action-button flexbox">
                            <i class="material-icons">star_outline</i>
                            <p>{{ trans('word.add_to_favorite') }}</p>
                        </button>
                    </div>

                    <div class="property-view-head-social-wrapper flexbox">
                        <div class="property-view-head-social-button flexbox" id="social-facebook">
                            <div class="head-social-button-icon">
                                <i class="material-icons">android</i>
                            </div>
                            <div class="head-social-button-text">
                                <p class="social-button-hint">share on</p>
                                <p class="social-button-name">facebook</p>
                            </div>
                        </div>
                        <div class="property-view-head-social-button flexbox" id="social-twitter">
                            <div class="head-social-button-icon">
                                <i class="material-icons">android</i>
                            </div>
                            <div class="head-social-button-text">
                                <p class="social-button-hint">share on</p>
                                <p class="social-button-name">twitter</p>
                            </div>
                        </div>
                        <div class="property-view-head-social-button flexbox" id="social-google">
                            <div class="head-social-button-icon">
                                <i class="material-icons">android</i>
                            </div>
                            <div class="head-social-button-text">
                                <p class="social-button-hint">share on</p>
                                <p class="social-button-name">google +</p>
                            </div>
                        </div>
                    </div>

                    <div class="property-view-head-map-wrapper" id="map" style="height: 320px;">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-view-section-body">

        <div class="container">
            <div class="property-view-description-container">
                <div class="property-description-row flexbox">
                    <div class="property-description-column">
                        <p>{{ trans('word.general_informations') }}</p>
                    </div>
                    <div class="property-description-column flexbox double">
                        <p>Code: <span>{{ $property->code }}</span></p>
                        <p>{{ trans('word.location') }}: <span>{{ $property->city }}</span></p>
                        <p>{{ trans('word.land_size') }}: <span>{{ $property->land_size }}</span></p>

                        <p>Status: <span>{{ $property->type }}</span></p>
                        <p>{{ trans('word.year_built') }}: <span>{{ $property->year }}</span></p>
                        <p>{{ trans('word.building_size') }}: <span>{{ $property->building_size }}</span></p>
                    </div>
                </div>

                <div class="property-description-row flexbox">
                    <div class="property-description-column">
                        <p>{{ trans('word.facilities') }}</p>
                    </div>
                    <div class="property-description-column flexbox double">
                        @foreach($property->facilities() as $facility)
                        <p>{{ $facility->name }}: <span>{{ $facility->value }}</span></p>
                        @endforeach
                    </div>
                </div>

                <div class="property-description-row flexbox">
                    <div class="property-description-column">
                        <p>{{ trans('word.distance_to') }}</p>
                    </div>
                    <div class="property-description-column flexbox double">
                        @foreach($property->distances() as $distance)
                        <p>{{ $distance->name }}: <span>{{ $distance->value }}</span></p>
                        @endforeach
                    </div>
                </div>

                <div class="property-description-row flexbox">
                    <div class="property-description-column">
                        <p>{{ trans('word.description') }}</p>
                    </div>
                    <div class="property-description-column double">
                        <p>{!! $property->lang()->content !!}</p>
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
                <h4 class="modal-title">{{ trans('word.inquire_this_property') }}</h4>
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
                <button type="submit" class="btn btn-primary send-enquiry">{{ trans('word.send') }}</button>
            </div>

            {!! Form::close() !!}

        </div>

    </div>
</div>
@stop

@section('scripts')

<script src='https://www.google.com/recaptcha/api.js'></script>

<script type="text/javascript">
    function initMap() {

        var myLatLng = { lat: {{ $property->map_latitude }}, lng: {{ $property->map_longitude }} };

    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('map'), {
        mapTypeControl: false,
        center: myLatLng,
        scrollwheel: false,
        zoom: 13,
        maxZoom: 15,
        minZoom: 8,
        draggable: false,
        zoomControl: false,
        scrollwheel: false,
        disableDoubleClickZoom: true,
        streetViewControl: false
    });
    }

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
