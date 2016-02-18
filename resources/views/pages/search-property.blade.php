@extends('index')
@section('content')

<div class="bc-bg">
    <ul class="breadcrumb container">
        <li><a href="{{ baseUrl() }}">{{ trans('word.home') }}</a></li>
        <li class="active">{{ trans('word.search') }}</li>

    </ul>
</div>

<div class="line-top"><h3><small>{{ trans('url.search') }}</small></h3></div>

<section class="" style="display:inline-block">
    <div class="col-lg-8 well">
        <div style="min-height:1000px;" class="pre-scrollable">
            <section class="panel panel-body">
                <form class="form-horizontal">
                    <div class="form-group ">
                        <label class="col-sm-2 control-label">Type</label>
                        <div class="col-lg-8 col-lg-offset">
                            <label class="search-type">
                                <$500.000 &nbsp;
                                <input type="radio" name="type" id="radio1" value="<$500000">
                            </label>
                            <label class="search-type">
                                >$500.000 &nbsp;
                                <input type="radio" name="type" id="radio2" value=">$500000">
                            </label>
                            <label class="search-type">
                                Home & Retir. &nbsp;
                                <input type="radio" name="type" id="radio3" value="home">
                            </label>
                            <label class="search-type">
                                Beachfront &nbsp;
                                <input type="radio" name="type" id="radio4" value="beachfront">
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Location</label>
                        <span class="col-lg-8">
                            <div class="input-group">
                                <input class="form-control" id="searchTextField" type="text" value="Bali" placeholder="" style="min-width:500px;">
                            </div>
                        </span>
                    </div>
                    <br>
                    <div class="form-group" >
                        <label class="col-sm-2 control-label">Price range</label>
                        <span style="display:inline-block;" class="col-lg-8">
                            <div class="row">
                                <input type="text" ui-jq="slider" class="slider form-control" data-slider-step="1" data-slider-min="1" data-slider-max="2000000000" data-slider-value="[500,100000000]">
                            </div>
                            <div class="row">
                                <div class="col-md-6" id="amount_from">
                                    
                                </div>
                                <div class="col-md-6 text-right" id="amount_to">
                                    
                                </div>
                            </div>
                        </span>
                        <!-- <input type="text" name="amount" id="amount"> -->
                        <input type="hidden" name="amount_start" id="amount_start">
                        <input type="hidden" name="amount_end" id="amount_end">
                        
                        <br/>
                    </div>
                </form>
            </section>
            <div class="list-inline" >
                <div class="row">
                    <div class="col-lg-6">
                        <div class="col-lg-6 col-lg-offset pagination">
                            <a href class="btn btn-default fa fa-filter">&nbsp; More Filter</a>
                            <a href class="btn btn-default fa fa-sort-amount-desc">&nbsp; Prices</a>
                        </div>
                        <div class="col-lg-6 text-right pagination">
                            <strong><span class="badge">{{ count($properties) }} Found
                        </div>
                    </div>
                    <div class="col-lg-6 text-right">
                        @include('fragments.pagination', ['paginator' => $properties])
                    </div>
                </div>
                <?php $i = 0; ?>
                @foreach( $properties as $value )
                    <div class="col-lg-6 col-sm-6 col-xs-12" style="margin-bottom:30px;">
                        <a href="">
                            <div id="myCarousel{{ $i }}" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel{{ $i }}" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel{{ $i }}" data-slide-to="1"></li>
                                    <li data-target="#myCarousel{{ $i }}" data-slide-to="2"></li>
                                    <li data-target="#myCarousel{{ $i }}" data-slide-to="3"></li>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active hovereffect">
                                        <img src="http://placehold.it/800x600" alt="Chania" height="345">
                                        <p>USD {{ $value->price }}</p>
                                        <div class="overlay">
                                            <div class="panel panel-header">
                                                <h2>USD {{ $value->price }}</h2>
                                                <!-- <p> Brand new 2 bedroom villa for sale in balangan</p> -->
                                            </div>
                                            <div class="pabel-body" style="min-height:220px;">
                                                <ul>
                                                    <li>
                                                        <i class="fa fa-barcode block m-b-xs"></i>
                                                        <span class="spanhover">Code</span><span class="spanhover">{{ $value->code }}</span>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-map-marker block m-b-xs"></i>
                                                        <span class="spanhover">Location</span><span class="spanhover">{{ $value->city }}</span>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-clock-o block m-b-xs"></i>
                                                        <span class="spanhover">Status</span><span class="spanhover">{{ $value->type }} </span>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-arrows-alt block m-b-xs"></i>
                                                        <span class="spanhover">Land Size</span><span class="spanhover">{{ $value->land_size }} are</span>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-home block m-b-xs"></i>
                                                        <span class="spanhover">Building Size</span><span class="spanhover">{{ $value->building_size }} sqm</span>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-bed block m-b-xs">&#xf236;</i>
                                                        <span class="spanhover">Bedrooms</span><span class="spanhover">2</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="hbox text-center text-sm panel-footer">
                                                <a href="" class="col-md-4">
                                                    <i class="fa fa-book block m-b-xs fa-2x"></i>
                                                    <span>Enquire</span>
                                                </a>
                                                <a href="" class="col-md-4">
                                                    <i class="fa fa-star block m-b-xs fa-2x"></i>
                                                    <span>Favorite</span>
                                                </a>
                                                <a href="{{ route('search', ['property' => trans('url.search'), 'term' => $term . '/' . $value->slug]) }}" class="col-md-4">
                                                    <i class="fa fa-list block m-b-xs fa-2x"></i>
                                                    <span>Detail</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item hovereffect">
                                        <img src="http://placehold.it/800x600" alt="Chania" height="345">
                                        <p>USD {{ $value->price }}</p>
                                        <div class="overlay">
                                           <h2>USD {{ $value->price }}</h2>
                                        </div>
                                    </div>
                                    <div class="item hovereffect">
                                        <img src="http://placehold.it/800x600" alt="Chania" height="345">
                                        <div class="overlay">
                                           <h2>USD {{ $value->price }}</h2>
                                        </div>
                                    </div>
                                    <div class="item hovereffect">
                                        <img src="http://placehold.it/800x600" alt="Chania" height="345">
                                        <div class="overlay">
                                           <h2>USD {{ $value->price }}</h2>
                                        </div>
                                    </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="left carousel-control" href="#myCarousel{{ $i }}" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel{{ $i }}" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </a>
                    </div>
                    <?php $i++; ?>
                @endforeach
            </div>
        </div>
    </div>
    <div id="map" class=" col-lg-4 well hidden-md hidden-sm hidden-xs" style="height: 1040px; display: inline-block;"></div>
</section>


@endsection

@section('scripts')

<script>
    var markersToRemove = [];
    var property = <?php echo json_encode($properties); ?>;

    $(document).ready(function(){

        $(function() {
            $( "#tabs" ).tabs();
            $('.carousel').each(function(){
                $(this).carousel({
                    interval: false
                });
            });
        });

        // init map
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: new google.maps.LatLng(-8.714309, 115.168725), //ambil dari parameter pertama search
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        //search
        var input = document.getElementById('searchTextField'),
            searchBox = new google.maps.places.SearchBox(input);

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

            searching();
        });

        var dots = {
            url: 'assets/img/map-pointer.png'
          };
        
        var infowindow = new google.maps.InfoWindow(),
            geocoder = new google.maps.Geocoder(),
            marker, i;

        removeMarkers();

        if (property.length > 0) {
            var i = 0;
            property.forEach(function (item) {
                console.log(item.map_latitude);
                console.log(item.map_longitude);
                marker = new MarkerWithLabel({
                    position: new google.maps.LatLng(item.map_latitude, item.map_longitude),
                    map: map,
                    icon: dots
                    // labelContent: "",
                    // labelAnchor: new google.maps.Point(38, 29),
                    // labelClass: "labelsmarker", // the CSS class for the label
                    // labelStyle: {opacity: 0.75},
                    // labelInBackground: false
                });

                // marker.set("labelContent", "<div class='arrow'></div><div class='inner'><sup>Rp </sup>"+ item.price +"</div>");

                markersToRemove.push(marker);

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                      infowindow.setContent("<div style='color:#000;'>"+ item.st +"</div>");
                      infowindow.open(map, marker);
                    }
                  })(marker, i));
                i++;
            });
        }
        
        // map on drag event
        google.maps.event.addListener(map,'dragend',function() {
            
            var centerMap = map.getCenter(),
                strCenter = centerMap.toString(),
                splCenter = strCenter.split(','),
                lats = splCenter[0].replace("(", ""), 
                longs = splCenter[1].replace(")", ""), 
                latlng = new google.maps.LatLng(lats, longs);

            //buat dapetin detail dari tempat (lat dan long
            geocoder.geocode(
                {'latLng': latlng}, 
                function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            var add= results[0].formatted_address ;
                            var  value=add.split(",");

                            count=value.length;
                            country=value[count-1];
                            state=value[count-2];
                            city=value[count-3];
                            street=value[count-4];
                            console.log("street name is: " + street);
                            console.log("city name is: " + city);
                            console.log("province & postal code is: " + state);
                            console.log("country name is: " + country);
                        }
                        else  {
                            console.log("address not found");
                        }
                    }
                    else {
                        console.log("Geocoder failed due to: " + status);
                    }
                }
            );

            removeMarkers();
            
            if (property.length > 0) {
                var i = 0;
                property.forEach(function (item) {
                    marker = new MarkerWithLabel({
                        position: new google.maps.LatLng(item.lat, item.lng),
                        map: map,
                        icon: dots
                        // labelContent: "",
                        // labelAnchor: new google.maps.Point(38, 29),
                        // labelClass: "labelsmarker", // the CSS class for the label
                        // labelStyle: {opacity: 0.75},
                        // labelInBackground: false
                    });

                    // marker.set("labelContent", "<div class='arrow'></div><div class='inner'><sup>Rp </sup>"+ item.price +"</div>");

                    markersToRemove.push(marker);

                    var a = new google.maps.LatLng(lats, longs),
                        b = new google.maps.LatLng(item.lat, item.lng);

                    console.log(calcDistance(a, b) + ' KM');

                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                          infowindow.setContent("<div style='color:#000;'>"+ item.st +"</div>");
                          infowindow.open(map, marker);
                        }
                      })(marker, i));
                    i++;
                });
            }
        });

        $("input[name='type']").change(function(){
            searching();
        });
        
        $(".slider").on("slideStop", function() {
            searching();
        });

        $(".slider").on("slide", function() {
            var val = $(this).val(),
                split_val = val.split(",");

            $("#amount_from").html(split_val[0] + ' $');
            $("#amount_to").html(split_val[1] + ' $');

            $("#amount_from").val(split_val[0]);
            $("#amount_to").val(split_val[1]);
        });

        $("#amount_from").html('500 $');
        $("#amount_to").html('3000 $');
    });

    $(function() {
        $( ".slider" ).slider({
            range: true,
            tooltip: 'hide'
        });
    });

    //calculates distance between two points in km's
    function calcDistance(p1, p2) {
        return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
    }
    
    function removeMarkers() {
        for(var i = 0; i < markersToRemove.length; i++) {
            markersToRemove[i].setMap(null);
        }
    }

    function searching() {
        var srch = $("#searchTextField").val(),
            // tipe = '',
            prices_from = $("#amount_start").val(),
            prices_to = $("#amount_end").val(),
            check = $("input[name='type']:checked").val();

        // alert(check);
    }

</script>
@endsection
