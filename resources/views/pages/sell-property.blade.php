@extends('index')
@section('content')

<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ baseUrl() }}">Home</a></li>
        <li class="active">{{ ucfirst($titles) }}</li>
    </ul>
</div>
<div class="line-top"><h3><small>{{ $titles }}</small></h3></div>
<br>
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
  
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-body">

        {!! Form::open(array('url' => url('sell-property'))) !!}

          <div class="form-group">
            <div class="col-sm-6">
              <input type="text" name="owner_name" class="form-control" placeholder="Name">
            </div>
            <div class="col-sm-6">
              <input type="email" name="owner_email" class="form-control" placeholder="Email">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-6">
              <input type="text" name="owner_phone" class="form-control" placeholder="Phone">
            </div>
            <div class="col-sm-6">

              <select name="city" class="form-control select-city" placeholder="City">

                <option value=""></option>

                @foreach(\App\City::orderBy('city_name', 'asc')->get() as $city)
                <option value="{{ $city->city_name }}">{{ $city->city_name }}</option>
                @endforeach

              </select>

            </div>
          </div>

          <div class="form-group map">  
            <div class="col-sm-12">
              <textarea name="sell_note" class="form-control" rows="5" placeholder="Comment"></textarea>
            </div>
          </div>

          <div class="form-group map-box">
            <input id="pac-input" class="controls" type="text" placeholder="Search Box">
            <div id="googleMap" style="width:100%;height:500px;"></div>
            <input type="hidden" value="0" name="map_latitude" id="map_latitude">
            <input type="hidden" value="0" name="map_longitude" id="map_longitude">
            
          </div>

          <div class="form-group">
            <div class="g-recaptcha" data-sitekey="6LcdHRcTAAAAAMUKsjZDzArdb0e8Fk2HU-duNhJP" style=" margin-left: 20px;"></div>
          </div>

          <div class="form-group">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary">Send</button>
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

</script>

  <script type="text/javascript">
    var markersToRemove = [];
    var myCenter=new google.maps.LatLng(-8.4420734,114.9356164);

    function initialize() {
      var mapProp = {
        center:myCenter,
        zoom:10,
        mapTypeId:google.maps.MapTypeId.ROADMAP
      };

      var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

      //search
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

    }

    $(document).ready(function(){
      google.maps.event.addDomListener(window, 'load', initialize);
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
  </script>
@endsection