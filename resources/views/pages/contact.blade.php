@extends('index')

@section('meta_description', $page->meta_description)
@section('meta_keyword', $page->meta_keyword)

@section('content')

<div class="contact-us">
    <div class="row">
        <div class="col-md-4 address-wrapper">
           <div class="desc">
              
               <h3>Kibarer Property</h3><br>
               <div class="border-spacer"></div>
                <p>
                    Jalan Petitenget No.9, Badung, Bali 80361 <br>

                    T. <a href="tel:623614741212">(+62361) 4741212</a><br>
                    C. <a href="mailto:contact@kibarerproperty.com">contact@kibarerproperty.com</a> <br>
                    <img src="{{ asset('assets/img/logo-sm.png') }}" class="logo" alt="">
               </p>
           </div>
        </div>
        <div class="col-md-8 bg-kibarer">
        </div>
    </div>
    
    <div class="row">

        <div class="col-md-4 col-sm-6 company-other-location ">
            <img src="{{ asset('assets/img/contact/au.jpg') }}" alt="">
               <div class="caption">
                   <h1>AU</h1> 
                   <p>Australia <span><a href="tel:61-865-558-999">+61 865 558 999</a></span></p>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 company-other-location ">
            <img src="{{ asset('assets/img/contact/uk.jpg') }}" alt="">
               <div class="caption">
                   <h1>UK</h1>
                   <p>United Kingdom <span><a href="tel:44-203-514-2999">+44 203 514 2999</a></span></p>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 company-other-location ">
            <img src="{{ asset('assets/img/contact/gr.jpg') }}" alt="">
               <div class="caption">
                   <h1>GR</h1>
                   <p>Germany <span><a href="tel:49-893-803-875">+49 893 803 875</a></span></p>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 company-other-location ">
            <img src="{{ asset('assets/img/contact/za.jpg') }}" alt="">
               <div class="caption">
                   <h1>ZA</h1>
                   <p>South Africa <span><a href="tel:27-213-002-088">+27 213 002 088</a></span></p>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 company-other-location ">
            <img src="{{ asset('assets/img/contact/hk.jpg') }}" alt="">
               <div class="caption">
                   <h1>HK</h1>
                   <p>Hongkong <span><a href="tel:852-5808-4180">+852 5808 4180</a></span></p>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 company-other-location ">
            <img src="{{ asset('assets/img/contact/usa.jpg') }}" alt="">
               <div class="caption">
                   <h1>USA</h1>
                   <p>United States of Amrica <span><a href="tel:1-518-574-2272">+1 518 574 2272</a></span></p>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 company-desc-wrapper">
           <div class="container">
               <div class="title">
                   <h3>PARLEZ-NOUS DE VOTRE PROJET !</h3>
               </div>
               <div class="border-spacer"></div>
               <div class="desc">
                   <p>
                       D’abord, merci de considérer Lubie pour votre projet. Nous vous invitons à nous donner les grandes lignes de votre projet, et nous nous ferons un plaisir de vous contacter afin de bien saisir vos besoins. Il est préférable de prévoir une bonne rencontre dans nos bureaux de Sherbrooke, situé au coeur du centre-ville de Sherbrooke, afin de vous fournir une évaluation complète et précise. Veuillez noter que cette rencontre est sans frais et vous permet de bénéficier de conseils provenant d’experts dans leur domaine.
                   </p>
               </div>
           </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 contact-form-wrapper">
            <div class="container">
                <div class="title">
                    <h3>Contact Us</h3>
                </div>
                <div class="border-spacer"></div>
                {!! Form::open(['url' => route('api.message.store'), 'class' => 'panel-body', 'id' => 'form-contact']) !!}
                <div class="form-group">
                    <label for="firstname" class="col-lg-12 ">Full Name</label>
                    <div class="col-lg-6">
                        <input value="{{ old('firstname') }}" name="firstname" type="text" class="form-control" id="firstname" placeholder="First Name" required>
                    </div>
                    <div class="col-lg-6">
                        <input value="{{ old('lastname') }}" name="lastname" type="text" class="form-control" id="lastname" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-12 ">Email</label>
                    <div class="col-lg-12">
                        <input value="{{ old('email') }}" name="email" type="text" class="form-control" id="inputEmail" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="msg" class="col-lg-12 ">Your Message</label>
                    <div class="col-lg-12">
                        <textarea name="message" class="form-control" rows="7" id="msg">{{ old('message') }}</textarea>
                    </div>
                </div>
                <div class="form-group captcha">
                    <div class="col-lg-12 g-recaptcha" data-sitekey="6LcdHRcTAAAAAMUKsjZDzArdb0e8Fk2HU-duNhJP" style=""></div>
                    <!-- reCAPTCHA secret : 6LcdHRcTAAAAANdDPV40G9bgBMdW8EyJnYnrVuUQ -->
                </div>
                <div class="form-group">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary btn-custom">Submit</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
    <!--    .rc-anchor-light -->
    
    <div class="row">
        <div class="col-md-12 company-map-wrapper">
            <div id="googleMap" style="width:100%;height:50vh;"></div>
        </div>
    </div>
</div>


@endsection


@section('scripts')
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script type="text/javascript">

      function initMap() {


        var myLatLng = { lat: -8.6714246, lng: 115.1607031 };

        var pin = 'assets/img/map-pin.png';

        var marker = new google.maps.Marker({
            position:myLatLng,
            animation: google.maps.Animation.DROP,
            icon : pin,
            title : 'Kibarer Property'
        });

        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="title" style="font-size: 1.5em;color: #ee5b2c;font-weight: 600; font-color">Kibarer Property</h1>'+
            '<div id="bodyContent">'+
            '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
            'sandstone rock formation in the southern part of the '+
            'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
            'south west of the nearest large town, Alice Springs; 450&#160;km '+
            'Heritage Site.</p>'+
            '</div>'+
            '</div>';
            
        var infowindow = new google.maps.InfoWindow({
            content: contentString,
            maxWidth: 300
        });

        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('googleMap'), {
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

        marker.setMap(map);

        marker.addListener('click', function() {
            infowindow.open(map, marker);
            
        });
    }



		// var myCenter=new google.maps.LatLng(-8.6714246,115.1607031);
  //       var pin = 'assets/img/map-pin.png';
  //       var marker=new google.maps.Marker({
  //           position:myCenter,
  //           animation: google.maps.Animation.DROP,
  //           icon : pin,
  //           title : 'Kibarer Property'
  //       });
  //       var contentString = '<div id="content">'+
  //           '<div id="siteNotice">'+
  //           '</div>'+
  //           '<h1 id="title" style="font-size: 1.5em;color: #ee5b2c;font-weight: 600; font-color">Kibarer Property</h1>'+
  //           '<div id="bodyContent">'+
  //           '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
  //           'sandstone rock formation in the southern part of the '+
  //           'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
  //           'south west of the nearest large town, Alice Springs; 450&#160;km '+
  //           'Heritage Site.</p>'+
  //           '</div>'+
  //           '</div>';
  //       var infowindow = new google.maps.InfoWindow({
  //           content: contentString,
  //           maxWidth: 300
  //       });
        
		// function initMap() {
		// 	var mapProp = {
		// 		center:myCenter,
		// 		zoom:15,
  //               scrollwheel: false,
		// 		mapTypeId:google.maps.MapTypeId.ROADMAP
		// 	};

		// 	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

		// 	marker.setMap(map);
  //           marker.addListener('click', function() {
  //               infowindow.open(map, marker);
                
  //           });
            
		// }


    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }


		// google.maps.event.addDomListener(window, 'load', initialize);
      
      $(document).on('click', 'button[type=submit]', function(event) {
        event.preventDefault();
        /* Act on the event */

        console.log('submit clicked');

        $(this).html('Sending...');

        var frm = $('#form-contact'),
            url = frm.attr('action'),
            data = frm.serialize();

        $.post(url, data, function(data, textStatus, xhr) {

          if (data.status == 200) {
            
            console.log(data);

            $('input[name=firstname]').val('');
            $('input[name=lastname]').val('');
            $('input[name=email]').val('');
            $('textarea').val('');

          } else {

            console.log(data);

            if (data.monolog.message.email) {
              $('input[name=email]').closest('.form-group').addClass('has-error');
            }

          }

          $('button[type=submit]').html('Submit');

        });

      });


	</script>
@endsection
