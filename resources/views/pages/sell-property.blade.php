@extends('index')
@section('content')

<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ route('home') }}">{{ trans('url.home') }}</a></li>
        <li class="active">{{ trans('url.sell_property') }}</li>
    </ul>
</div>
<div class="line-top"><h3><small>{{ trans('url.sell_property') }}</small></h3></div>
<br>
<div class="container">


  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-body">

        {!! Form::open(['url' => route('sellproperty.store'), 'id' => 'form-sellproperty']) !!}

          <div class="form-group">
            <div class="col-sm-6">
              <label class="control-label" for="owner_name">Name</label>
              <input type="text" name="owner_name" class="form-control" placeholder="">
            </div>
            <div class="col-sm-6">
              <label class="control-label" for="owner_email">Email</label>
              <input type="email" name="owner_email" class="form-control" placeholder="">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-6">
              <label class="control-label" for="owner_phone">Phone</label>
              <input type="text" name="owner_phone" class="form-control" placeholder="">
            </div>
            <div class="col-sm-6">
            <label class="control-label" for="city">City</label>
              <select name="city" class="form-control select-city" placeholder="">

                <option value=""></option>

                @foreach(\App\City::orderBy('city_name', 'asc')->get() as $city)
                <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                @endforeach

              </select>

            </div>
          </div>

          <div class="clearfix"></div>
          <div class="form-group">
            <div class="col-sm-6">
              <label class="control-label" for="owner_name">Category</label>
              <select name="category" class="form-control" placeholder="">

                <?php $categories = \App\Term::where('type', 'property_category')->get(); ?>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach

              </select>
            </div>
          </div>

          <div class="form-group map">  
            <div class="col-sm-12">
              <label class="control-label" for="sell_note">Comment</label>
              <textarea name="sell_note" class="form-control" rows="5" placeholder="" style="margin-bottom: 30px;"></textarea>
            </div>
          </div>

          <div class="form-group map-box">
            <div class="col-sm-12">
              <input id="pac-input" class="controls" type="text" placeholder="Search">
              <div id="googleMap" style="width:100%;height:500px;"></div>
              <input type="hidden" value="0" name="map_latitude" id="map_latitude">
              <input type="hidden" value="0" name="map_longitude" id="map_longitude">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-12">
              <div class="g-recaptcha" data-sitekey="6LcdHRcTAAAAAMUKsjZDzArdb0e8Fk2HU-duNhJP" style=" margin-top: 20px; margin-bottom:20px;"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary" id="send-property">Send</button>
            </div>
          </div>
        {!! Form::close() !!}

      </div>
    </div>
  </div>
</div>

@stop

@section('scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="assets/js/select2.js"></script>
<script type="text/javascript">

  $(".select-city").select2({
    placeholder: "Select a city",
    allowClear: true
  });

  $(document).ready(function() {
    
    $('#form-sellproperty').submit(function(event) {
      /* Act on the event */
      event.preventDefault();

      console.log('send property');

      $('#send-property').html('Sending...');

      var url = $(this).attr('action'),
        data = $(this).serialize();

      $.post(url, data, function(data, textStatus, xhr) {
        /*optional stuff to do after success */

        if (data.status == 200) {

          var html = ''          
            + '<div class="flash-message">'
                + '<p class="alert alert-success">'
                + data.monolog.message
                  + '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>'
            + '</div>';

          $('.panel-body').prepend(html);

        }

        if (data.status == 500) {

          if (data.monolog.message.owner_name)
            $('input[name=owner_name]').closest('.form-group').addClass('has-error');

          if (data.monolog.message.owner_phone)
            $('input[name=owner_phone]').closest('.form-group').addClass('has-error');

          if (data.monolog.message.city)
            $('select[name=city]').closest('.form-group').find('.select2-selection').css('border', '1px solid #a94442');

        }

        $('#send-property').html('Send');
      });

    });

  });

</script>

<script type="text/javascript">

function initMap() {

    var markersToRemove = [];

   var myLatLng = { lat: -8.4420734, lng: 114.9356164 };

   var map = new google.maps.Map(document.getElementById('googleMap'), {
        mapTypeControl: false,
        center: myLatLng,
        scrollwheel: false,
        zoom: 10,
        maxZoom: 15,
        minZoom: 8,
        draggable: false,
        zoomControl: false,
        scrollwheel: false,
        disableDoubleClickZoom: true,
        streetViewControl: false
    });

     var input = document.getElementById('pac-input'),
    searchBox = new google.maps.places.SearchBox(input);
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

      map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
      });

      searchBox.addListener('places_changed', function() {
          
          var places = searchBox.getPlaces();
          if (places.length == 0) {
              return;
          }

          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
              if (place.geometry.viewport) {
                  // Only geocodes have viewport.
                  bounds.union(place.geometry.viewport);
              } else {
                  bounds.extend(place.geometry.location);
              }
          });
          map.fitBounds(bounds);
      });


      google.maps.event.addListener(map, "click", function (e) {
        removeMarkers();
        var latLng = e.latLng,
            strlatlng = latLng.toString(),
            spllatlng = strlatlng.split(','),
            lats = spllatlng[0].replace("(", ""), 
            longs = spllatlng[1].replace(")", "");

        $("#map_latitude").val(lats);
        $("#map_longitude").val(longs);
        placeMarker(latLng, map);

      });

          function placeMarker(location, map) {
      var marker = new google.maps.Marker({
          position: location, 
          map: map
      });

      markersToRemove.push(marker);
    }

    function removeMarkers() {
      for(var i = 0; i < markersToRemove.length; i++) {
          markersToRemove[i].setMap(null);
      }
    }

}


    // var markersToRemove = [];
    // var myCenter=new google.maps.LatLng(-8.4420734,114.9356164);

    // function initialize() {
    //   var mapProp = {
    //     center:myCenter,
    //     zoom:10,
    //     mapTypeId:google.maps.MapTypeId.ROADMAP
    //   };

    //   var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

    //   //search
      // var input = document.getElementById('pac-input'),
      //   searchBox = new google.maps.places.SearchBox(input);
      // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

      // map.addListener('bounds_changed', function() {
      //     searchBox.setBounds(map.getBounds());
      // });

    //   searchBox.addListener('places_changed', function() {
          
    //       var places = searchBox.getPlaces();
    //       if (places.length == 0) {
    //           return;
    //       }

    //       var bounds = new google.maps.LatLngBounds();
    //       places.forEach(function(place) {
    //           if (place.geometry.viewport) {
    //               // Only geocodes have viewport.
    //               bounds.union(place.geometry.viewport);
    //           } else {
    //               bounds.extend(place.geometry.location);
    //           }
    //       });
    //       map.fitBounds(bounds);
    //   });

    //   google.maps.event.addListener(map, "click", function (e) {
    //     removeMarkers();
    //     var latLng = e.latLng,
    //         strlatlng = latLng.toString(),
    //         spllatlng = strlatlng.split(','),
    //         lats = spllatlng[0].replace("(", ""), 
    //         longs = spllatlng[1].replace(")", "");

    //     $("#map_latitude").val(lats);
    //     $("#map_longitude").val(longs);
    //     placeMarker(latLng, map);

    //   });

    // }

    // $(document).ready(function(){
    //   google.maps.event.addDomListener(window, 'load', initialize);
    // });

    // function placeMarker(location, map) {
    //   var marker = new google.maps.Marker({
    //       position: location, 
    //       map: map
    //   });

    //   markersToRemove.push(marker);
    // }

    // function removeMarkers() {
    //   for(var i = 0; i < markersToRemove.length; i++) {
    //       markersToRemove[i].setMap(null);
    //   }
    // }
  </script>
@endsection