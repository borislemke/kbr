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
                    <div class="property-view-head-gallery" style="background-image: url('http://loremflickr.com/320/240/architecture')"></div>
                    <div class="property-head-left-information-wrapper flexbox">
                        <div class="property-view-head-information-block flexbox">
                            <i class="material-icons">place</i>
                            <div class="property-view-head-information-text">
                                <p class="property-view-head-information-bold">Canggu</p>
                                <p class="property-view-head-information-string">Bali</p>
                            </div>
                        </div>
                        <div class="property-view-head-information-block flexbox">
                            <i class="material-icons">hotel</i>
                            <div class="property-view-head-information-text">
                                <p class="property-view-head-information-bold">{{ $property->bedroom }} Bedrooms</p>
                                <p class="property-view-head-information-string">{{ $property->bathroom }} Bathrooms</p>
                            </div>
                        </div>
                        <div class="property-view-head-information-block flexbox">
                            <i class="material-icons">zoom_out_map</i>
                            <div class="property-view-head-information-text">
                                <p class="property-view-head-information-bold">{{ $property->building_size }}m<span class="superscript">2</span></p>
                                <p class="property-view-head-information-string">{{ trans('word.land') }}: {{ $property->land_size }}m<span class="superscript">2</span></p>
                            </div>
                        </div>
                        <div class="property-view-head-information-block flexbox">
                            <i class="material-icons">hotel</i>
                            <div class="property-view-head-information-text">
                                <p class="property-view-head-information-bold">{{ $property->type }}</p>
                                <p class="property-view-head-information-string">Bali</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="property-view-head-right">
                    <div class="property-view-head-price-box flexbox">
                        <div class="property-head-view-price-currency">
                            <select name="currency_rate" id="currency_select">
                                <?php $base_currency = \Config::get('currencies.base_currency') ?>
                                <option value="{{ $base_currency }}"{{ \Session::get('currency') == $base_currency ? ' selected' : '' }}>{{ $base_currency }}</option>
                                @foreach(\Config::get('currencies.alt_currencies') as $currency)
                                <option value="{{ $currency }}"{{ \Session::get('currency') == $currency ? ' selected' : '' }}>{{ $currency }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="property-head-view-price-value">
                            <p><span class="subscript">{{ \Session::get('currency') }}</span>{{ convertCurrency($property->price, $property->currency, \Session::get('currency')) }}</p>
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
                    <div class="property-description-column flexbox flexbox-wrap double">
                        <p>Code: <strong>{{ $property->code }}</strong></p>
                        <p>{{ trans('word.location') }}: <strong>{{ $property->city }}</strong></p>
                        <p>{{ trans('word.land_size') }}: <strong>{{ $property->land_size }}</strong></p>

                        <p>Status: <strong>{{ $property->type }}</strong></p>
                        <p>{{ trans('word.year_built') }}: <strong>{{ $property->year }}</strong></p>
                        <p>{{ trans('word.building_size') }}: <strong>{{ $property->building_size }}</strong></p>
                    </div>
                </div>

                <div class="property-description-row flexbox">
                    <div class="property-description-column">
                        <p>{{ trans('word.facilities') }}</p>
                    </div>
                    <div class="property-description-column flexbox flexbox-wrap double">
                        <?php $facilities = $property->facilities()->lists('name')->toArray() ?>
                        @foreach(\Config::get('facility') as $facility => $icon)
                        <p class="property-facility{{ in_array($facility, $facilities) ? ' available' : '' }}">{!! in_array($facility, $facilities) ? '<i class="material-icons">' . $icon . '</i>' : '' !!} {{ $facility }}</p>
                        @endforeach
                    </div>
                </div>

                <div class="property-description-row flexbox" id="distance-row">
                    <div class="property-description-column">
                        <p>{{ trans('word.distance_to') }}</p>
                    </div>
                    <div class="property-description-column flexbox flexbox-wrap double">
                        @foreach($property->distances as $distance)
                        <p class="property-distance">{{ $distance->name }}: <strong>{{ $distance->value }}</strong></p>
                        @endforeach
                    </div>
                </div>

                <div class="property-description-row flexbox">
                    <div class="property-description-column">
                        <p>{{ trans('word.description') }}</p>
                    </div>
                    <div class="property-description-column double" id="property-description-container">
                        {!! $property->lang()->content !!}
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
